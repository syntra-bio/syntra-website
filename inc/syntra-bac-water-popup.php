<?php
/**
 * Free Bac Water popup — email capture + add to cart
 * Hooks into wp_footer. Uses FluentForms form ID 3.
 * Sets a cookie so it doesn't show again for 7 days (30 days if submitted).
 */

add_action( 'wp_footer', 'syntra_bac_water_popup' );

function syntra_bac_water_popup() {
    // Don't show on cart, checkout, or account pages
    if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
        return;
    }
    // Don't show on the locked policy pages or GHK-Cu compliance page
    $template = get_page_template_slug();
    if ( $template === 'page-locked-policy.php' || is_page( 'topical-ghkcu' ) ) {
        return;
    }
    ?>
    <!-- BAC WATER POPUP -->
    <div id="bwPopupOverlay" class="bwp-overlay" role="dialog" aria-modal="true" aria-label="Claim your free bacteriostatic water">
        <div class="bwp-modal">
            <button class="bwp-close" onclick="syntraBwClose()" aria-label="Close">&times;</button>

            <!-- Vial visual -->
            <div class="bwp-visual">
                <div class="bwp-vial-glow"></div>
                <div class="bwp-badge">FREE</div>
                <div class="bwp-vial">
                    <div class="bwp-vial__cap"></div>
                    <div class="bwp-vial__label">
                        <div class="bwp-vial__brand">SYNTRA BIO</div>
                        <div class="bwp-vial__name">BACTERIOSTATIC<br>WATER</div>
                        <div class="bwp-vial__vol">10ml &bull; Sterile</div>
                    </div>
                </div>
            </div>

            <!-- Copy -->
            <div class="bwp-body">
                <div class="bwp-label">Limited Offer</div>
                <h2 class="bwp-title">Free Bacteriostatic Water</h2>
                <p class="bwp-sub">Enter your email — just cover $15 shipping.</p>

                <!-- Form state -->
                <div id="bwpFormState">
                    <?php if ( function_exists( 'do_shortcode' ) ) : ?>
                        <div class="bwp-ff-wrap">
                            <?php echo do_shortcode( '[fluentform id="3"]' ); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Success state (hidden until form submits) -->
                <div id="bwpSuccessState" class="bwp-success" style="display:none;">
                    <p class="bwp-success__msg">Your email is confirmed. Add your free vial below.</p>
                    <button class="bwp-cart-btn" id="bwpAddToCart">
                        <span id="bwpBtnText">Add Free Bac Water to Cart &rarr;</span>
                        <span id="bwpBtnLoading" style="display:none;">Adding...</span>
                    </button>
                    <p class="bwp-success__note">Coupon FREEBACWATER applied automatically.</p>
                </div>

                <p class="bwp-dismiss"><button onclick="syntraBwClose()" class="bwp-dismiss-btn">No thanks</button></p>
            </div>
        </div>
    </div>

    <style>
    .bwp-overlay {
        display: none;
        position: fixed; inset: 0; z-index: 99999;
        background: rgba(15, 25, 40, 0.82);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .bwp-overlay.is-open { display: flex; }

    .bwp-modal {
        background: #1a2d45;
        border: 1px solid rgba(151,174,200,0.2);
        border-radius: 16px;
        max-width: 560px;
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: bwpSlideUp 0.35s cubic-bezier(0.22,1,0.36,1);
    }
    @media (min-width: 600px) { .bwp-modal { flex-direction: row; max-width: 680px; } }
    @keyframes bwpSlideUp { from { opacity:0; transform: translateY(24px); } to { opacity:1; transform: translateY(0); } }

    .bwp-close {
        position: absolute; top: 14px; right: 16px;
        background: none; border: none; color: rgba(151,174,200,0.6);
        font-size: 22px; cursor: pointer; line-height: 1; z-index: 2;
        transition: color 0.2s;
    }
    .bwp-close:hover { color: #fff; }

    /* Vial visual panel */
    .bwp-visual {
        background: linear-gradient(160deg, #162640 0%, #1F3552 100%);
        display: flex; align-items: center; justify-content: center;
        padding: 40px 32px;
        position: relative;
        flex-shrink: 0;
    }
    @media (min-width: 600px) { .bwp-visual { width: 200px; } }

    .bwp-vial-glow {
        position: absolute;
        width: 140px; height: 140px;
        background: radial-gradient(circle, rgba(47,183,179,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    .bwp-badge {
        position: absolute; top: 20px; right: 20px;
        background: #2FB7B3; color: #fff;
        font-family: 'IBM Plex Mono', monospace; font-size: 9px; font-weight: 500;
        letter-spacing: 0.12em; text-transform: uppercase;
        padding: 5px 10px; border-radius: 100px;
    }
    .bwp-vial {
        width: 80px; height: 170px;
        background: linear-gradient(160deg, rgba(151,174,200,0.15) 0%, rgba(31,53,82,0.8) 100%);
        border: 1px solid rgba(151,174,200,0.25);
        border-radius: 8px 8px 12px 12px;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        position: relative;
        animation: bwpFloat 4s ease-in-out infinite;
    }
    @keyframes bwpFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    .bwp-vial__cap {
        width: 36px; height: 10px;
        background: rgba(31,53,82,0.95);
        border: 1px solid rgba(151,174,200,0.3);
        border-radius: 3px;
        position: absolute; top: -6px;
    }
    .bwp-vial__label { text-align: center; padding: 0 8px; }
    .bwp-vial__brand { font-family: 'IBM Plex Mono', monospace; font-size: 6px; letter-spacing: 0.18em; text-transform: uppercase; color: #2FB7B3; margin-bottom: 3px; }
    .bwp-vial__name { font-family: 'IBM Plex Mono', monospace; font-size: 7px; font-weight: 500; color: #fff; letter-spacing: 0.06em; line-height: 1.4; }
    .bwp-vial__vol { font-family: 'IBM Plex Mono', monospace; font-size: 6px; color: #97AEC8; margin-top: 4px; }

    /* Body */
    .bwp-body { padding: 32px 28px; flex: 1; }
    .bwp-label { font-family: 'IBM Plex Mono', monospace; font-size: 9px; letter-spacing: 0.16em; text-transform: uppercase; color: #2FB7B3; margin-bottom: 8px; }
    .bwp-title { font-family: 'Inter', sans-serif; font-size: 22px; font-weight: 700; letter-spacing: 0.03em; text-transform: uppercase; color: #fff; margin-bottom: 8px; line-height: 1.1; }
    .bwp-sub { font-size: 13px; color: #97AEC8; margin-bottom: 20px; line-height: 1.5; }

    /* FluentForms overrides inside popup */
    .bwp-ff-wrap .ff-el-group { margin-bottom: 12px !important; }
    .bwp-ff-wrap .ff-el-form-control {
        background: rgba(255,255,255,0.07) !important;
        border: 1px solid rgba(151,174,200,0.25) !important;
        border-radius: 8px !important;
        color: #fff !important;
        font-family: 'Inter', sans-serif !important;
        font-size: 14px !important;
        padding: 12px 14px !important;
        width: 100% !important;
    }
    .bwp-ff-wrap .ff-el-form-control::placeholder { color: rgba(151,174,200,0.45) !important; }
    .bwp-ff-wrap .ff-el-form-control:focus { border-color: #2FB7B3 !important; outline: none !important; box-shadow: none !important; }
    .bwp-ff-wrap .ff-btn-submit {
        background: #2FB7B3 !important;
        border: none !important;
        border-radius: 8px !important;
        color: #fff !important;
        font-family: 'Inter', sans-serif !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
        padding: 13px 20px !important;
        width: 100% !important;
        cursor: pointer !important;
        transition: opacity 0.2s !important;
    }
    .bwp-ff-wrap .ff-btn-submit:hover { opacity: 0.88 !important; }
    .bwp-ff-wrap .ff-el-is-error .ff-el-form-control { border-color: #ef4444 !important; }
    .bwp-ff-wrap .error { color: #f87171 !important; font-size: 11px !important; margin-top: 4px !important; }
    .bwp-ff-wrap label { color: rgba(151,174,200,0.7) !important; font-size: 12px !important; margin-bottom: 5px !important; display: block; }

    /* Success state */
    .bwp-success__msg { font-size: 13px; color: #97AEC8; margin-bottom: 16px; }
    .bwp-cart-btn {
        display: block; width: 100%;
        background: #2FB7B3; color: #fff;
        border: none; border-radius: 8px;
        font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 600;
        letter-spacing: 0.04em; text-transform: uppercase;
        padding: 14px 20px; cursor: pointer;
        transition: opacity 0.2s;
    }
    .bwp-cart-btn:hover { opacity: 0.88; }
    .bwp-cart-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    .bwp-success__note { font-size: 11px; color: rgba(151,174,200,0.45); margin-top: 8px; }

    .bwp-dismiss { margin-top: 16px; text-align: center; }
    .bwp-dismiss-btn { background: none; border: none; font-size: 11px; color: rgba(151,174,200,0.35); cursor: pointer; text-decoration: underline; }
    .bwp-dismiss-btn:hover { color: rgba(151,174,200,0.6); }
    </style>

    <script>
    (function() {
        var COOKIE_NAME   = 'syntra_bw_popup';
        var POPUP_DELAY   = 5000; // ms before showing
        var COOKIE_DAYS   = 7;
        var COOKIE_SUBMIT = 30;
        var BAC_PRODUCT_SLUG = 'bacteriostatic-water-10ml';
        var COUPON_CODE   = 'FREEBACWATER';

        function getCookie(name) {
            var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }
        function setCookie(name, value, days) {
            var d = new Date();
            d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
            document.cookie = name + '=' + value + ';expires=' + d.toUTCString() + ';path=/';
        }

        function syntraBwOpen() {
            document.getElementById('bwPopupOverlay').classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        window.syntraBwClose = function() {
            document.getElementById('bwPopupOverlay').classList.remove('is-open');
            document.body.style.overflow = '';
            setCookie(COOKIE_NAME, 'dismissed', COOKIE_DAYS);
        };

        // Close on overlay click
        document.getElementById('bwPopupOverlay').addEventListener('click', function(e) {
            if (e.target === this) window.syntraBwClose();
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') window.syntraBwClose();
        });

        // Listen for FluentForms success
        document.addEventListener('DOMContentLoaded', function() {
            jQuery(document).on('fluentform_submission_success', function(e, response, formId) {
                if (parseInt(formId) === 3) {
                    setCookie(COOKIE_NAME, 'submitted', COOKIE_SUBMIT);
                    document.getElementById('bwpFormState').style.display = 'none';
                    document.getElementById('bwpSuccessState').style.display = 'block';
                }
            });
        });

        // Add to cart AJAX
        document.getElementById('bwpAddToCart').addEventListener('click', function() {
            var btn = this;
            document.getElementById('bwpBtnText').style.display = 'none';
            document.getElementById('bwpBtnLoading').style.display = 'inline';
            btn.disabled = true;

            jQuery.post(
                '<?php echo esc_js( admin_url( "admin-ajax.php" ) ); ?>',
                {
                    action: 'syntra_add_bac_water',
                    nonce:  '<?php echo esc_js( wp_create_nonce( "syntra_bac_water_nonce" ) ); ?>'
                },
                function(response) {
                    if (response.success) {
                        window.syntraBwClose();
                        // Open cart drawer if it exists, otherwise go to cart
                        var cartDrawer = document.getElementById('cartDrawer') || document.querySelector('.cart-drawer');
                        if (cartDrawer) {
                            cartDrawer.classList.add('is-open');
                            document.body.classList.add('cart-open');
                        } else {
                            window.location.href = response.data.cart_url;
                        }
                    } else {
                        document.getElementById('bwpBtnText').textContent = 'Error — try again';
                        document.getElementById('bwpBtnText').style.display = 'inline';
                        document.getElementById('bwpBtnLoading').style.display = 'none';
                        btn.disabled = false;
                    }
                }
            ).fail(function() {
                document.getElementById('bwpBtnText').textContent = 'Error — try again';
                document.getElementById('bwpBtnText').style.display = 'inline';
                document.getElementById('bwpBtnLoading').style.display = 'none';
                btn.disabled = false;
            });
        });

        // Show popup after delay if no cookie
        if (!getCookie(COOKIE_NAME)) {
            setTimeout(syntraBwOpen, POPUP_DELAY);
        }
    })();
    </script>
    <?php
}

// ── AJAX handler — add bac water + apply coupon ──────────────────────────────
add_action( 'wp_ajax_syntra_add_bac_water',        'syntra_ajax_add_bac_water' );
add_action( 'wp_ajax_nopriv_syntra_add_bac_water', 'syntra_ajax_add_bac_water' );

function syntra_ajax_add_bac_water() {
    if ( ! check_ajax_referer( 'syntra_bac_water_nonce', 'nonce', false ) ) {
        wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
    }

    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( array( 'message' => 'WooCommerce not active' ) );
    }

    // Find the bac water product
    $product_id = null;
    $products   = wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) );
    foreach ( $products as $p ) {
        $slug  = $p->get_slug();
        $title = strtolower( $p->get_name() );
        if ( strpos( $slug, 'bac' ) !== false || strpos( $title, 'bacteriostatic' ) !== false || strpos( $title, 'bac water' ) !== false ) {
            $product_id = $p->get_id();
            break;
        }
    }

    if ( ! $product_id ) {
        wp_send_json_error( array( 'message' => 'Bac water product not found' ) );
    }

    // Add to cart
    $added = WC()->cart->add_to_cart( $product_id, 1 );
    if ( ! $added ) {
        wp_send_json_error( array( 'message' => 'Could not add to cart' ) );
    }

    // Apply coupon
    if ( ! WC()->cart->has_discount( 'FREEBACWATER' ) ) {
        WC()->cart->apply_coupon( 'FREEBACWATER' );
    }

    WC()->cart->calculate_totals();

    wp_send_json_success( array(
        'cart_url' => wc_get_cart_url(),
        'message'  => 'Added to cart',
    ) );
}
