<?php
/**
 * Free Bac Water popup — instant win flow
 * Custom email form -> AJAX -> adds to FluentCRM + cart + coupon simultaneously
 * No double opt-in, no waiting. Win state shows immediately on valid email.
 */

add_action( 'wp_footer', 'syntra_bac_water_popup' );

function syntra_bac_water_popup() {
    if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) return;
    $template = get_page_template_slug();
    if ( $template === 'page-locked-policy.php' || is_page( 'topical-ghkcu' ) ) return;

    $ajax_url = esc_js( admin_url( 'admin-ajax.php' ) );
    $nonce    = esc_js( wp_create_nonce( 'syntra_bac_water_nonce' ) );
    ?>

    <!-- BAC WATER POPUP -->
    <div id="bwpOverlay" role="dialog" aria-modal="true">
        <canvas id="bwpConfetti"></canvas>
        <div class="bwp-modal">
            <button class="bwp-close" id="bwpClose" aria-label="Close">&times;</button>

            <!-- Left panel: vial -->
            <div class="bwp-visual">
                <div class="bwp-glow"></div>
                <div class="bwp-free-tag">FREE</div>
                <div class="bwp-vial">
                    <div class="bwp-vial__cap"></div>
                    <div class="bwp-vial__body">
                        <div class="bwp-vial__brand">SYNTRA</div>
                        <div class="bwp-vial__name">BACTERIO&shy;STATIC WATER</div>
                        <div class="bwp-vial__vol">10ml &bull; Sterile</div>
                    </div>
                </div>
                <div class="bwp-price-wrap">
                    <span class="bwp-price-was" id="bwpPriceWas"></span>
                    <span class="bwp-price-free" id="bwpPriceFree" style="display:none;">FREE</span>
                </div>
            </div>

            <!-- Right panel: copy + form -->
            <div class="bwp-body">

                <!-- STATE 1: email form -->
                <div id="bwpStateForm">
                    <div class="bwp-eyebrow">Limited Offer</div>
                    <h2 class="bwp-title">Free Bacteriostatic<br>Water</h2>
                    <p class="bwp-sub">Enter your email. We send the code. You pay postage. That&rsquo;s it.</p>
                    <div class="bwp-input-row">
                        <input type="email" id="bwpEmail" class="bwp-input" placeholder="your@email.com" autocomplete="email">
                        <button class="bwp-btn" id="bwpSubmitBtn">Claim Free &rarr;</button>
                    </div>
                    <p class="bwp-input-error" id="bwpError" style="display:none;">Please enter a valid email.</p>
                    <p class="bwp-fine">No spam. Unsubscribe any time.</p>
                    <p class="bwp-no-thanks"><button id="bwpNoThanks">No thanks</button></p>
                </div>

                <!-- STATE 2: win state -->
                <div id="bwpStateWin" style="display:none;">
                    <div class="bwp-win-icon">&#10003;</div>
                    <div class="bwp-eyebrow" style="color:#4ade80;">You&rsquo;re In!</div>
                    <h2 class="bwp-title" style="font-size:20px;">Congratulations &mdash;<br>Your Vial Is Free</h2>

                    <div class="bwp-coupon-box">
                        <div class="bwp-coupon-label">Your Coupon Code</div>
                        <div class="bwp-coupon-row">
                            <span class="bwp-coupon-code">FREEBACWATER</span>
                            <button class="bwp-copy-btn" id="bwpCopyBtn">Copy</button>
                        </div>
                    </div>

                    <div class="bwp-saving-row">
                        <span class="bwp-saving-label">You save:</span>
                        <span class="bwp-saving-amount" id="bwpSavingAmt"></span>
                    </div>

                    <button class="bwp-btn bwp-btn--win" id="bwpViewCart">
                        <span id="bwpCartBtnText">View Cart &rarr;</span>
                        <span id="bwpCartBtnLoading" style="display:none;">Adding to cart...</span>
                    </button>
                    <p class="bwp-fine" style="margin-top:10px;">Coupon applied automatically. Just pay shipping.</p>
                </div>

            </div>
        </div>
    </div>

    <style>
    #bwpOverlay {
        display: none; position: fixed; inset: 0; z-index: 99999;
        background: rgba(10,20,35,0.85);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        align-items: center; justify-content: center; padding: 16px;
    }
    #bwpOverlay.open { display: flex; }
    #bwpConfetti { position: fixed; inset: 0; pointer-events: none; z-index: 100000; }

    .bwp-modal {
        background: #162840;
        border: 1px solid rgba(151,174,200,0.18);
        border-radius: 18px;
        width: 100%; max-width: 640px;
        display: flex; flex-direction: column;
        overflow: hidden; position: relative;
        animation: bwpIn 0.38s cubic-bezier(0.22,1,0.36,1);
    }
    @media(min-width:580px){ .bwp-modal { flex-direction: row; } }
    @keyframes bwpIn { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }

    .bwp-close {
        position: absolute; top: 12px; right: 14px; z-index: 2;
        background: none; border: none; color: rgba(151,174,200,0.5);
        font-size: 22px; line-height: 1; cursor: pointer; transition: color .2s;
    }
    .bwp-close:hover { color: #fff; }

    /* Visual panel */
    .bwp-visual {
        background: linear-gradient(150deg, #111e2e 0%, #1F3552 100%);
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 40px 28px; gap: 16px; position: relative; flex-shrink: 0;
    }
    @media(min-width:580px){ .bwp-visual { width: 190px; } }

    .bwp-glow {
        position: absolute; width: 130px; height: 130px;
        background: radial-gradient(circle, rgba(47,183,179,0.22) 0%, transparent 70%);
        border-radius: 50%; pointer-events: none;
    }
    .bwp-free-tag {
        position: absolute; top: 16px; left: 16px;
        background: #2FB7B3; color: #fff;
        font-family: 'IBM Plex Mono', monospace; font-size: 9px; font-weight: 500;
        letter-spacing: .14em; text-transform: uppercase;
        padding: 4px 10px; border-radius: 100px;
    }
    .bwp-vial {
        width: 76px; height: 160px;
        background: linear-gradient(160deg, rgba(151,174,200,0.12) 0%, rgba(20,42,68,0.85) 100%);
        border: 1px solid rgba(151,174,200,0.22);
        border-radius: 7px 7px 12px 12px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        position: relative; animation: bwpFloat 4s ease-in-out infinite;
    }
    @keyframes bwpFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-11px)} }
    .bwp-vial__cap {
        width: 34px; height: 9px;
        background: #0f1e30; border: 1px solid rgba(151,174,200,0.25);
        border-radius: 3px; position: absolute; top: -6px;
    }
    .bwp-vial__body { text-align: center; padding: 0 6px; }
    .bwp-vial__brand { font-family: 'IBM Plex Mono', monospace; font-size: 6px; letter-spacing: .2em; text-transform: uppercase; color: #2FB7B3; margin-bottom: 3px; }
    .bwp-vial__name { font-family: 'IBM Plex Mono', monospace; font-size: 7px; font-weight: 500; color: #fff; letter-spacing: .05em; line-height: 1.4; }
    .bwp-vial__vol { font-family: 'IBM Plex Mono', monospace; font-size: 6px; color: #97AEC8; margin-top: 5px; }

    .bwp-price-wrap { display: flex; align-items: center; gap: 8px; }
    .bwp-price-was { font-family: 'IBM Plex Mono', monospace; font-size: 14px; color: rgba(151,174,200,0.5); text-decoration: line-through; }
    .bwp-price-free { font-family: 'IBM Plex Mono', monospace; font-size: 16px; font-weight: 500; color: #2FB7B3; }

    /* Body panel */
    .bwp-body { padding: 28px 24px; flex: 1; display: flex; flex-direction: column; justify-content: center; }
    .bwp-eyebrow { font-family: 'IBM Plex Mono', monospace; font-size: 9px; letter-spacing: .16em; text-transform: uppercase; color: #2FB7B3; margin-bottom: 8px; }
    .bwp-title { font-family: 'Inter', sans-serif; font-size: 22px; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; color: #fff; line-height: 1.1; margin-bottom: 10px; }
    .bwp-sub { font-size: 13px; color: #97AEC8; line-height: 1.55; margin-bottom: 20px; }

    .bwp-input-row { display: flex; gap: 0; margin-bottom: 8px; }
    .bwp-input {
        flex: 1; padding: 13px 14px;
        background: rgba(255,255,255,0.07); border: 1px solid rgba(151,174,200,0.22);
        border-right: none; border-radius: 8px 0 0 8px;
        font-family: 'Inter', sans-serif; font-size: 14px; color: #fff; outline: none;
        transition: border-color .2s;
    }
    .bwp-input::placeholder { color: rgba(151,174,200,0.4); }
    .bwp-input:focus { border-color: #2FB7B3; }
    .bwp-input.error { border-color: #ef4444; }
    .bwp-btn {
        padding: 13px 18px; background: #2FB7B3; border: none;
        border-radius: 0 8px 8px 0;
        font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600;
        letter-spacing: .05em; text-transform: uppercase; color: #fff;
        cursor: pointer; white-space: nowrap; transition: opacity .2s;
    }
    .bwp-btn:hover { opacity: .88; }
    .bwp-btn:disabled { opacity: .5; cursor: not-allowed; }
    .bwp-btn--win { display: block; width: 100%; border-radius: 8px; padding: 14px 18px; margin-top: 16px; }
    .bwp-input-error { font-size: 11px; color: #f87171; margin-bottom: 8px; }
    .bwp-fine { font-size: 11px; color: rgba(151,174,200,0.35); margin-top: 8px; }
    .bwp-no-thanks { margin-top: 12px; }
    .bwp-no-thanks button { background: none; border: none; font-size: 11px; color: rgba(151,174,200,0.3); cursor: pointer; text-decoration: underline; }
    .bwp-no-thanks button:hover { color: rgba(151,174,200,0.55); }

    /* Win state */
    .bwp-win-icon {
        width: 40px; height: 40px; border-radius: 50%;
        background: rgba(74,222,128,0.15); border: 1px solid rgba(74,222,128,0.3);
        color: #4ade80; font-size: 20px; display: flex; align-items: center; justify-content: center;
        margin-bottom: 12px;
    }
    .bwp-coupon-box {
        background: rgba(47,183,179,0.08); border: 1px solid rgba(47,183,179,0.25);
        border-radius: 10px; padding: 14px 16px; margin: 16px 0 12px;
    }
    .bwp-coupon-label { font-family: 'IBM Plex Mono', monospace; font-size: 9px; letter-spacing: .12em; text-transform: uppercase; color: rgba(151,174,200,0.55); margin-bottom: 8px; }
    .bwp-coupon-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
    .bwp-coupon-code { font-family: 'IBM Plex Mono', monospace; font-size: 18px; font-weight: 500; color: #fff; letter-spacing: .06em; }
    .bwp-copy-btn {
        background: rgba(47,183,179,0.15); border: 1px solid rgba(47,183,179,0.35);
        border-radius: 6px; padding: 5px 12px;
        font-family: 'IBM Plex Mono', monospace; font-size: 10px; letter-spacing: .08em; text-transform: uppercase;
        color: #2FB7B3; cursor: pointer; transition: background .2s;
    }
    .bwp-copy-btn:hover { background: rgba(47,183,179,0.28); }
    .bwp-copy-btn.copied { color: #4ade80; border-color: rgba(74,222,128,0.35); background: rgba(74,222,128,0.1); }

    .bwp-saving-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-top: 1px solid rgba(151,174,200,0.1); border-bottom: 1px solid rgba(151,174,200,0.1); }
    .bwp-saving-label { font-size: 13px; color: #97AEC8; }
    .bwp-saving-amount { font-family: 'IBM Plex Mono', monospace; font-size: 16px; font-weight: 500; color: #4ade80; }
    </style>

    <script>
    (function(){
        var COOKIE   = 'syntra_bw_popup';
        var AJAX_URL = '<?php echo $ajax_url; ?>';
        var NONCE    = '<?php echo $nonce; ?>';

        function getCookie(n){ var m=document.cookie.match(new RegExp('(^| )'+n+'=([^;]+)')); return m?m[2]:null; }
        function setCookie(n,v,d){ var e=new Date(); e.setTime(e.getTime()+d*86400000); document.cookie=n+'='+v+';expires='+e.toUTCString()+';path=/'; }
        function validEmail(e){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e); }

        var overlay = document.getElementById('bwpOverlay');

        function open(){ overlay.classList.add('open'); document.body.style.overflow='hidden'; }
        function close(){ overlay.classList.remove('open'); document.body.style.overflow=''; setCookie(COOKIE,'dismissed',7); }

        window.syntraBwClose = close;
        document.getElementById('bwpClose').addEventListener('click', close);
        document.getElementById('bwpNoThanks').addEventListener('click', close);
        overlay.addEventListener('click', function(e){ if(e.target===overlay) close(); });
        document.addEventListener('keydown', function(e){ if(e.key==='Escape') close(); });

        // ── Confetti ────────────────────────────────────────────────────────────
        function launchConfetti() {
            var canvas  = document.getElementById('bwpConfetti');
            var ctx     = canvas.getContext('2d');
            canvas.width  = window.innerWidth;
            canvas.height = window.innerHeight;
            var pieces  = [];
            var colors  = ['#2FB7B3','#97AEC8','#4ade80','#ffffff','#1F3552'];
            for(var i=0;i<120;i++){
                pieces.push({
                    x: Math.random()*canvas.width,
                    y: Math.random()*canvas.height - canvas.height,
                    w: Math.random()*8+4, h: Math.random()*5+3,
                    color: colors[Math.floor(Math.random()*colors.length)],
                    rot: Math.random()*360,
                    vx: (Math.random()-0.5)*4,
                    vy: Math.random()*4+2,
                    vr: (Math.random()-0.5)*6
                });
            }
            var end = Date.now() + 2800;
            function draw(){
                ctx.clearRect(0,0,canvas.width,canvas.height);
                pieces.forEach(function(p){
                    ctx.save();
                    ctx.translate(p.x,p.y);
                    ctx.rotate(p.rot*Math.PI/180);
                    ctx.fillStyle = p.color;
                    ctx.fillRect(-p.w/2,-p.h/2,p.w,p.h);
                    ctx.restore();
                    p.x+=p.vx; p.y+=p.vy; p.rot+=p.vr;
                });
                if(Date.now()<end) requestAnimationFrame(draw);
                else ctx.clearRect(0,0,canvas.width,canvas.height);
            }
            draw();
        }

        // ── Submit ───────────────────────────────────────────────────────────────
        function handleSubmit() {
            var email = document.getElementById('bwpEmail').value.trim();
            var errEl = document.getElementById('bwpError');
            var input = document.getElementById('bwpEmail');
            if(!validEmail(email)){
                input.classList.add('error');
                errEl.style.display = 'block';
                input.focus();
                return;
            }
            input.classList.remove('error');
            errEl.style.display = 'none';

            var btn = document.getElementById('bwpSubmitBtn');
            btn.disabled = true;
            btn.textContent = 'Claiming...';

            jQuery.post(AJAX_URL, {
                action: 'syntra_claim_bac_water',
                nonce:  NONCE,
                email:  email
            }, function(res){
                if(res.success){
                    setCookie(COOKIE, 'claimed', 30);
                    // Show price strikethrough
                    if(res.data && res.data.price){
                        document.getElementById('bwpPriceWas').textContent = '$' + res.data.price + ' AUD';
                        document.getElementById('bwpPriceWas').style.display = 'inline';
                        document.getElementById('bwpPriceFree').style.display = 'inline';
                        document.getElementById('bwpSavingAmt').textContent = '-$' + res.data.price + ' AUD';
                    }
                    // Switch to win state
                    document.getElementById('bwpStateForm').style.display = 'none';
                    document.getElementById('bwpStateWin').style.display  = 'block';
                    launchConfetti();
                } else {
                    btn.disabled = false;
                    btn.textContent = 'Claim Free \u2192';
                    errEl.textContent = res.data && res.data.message ? res.data.message : 'Something went wrong. Try again.';
                    errEl.style.display = 'block';
                }
            }).fail(function(){
                btn.disabled = false;
                btn.textContent = 'Claim Free \u2192';
            });
        }

        document.getElementById('bwpSubmitBtn').addEventListener('click', handleSubmit);
        document.getElementById('bwpEmail').addEventListener('keydown', function(e){ if(e.key==='Enter') handleSubmit(); });

        // ── Copy coupon ──────────────────────────────────────────────────────────
        document.getElementById('bwpCopyBtn').addEventListener('click', function(){
            navigator.clipboard.writeText('FREEBACWATER').then(function(){
                var b = document.getElementById('bwpCopyBtn');
                b.textContent = 'Copied!'; b.classList.add('copied');
                setTimeout(function(){ b.textContent='Copy'; b.classList.remove('copied'); }, 2000);
            });
        });

        // ── View cart ────────────────────────────────────────────────────────────
        document.getElementById('bwpViewCart').addEventListener('click', function(){
            document.getElementById('bwpCartBtnText').style.display    = 'none';
            document.getElementById('bwpCartBtnLoading').style.display = 'inline';
            this.disabled = true;
            close();
            var drawer = document.getElementById('cartDrawer') || document.querySelector('.cart-drawer');
            if(drawer){
                drawer.classList.add('is-open');
                document.body.classList.add('cart-open');
                document.body.style.overflow = 'hidden';
            } else {
                window.location.href = '<?php echo esc_js( wc_get_cart_url() ); ?>';
            }
        });

        // ── Show popup ───────────────────────────────────────────────────────────
        if(!getCookie(COOKIE)){
            setTimeout(open, 5000);
        }
    })();
    </script>
    <?php
}

// ── AJAX: capture email + add to cart + apply coupon ─────────────────────────
add_action( 'wp_ajax_syntra_claim_bac_water',        'syntra_ajax_claim_bac_water' );
add_action( 'wp_ajax_nopriv_syntra_claim_bac_water', 'syntra_ajax_claim_bac_water' );

function syntra_ajax_claim_bac_water() {
    if ( ! check_ajax_referer( 'syntra_bac_water_nonce', 'nonce', false ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }

    $email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please enter a valid email.' ) );
    }

    // ── 1. Add to FluentCRM ──────────────────────────────────────────────────
    if ( function_exists( 'FluentCrmApi' ) ) {
        $contact_api = FluentCrmApi( 'contacts' );

        // Resolve list ID by slug
        $list_id = null;
        if ( class_exists( '\FluentCrm\App\Models\Lists' ) ) {
            $list = \FluentCrm\App\Models\Lists::where( 'slug', 'newsletter' )->first();
            if ( $list ) $list_id = $list->id;
        }

        // Resolve tag IDs by slug
        $tag_ids = array();
        if ( class_exists( '\FluentCrm\App\Models\Tag' ) ) {
            $tags = \FluentCrm\App\Models\Tag::whereIn( 'slug', array( 'bac-water-lead', 'ad-traffic' ) )->get();
            foreach ( $tags as $tag ) $tag_ids[] = $tag->id;
        }

        $contact_data = array(
            'email'  => $email,
            'status' => 'subscribed',
        );
        if ( $list_id )      $contact_data['lists'] = array( $list_id );
        if ( ! empty( $tag_ids ) ) $contact_data['tags'] = $tag_ids;

        $contact_api->createOrUpdate( $contact_data );
    }

    // ── 2. Find bac water product ────────────────────────────────────────────
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( array( 'message' => 'Store unavailable.' ) );
    }

    $product_id = null;
    $price      = null;
    $products   = wc_get_products( array( 'status' => 'publish', 'limit' => 50 ) );
    foreach ( $products as $p ) {
        $title = strtolower( $p->get_name() );
        if ( strpos( $title, 'bacteriostatic' ) !== false || strpos( $title, 'bac water' ) !== false ) {
            $product_id = $p->get_id();
            $price      = $p->get_price();
            break;
        }
    }

    if ( ! $product_id ) {
        wp_send_json_error( array( 'message' => 'Product not found.' ) );
    }

    // ── 3. Add to cart + apply coupon ────────────────────────────────────────
    WC()->cart->add_to_cart( $product_id, 1 );
    if ( ! WC()->cart->has_discount( 'FREEBACWATER' ) ) {
        WC()->cart->apply_coupon( 'FREEBACWATER' );
    }
    WC()->cart->calculate_totals();

    wp_send_json_success( array(
        'price'    => number_format( (float) $price, 2 ),
        'cart_url' => wc_get_cart_url(),
    ) );
}
