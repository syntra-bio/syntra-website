<?php
if ( ! defined( 'ABSPATH' ) ) exit;


require_once get_template_directory() . '/inc/product-data.php';
require_once get_template_directory() . '/inc/blog-data.php';
require_once get_template_directory() . '/inc/setup-wc-products.php';
require_once get_template_directory() . '/inc/syntra-variants.php';

/* ─────────────────────────────────────────────────────────
   THEME SETUP
───────────────────────────────────────────────────────── */
function syntra_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'syntra' ),
    ] );
}
add_action( 'after_setup_theme', 'syntra_setup' );

/* ─────────────────────────────────────────────────────────
   ENQUEUE SCRIPTS & STYLES
───────────────────────────────────────────────────────── */
function syntra_enqueue() {
    // Google Fonts
    wp_enqueue_style( 'syntra-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap',
        [], null );

    // Chart.js
    wp_enqueue_script( 'chartjs',
        'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
        [], '4.4.0', true );

    // Theme stylesheet
    wp_enqueue_style( 'syntra-style',
        get_template_directory_uri() . '/assets/css/syntra.css',
        [ 'syntra-fonts' ], '1.6.7' );

    // Theme JS
    wp_enqueue_script( 'syntra-js',
        get_template_directory_uri() . '/assets/js/syntra.js',
        [], '1.5.3', true );

    // Pass cart count to JS
    if ( class_exists( 'WooCommerce' ) ) {
        wp_localize_script( 'syntra-js', 'syntraData', [
            'cartCount' => WC()->cart ? WC()->cart->get_cart_contents_count() : 0,
            'cartUrl'   => wc_get_cart_url(),
            'shopUrl'   => get_permalink( wc_get_page_id( 'shop' ) ),
        ] );
    }
}
add_action( 'wp_enqueue_scripts', 'syntra_enqueue' );

/* ─────────────────────────────────────────────────────────
   STOCK STATUS AUTO-FIXER
   Runs once on admin load to patch all syntra product
   _stock_status values in the database so WC's own checks
   match our variant aggregate stock.
───────────────────────────────────────────────────────── */
// Runs on every admin page load until it has patched every product at least once.
// Transient key v4 forces a fresh run (invalidates any previously stuck v3 transient).
add_action( 'admin_init', 'syntra_patch_all_stock_statuses' );
function syntra_patch_all_stock_statuses() {
    if ( ! function_exists( 'syntra_variant_aggregate_stock' ) ) return;
    if ( get_transient( 'syntra_stock_patched_v4' ) ) return;

    global $wpdb;
    $ids = $wpdb->get_col(
        "SELECT DISTINCT post_id FROM {$wpdb->postmeta}
         WHERE meta_key = 'syntra_variants' AND meta_value != '' AND meta_value != 'a:0:{}'"
    );

    if ( empty( $ids ) ) {
        // No products found yet — set short transient and retry in 10 min
        set_transient( 'syntra_stock_patched_v4', 0, 10 * MINUTE_IN_SECONDS );
        return;
    }

    $count = 0;
    foreach ( $ids as $pid ) {
        $pid = (int) $pid;
        $agg = syntra_variant_aggregate_stock( $pid );
        if ( $agg === null ) continue;

        $status = ( $agg === 'onbackorder' ) ? 'onbackorder'
                : ( ( $agg === 'outofstock' ) ? 'outofstock' : 'instock' );

        update_post_meta( $pid, '_stock_status', $status );
        update_post_meta( $pid, '_manage_stock', 'no' );
        wc_delete_product_transients( $pid );
        $count++;
    }

    // Set transient for 1 week — force fresh run by changing key next deployment
    set_transient( 'syntra_stock_patched_v4', max( $count, 1 ), WEEK_IN_SECONDS );
}

/* ─────────────────────────────────────────────────────────
   THANK YOU PAGE — WORKS FOR BOTH CLASSIC + BLOCK CHECKOUT
   Classic mode: thankyou.php template override loads directly.
   Block mode:   WC ignores thankyou.php, so we hook into
                 woocommerce_thankyou and include our template.
                 CSS hides WC's default block-rendered output.
───────────────────────────────────────────────────────── */

// Filter for classic mode (belt-and-suspenders)
add_filter( 'wc_get_template', function( $template, $template_name ) {
    if ( $template_name !== 'checkout/thankyou.php' ) return $template;
    $theme_tpl = get_stylesheet_directory() . '/woocommerce/checkout/thankyou.php';
    return file_exists( $theme_tpl ) ? $theme_tpl : $template;
}, 10, 2 );

// Hook for block checkout mode — fires woocommerce_thankyou inside block context
add_action( 'woocommerce_thankyou', function( $order_id ) {
    // If our template already ran (classic mode), don't double-render
    if ( defined( 'SYNTRA_THANKYOU_LOADED' ) ) return;
    $order = wc_get_order( $order_id );
    if ( ! $order ) return;
    $tpl = get_stylesheet_directory() . '/woocommerce/checkout/thankyou.php';
    if ( file_exists( $tpl ) ) include $tpl;
}, 1 );

// Remove WC's default order table from the thankyou hook (we render our own)
remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );

/* ─────────────────────────────────────────────────────────
   WOOCOMMERCE — REMOVE DEFAULT WRAPPERS
───────────────────────────────────────────────────────── */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', function() { echo '<div class="woo-wrap">'; }, 10 );
add_action( 'woocommerce_after_main_content',  function() { echo '</div>'; }, 10 );

/* ─────────────────────────────────────────────────────────
   CHECKOUT — STEPS + TRUST SIGNALS + DISTRACTION-FREE
───────────────────────────────────────────────────────── */

// Add progress steps above checkout form
add_action( 'woocommerce_before_checkout_form', function() {
    echo '<div class="syntra-steps">';
    echo '<div class="syntra-step syntra-step--done"><div class="syntra-step__dot"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span>Cart</span></div>';
    echo '<div class="syntra-step__line"></div>';
    echo '<div class="syntra-step syntra-step--done"><div class="syntra-step__dot"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span>Details</span></div>';
    echo '<div class="syntra-step__line"></div>';
    echo '<div class="syntra-step syntra-step--active"><div class="syntra-step__dot">3</div><span>Payment</span></div>';
    echo '<div class="syntra-step__line"></div>';
    echo '<div class="syntra-step"><div class="syntra-step__dot">4</div><span>Confirm</span></div>';
    echo '</div>';
}, 5 );

// Trust strip above Place Order
add_action( 'woocommerce_review_order_after_order_total', function() {
    echo '<tr class="syntra-checkout-trust"><td colspan="2">
    <div class="syntra-checkout-trust__strip">
      <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> SSL Encrypted</span>
      <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> 99%+ Purity</span>
      <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg> Same-Day Dispatch</span>
    </div></td></tr>';
}, 20 );

// Force-fix stock status on products loaded into the cart session
// Ensures WC's cart validity check never incorrectly flags syntra products
add_filter( 'woocommerce_cart_item_product', function( $product, $cart_item, $cart_item_key ) {
    if ( ! $product || ! function_exists( 'syntra_variant_aggregate_stock' ) ) return $product;
    $agg = syntra_variant_aggregate_stock( $product->get_id() );
    if ( $agg === null ) return $product;
    if ( $agg !== 'outofstock' ) {
        $product->set_stock_status( 'instock' );
        $product->set_manage_stock( false );
    }
    return $product;
}, 10, 3 );

// Add checkout body class
add_filter( 'body_class', function( $classes ) {
    if ( is_checkout() ) $classes[] = 'syntra-checkout-page';
    if ( is_cart() )     $classes[] = 'syntra-cart-page-body';
    return $classes;
} );

// BACS payment description — styled HTML (works for both classic + block checkout)
add_filter( 'woocommerce_gateway_description', 'syntra_styled_bacs_description', 20, 2 );
function syntra_styled_bacs_description( $description, $gateway_id ) {
    if ( $gateway_id !== 'bacs' ) return $description;
    $bacs = WC()->payment_gateways()->payment_gateways()['bacs'] ?? null;
    if ( ! $bacs || empty( $bacs->account_details ) ) return $description;

    ob_start();
    foreach ( $bacs->account_details as $account ) {
        if ( empty( $account['account_name'] ) ) continue;
        ?>
        <div class="syntra-bacs-desc">
          <p class="syntra-bacs-desc__intro">Transfer <strong>after</strong> placing your order. Use your <strong>order number</strong> as the payment reference.</p>
          <div class="syntra-bacs-desc__table">
            <?php if ( ! empty( $account['account_name'] ) ) : ?>
            <div class="syntra-bacs-desc__row">
              <span class="syntra-bacs-desc__label">Account Name</span>
              <span class="syntra-bacs-desc__val"><?php echo esc_html( $account['account_name'] ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( ! empty( $account['bank_name'] ) ) : ?>
            <div class="syntra-bacs-desc__row">
              <span class="syntra-bacs-desc__label">Bank</span>
              <span class="syntra-bacs-desc__val"><?php echo esc_html( $account['bank_name'] ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( ! empty( $account['sort_code'] ) ) : ?>
            <div class="syntra-bacs-desc__row syntra-bacs-desc__row--em">
              <span class="syntra-bacs-desc__label">BSB</span>
              <span class="syntra-bacs-desc__val syntra-bacs-desc__val--mono"><?php echo esc_html( $account['sort_code'] ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( ! empty( $account['account_number'] ) ) : ?>
            <div class="syntra-bacs-desc__row syntra-bacs-desc__row--em">
              <span class="syntra-bacs-desc__label">Account Number</span>
              <span class="syntra-bacs-desc__val syntra-bacs-desc__val--mono"><?php echo esc_html( $account['account_number'] ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( ! empty( $account['iban'] ) ) : ?>
            <div class="syntra-bacs-desc__row">
              <span class="syntra-bacs-desc__label">IBAN</span>
              <span class="syntra-bacs-desc__val syntra-bacs-desc__val--mono"><?php echo esc_html( $account['iban'] ); ?></span>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php
    }
    return ob_get_clean();
}

/* ─────────────────────────────────────────────────────────
   WOOCOMMERCE — REMOVE DEFAULT SINGLE PRODUCT HOOKS
───────────────────────────────────────────────────────── */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title',       5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',      10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',       10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt',     20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',        40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing',     50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',           15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',  20 );

/* ─────────────────────────────────────────────────────────
   WOOCOMMERCE — REMOVE DEFAULT BREADCRUMBS
───────────────────────────────────────────────────────── */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/* ─────────────────────────────────────────────────────────
   CART COUNT FRAGMENT (AJAX update)
───────────────────────────────────────────────────────── */
function syntra_cart_count_fragment( $fragments ) {
    ob_start();
    $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    echo '<span class="cart-count js-cart-count"' . ( $count === 0 ? ' style="display:none"' : '' ) . '>' . $count . '</span>';
    $fragments['.js-cart-count'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'syntra_cart_count_fragment' );

/* ─────────────────────────────────────────────────────────
   CUSTOM META BOX — SYNTRA PRODUCT DATA
───────────────────────────────────────────────────────── */
function syntra_add_product_meta_box() {
    add_meta_box(
        'syntra_product_data',
        'Syntra Scientific Data',
        'syntra_product_meta_box_html',
        'product',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'syntra_add_product_meta_box' );

function syntra_product_meta_box_html( $post ) {
    wp_nonce_field( 'syntra_product_meta', 'syntra_product_meta_nonce' );
    $fields = [
        'syntra_batch'      => 'Batch Number (e.g. SYN-2601)',
        'syntra_purity'     => 'Purity % (e.g. 99.1)',
        'syntra_cas'        => 'CAS Number',
        'syntra_formula'    => 'Molecular Formula (e.g. C₁₄H₂₄CuN₆O₄)',
        'syntra_mw'         => 'Molecular Weight (e.g. 340.38 g/mol)',
        'syntra_storage'    => 'Storage (e.g. −20°C long-term / 2–8°C short-term)',
        'syntra_appearance' => 'Appearance',
        'syntra_solubility' => 'Solubility',
        'syntra_descriptor' => 'Descriptor (e.g. Copper Peptide Complex · Research Grade)',
        'syntra_category'   => 'Category (peptide / nootropic / longevity)',
    ];
    echo '<table style="width:100%;border-collapse:collapse;">';
    foreach ( $fields as $key => $label ) {
        $value = get_post_meta( $post->ID, $key, true );
        echo '<tr><td style="padding:6px 10px 6px 0;font-weight:600;white-space:nowrap;width:220px;">' . esc_html( $label ) . '</td>';
        echo '<td><input type="text" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:4px;"></td></tr>';
    }
    echo '</table>';
}

function syntra_save_product_meta( $post_id ) {
    if ( ! isset( $_POST['syntra_product_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['syntra_product_meta_nonce'], 'syntra_product_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [ 'syntra_batch', 'syntra_purity', 'syntra_cas', 'syntra_formula',
                'syntra_mw', 'syntra_storage', 'syntra_appearance', 'syntra_solubility',
                'syntra_descriptor', 'syntra_category' ];
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'syntra_save_product_meta' );

/* ─────────────────────────────────────────────────────────
   HELPER: GET SYNTRA PRODUCT DATA
   Falls back to the static data array if meta not set
───────────────────────────────────────────────────────── */
function syntra_get_product_data( $slug = '' ) {
    return isset( SYNTRA_PRODUCTS[ $slug ] ) ? SYNTRA_PRODUCTS[ $slug ] : null;
}

/* ─────────────────────────────────────────────────────────
   BLOG POST GENERATOR — Admin Tool
───────────────────────────────────────────────────────── */
function syntra_blog_generator_menu() {
    add_posts_page( 'Generate Blog Posts', 'Generate Blog Posts', 'manage_options', 'syntra-blog-generator', 'syntra_blog_generator_page' );
}
add_action( 'admin_menu', 'syntra_blog_generator_menu' );

function syntra_blog_generator_page() {
    $results = [];

    if ( isset( $_POST['syntra_generate_nonce'] ) && wp_verify_nonce( $_POST['syntra_generate_nonce'], 'syntra_generate_posts' ) ) {
        foreach ( SYNTRA_BLOG as $slug => $data ) {
            $existing = get_page_by_path( $slug, OBJECT, 'post' );
            if ( $existing ) {
                $results[] = '⏭ Already exists: ' . esc_html( $data['title'] );
                continue;
            }
            $id = wp_insert_post( [
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'post',
            ] );
            if ( is_wp_error( $id ) ) {
                $results[] = '❌ Failed: ' . esc_html( $data['title'] );
            } else {
                $results[] = '✅ Created: ' . esc_html( $data['title'] );
            }
        }
    }

    echo '<div class="wrap"><h1>Syntra Blog Post Generator</h1>';
    if ( $results ) {
        echo '<div class="notice notice-success"><ul>';
        foreach ( $results as $r ) echo '<li>' . esc_html( $r ) . '</li>';
        echo '</ul></div>';
    }
    echo '<form method="post">';
    wp_nonce_field( 'syntra_generate_posts', 'syntra_generate_nonce' );
    echo '<p>This will create all 20 peptide blog posts with the correct slugs. Already-existing posts are skipped.</p>';
    echo '<p><input type="submit" class="button button-primary button-large" value="Generate All 20 Blog Posts"></p>';
    echo '</form></div>';
}

/* ─────────────────────────────────────────────────────────
   GTM — WOOCOMMERCE DATALAYER EVENTS
───────────────────────────────────────────────────────── */

// view_item — fires on single product page
function syntra_gtm_view_item() {
    if ( ! is_product() ) return;
    global $product;
    if ( ! is_a( $product, 'WC_Product' ) ) return;
    ?>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'view_item',
        ecommerce: {
            currency: '<?php echo get_woocommerce_currency(); ?>',
            value: <?php echo (float) $product->get_price(); ?>,
            items: [{
                item_id: '<?php echo esc_js( $product->get_sku() ?: $product->get_id() ); ?>',
                item_name: '<?php echo esc_js( $product->get_name() ); ?>',
                price: <?php echo (float) $product->get_price(); ?>,
                quantity: 1
            }]
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'syntra_gtm_view_item' );

// add_to_cart — fires via WooCommerce AJAX fragment
function syntra_gtm_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id ) {
    $product = wc_get_product( $product_id );
    if ( ! $product ) return;
    WC()->session->set( 'syntra_gtm_add_to_cart', [
        'item_id'   => $product->get_sku() ?: $product_id,
        'item_name' => $product->get_name(),
        'price'     => (float) $product->get_price(),
        'quantity'  => $quantity,
        'currency'  => get_woocommerce_currency(),
    ]);
}
add_action( 'woocommerce_add_to_cart', 'syntra_gtm_add_to_cart', 10, 4 );

function syntra_gtm_add_to_cart_script() {
    if ( ! WC()->session ) return;
    $data = WC()->session->get( 'syntra_gtm_add_to_cart' );
    if ( ! $data ) return;
    WC()->session->set( 'syntra_gtm_add_to_cart', null );
    ?>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'add_to_cart',
        ecommerce: {
            currency: '<?php echo esc_js( $data['currency'] ); ?>',
            value: <?php echo (float) ( $data['price'] * $data['quantity'] ); ?>,
            items: [{
                item_id: '<?php echo esc_js( $data['item_id'] ); ?>',
                item_name: '<?php echo esc_js( $data['item_name'] ); ?>',
                price: <?php echo (float) $data['price']; ?>,
                quantity: <?php echo (int) $data['quantity']; ?>
            }]
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'syntra_gtm_add_to_cart_script' );

// begin_checkout — fires on checkout page
function syntra_gtm_begin_checkout() {
    if ( ! is_checkout() || is_order_received_page() ) return;
    $cart = WC()->cart;
    if ( ! $cart || $cart->is_empty() ) return;
    $items = [];
    foreach ( $cart->get_cart() as $item ) {
        $product = $item['data'];
        $items[] = [
            'item_id'   => $product->get_sku() ?: $product->get_id(),
            'item_name' => $product->get_name(),
            'price'     => (float) $product->get_price(),
            'quantity'  => (int) $item['quantity'],
        ];
    }
    ?>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'begin_checkout',
        ecommerce: {
            currency: '<?php echo get_woocommerce_currency(); ?>',
            value: <?php echo (float) $cart->get_total( 'edit' ); ?>,
            items: <?php echo wp_json_encode( $items ); ?>
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'syntra_gtm_begin_checkout' );

// purchase — fires on order confirmation page
function syntra_gtm_purchase() {
    if ( ! is_order_received_page() ) return;
    $order_id = get_query_var( 'order-received' );
    if ( ! $order_id ) return;
    // Only fire once per order
    if ( get_post_meta( $order_id, '_syntra_gtm_purchase_fired', true ) ) return;
    $order = wc_get_order( $order_id );
    if ( ! $order ) return;
    $items = [];
    foreach ( $order->get_items() as $item ) {
        $product = $item->get_product();
        $items[] = [
            'item_id'   => $product ? ( $product->get_sku() ?: $product->get_id() ) : $item->get_product_id(),
            'item_name' => $item->get_name(),
            'price'     => (float) ( $item->get_total() / $item->get_quantity() ),
            'quantity'  => (int) $item->get_quantity(),
        ];
    }
    update_post_meta( $order_id, '_syntra_gtm_purchase_fired', true );
    ?>
    <script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'purchase',
        ecommerce: {
            transaction_id: '<?php echo esc_js( $order->get_order_number() ); ?>',
            currency: '<?php echo esc_js( $order->get_currency() ); ?>',
            value: <?php echo (float) $order->get_total(); ?>,
            tax: <?php echo (float) $order->get_total_tax(); ?>,
            shipping: <?php echo (float) $order->get_shipping_total(); ?>,
            items: <?php echo wp_json_encode( $items ); ?>
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'syntra_gtm_purchase' );

/* ─────────────────────────────────────────────────────────
   CHECKOUT — Terms & Conditions acceptance checkbox
───────────────────────────────────────────────────────── */
add_action( 'woocommerce_review_order_before_submit', 'syntra_tc_checkbox' );
function syntra_tc_checkbox() {
    $tc_url     = esc_url( home_url( '/terms-and-conditions/' ) );
    $refund_url = esc_url( home_url( '/refund-policy/' ) );
    echo '<div class="syntra-tc-wrap">';
    woocommerce_form_field( 'syntra_tc_accepted', [
        'type'     => 'checkbox',
        'class'    => [ 'syntra-tc-field form-row-wide' ],
        'label'    => sprintf(
            'I have read and agree to the <a href="%s" target="_blank">Terms &amp; Conditions</a> and <a href="%s" target="_blank">Returns &amp; Refund Policy</a>. I confirm I am purchasing these compounds for legitimate in vitro laboratory research use only.',
            $tc_url,
            $refund_url
        ),
        'required' => true,
    ], 0 );
    echo '</div>';
}

add_action( 'woocommerce_checkout_process', 'syntra_tc_checkbox_validate' );
function syntra_tc_checkbox_validate() {
    if ( empty( $_POST['syntra_tc_accepted'] ) ) {
        wc_add_notice(
            'You must accept the Terms &amp; Conditions and confirm research use before completing your order.',
            'error'
        );
    }
}

/* ─────────────────────────────────────────────────────────
   BACK-IN-STOCK NOTIFY ME — form handler
───────────────────────────────────────────────────────── */
add_action( 'init', 'syntra_handle_notify_me' );
function syntra_handle_notify_me() {
    if ( empty( $_POST['syntra_notify_product_id'] ) ) return;
    if ( ! isset( $_POST['syntra_notify_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['syntra_notify_nonce'], 'syntra_notify' ) ) return;

    $product_id = absint( $_POST['syntra_notify_product_id'] );
    $email      = sanitize_email( $_POST['syntra_notify_email'] ?? '' );

    if ( ! is_email( $email ) || ! $product_id ) return;

    $key    = 'syntra_notify_' . $product_id;
    $emails = get_option( $key, [] );
    if ( ! in_array( $email, $emails, true ) ) {
        $emails[] = $email;
        update_option( $key, $emails, false );
    }

    wp_redirect( add_query_arg( 'notify', 'success', get_permalink( $product_id ) ) );
    exit;
}

/* ─────────────────────────────────────────────────────────
   BACK-IN-STOCK NOTIFY ME — admin page
───────────────────────────────────────────────────────── */
add_action( 'admin_menu', 'syntra_notify_admin_menu' );
function syntra_notify_admin_menu() {
    add_menu_page(
        'Back-in-Stock Signups',
        'Stock Alerts',
        'manage_woocommerce',
        'syntra-stock-alerts',
        'syntra_notify_admin_page',
        'dashicons-email-alt',
        58
    );
}

function syntra_notify_admin_page() {
    global $wpdb;
    // Gather all syntra_notify_* options
    $rows = $wpdb->get_results(
        "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE 'syntra\_notify\_%'",
        ARRAY_A
    );
    echo '<div class="wrap"><h1>Back-in-Stock Email Signups</h1>';
    if ( empty( $rows ) ) {
        echo '<p>No signups yet.</p></div>';
        return;
    }
    echo '<table class="widefat striped"><thead><tr><th>Product</th><th>Emails</th><th>Count</th></tr></thead><tbody>';
    foreach ( $rows as $row ) {
        $product_id = (int) str_replace( 'syntra_notify_', '', $row['option_name'] );
        $emails     = maybe_unserialize( $row['option_value'] );
        $product    = wc_get_product( $product_id );
        $name       = $product ? '<a href="' . get_edit_post_link( $product_id ) . '">' . esc_html( $product->get_name() ) . '</a>' : 'Product #' . $product_id;
        $email_list = is_array( $emails ) ? implode( '<br>', array_map( 'esc_html', $emails ) ) : esc_html( $emails );
        $count      = is_array( $emails ) ? count( $emails ) : 1;
        echo '<tr><td>' . $name . '</td><td>' . $email_list . '</td><td>' . $count . '</td></tr>';
    }
    echo '</tbody></table></div>';
}

/* ─────────────────────────────────────────────────────────
   SHIPPING — Express Post $9.95 / Free over $100
   Registers a shipping method so no WP Admin config needed.
   Works across all Australian shipping zones automatically.
───────────────────────────────────────────────────────── */
define( 'SYNTRA_FREE_SHIPPING_THRESHOLD', 100 );
define( 'SYNTRA_SHIPPING_COST', 9.95 );

// Register the shipping method class
add_filter( 'woocommerce_shipping_methods', function( $methods ) {
    $methods['syntra_express'] = 'Syntra_Express_Shipping';
    return $methods;
} );

class Syntra_Express_Shipping extends WC_Shipping_Method {

    public function __construct( $instance_id = 0 ) {
        $this->id                 = 'syntra_express';
        $this->instance_id        = absint( $instance_id );
        $this->method_title       = 'Syntra Express Post';
        $this->method_description = 'Express Post $9.95 — free for orders $100+';
        $this->supports           = [ 'shipping-zones', 'instance-settings' ];
        $this->init();
    }

    public function init() {
        $this->init_form_fields();
        $this->init_settings();
        $this->enabled = $this->get_option( 'enabled', 'yes' );
        $this->title   = $this->get_option( 'title', 'Express Post' );
        add_action( 'woocommerce_update_options_shipping_' . $this->id, [ $this, 'process_admin_options' ] );
    }

    public function init_form_fields() {
        $this->instance_form_fields = [
            'title' => [
                'title'   => 'Label',
                'type'    => 'text',
                'default' => 'Express Post',
            ],
        ];
    }

    public function calculate_shipping( $package = [] ) {
        $subtotal  = WC()->cart ? WC()->cart->get_subtotal() : 0;
        $threshold = SYNTRA_FREE_SHIPPING_THRESHOLD;
        $is_free   = $subtotal >= $threshold;

        $this->add_rate( [
            'id'    => $this->get_rate_id(),
            'label' => $is_free ? 'Express Post (Free)' : 'Express Post',
            'cost'  => $is_free ? 0 : SYNTRA_SHIPPING_COST,
        ] );
    }
}

// If there are NO shipping zones set up yet, force our method as a fallback
// so customers always see a shipping option at checkout
add_filter( 'woocommerce_package_rates', function( $rates, $package ) {
    if ( ! empty( $rates ) ) return $rates; // zones configured — leave them alone

    // No rates from zones — inject our method directly
    $subtotal  = WC()->cart ? WC()->cart->get_subtotal() : 0;
    $threshold = SYNTRA_FREE_SHIPPING_THRESHOLD;
    $is_free   = $subtotal >= $threshold;

    $rates['syntra_express_fallback'] = new WC_Shipping_Rate(
        'syntra_express_fallback',
        $is_free ? 'Express Post (Free)' : 'Express Post',
        $is_free ? 0 : SYNTRA_SHIPPING_COST,
        [],
        'syntra_express'
    );

    return $rates;
}, 100, 2 );

/* ─────────────────────────────────────────────────────────
   FREE SHIPPING PROGRESS TRACKER
   Shows on cart + checkout pages
───────────────────────────────────────────────────────── */

function syntra_free_shipping_tracker() {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) return;

    $threshold  = SYNTRA_FREE_SHIPPING_THRESHOLD;
    $cart_total = (float) WC()->cart->get_subtotal();
    $remaining  = max( 0, $threshold - $cart_total );
    $pct        = min( 100, round( ( $cart_total / $threshold ) * 100 ) );
    $unlocked   = $remaining <= 0;
    ?>
    <div class="shipping-tracker <?php echo $unlocked ? 'shipping-tracker--unlocked' : ''; ?>" id="shippingTracker">
      <div class="shipping-tracker__inner">
        <div class="shipping-tracker__text">
          <?php if ( $unlocked ) : ?>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            You've unlocked <strong>free shipping!</strong>
          <?php else : ?>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            Spend <strong>$<?php echo number_format( $remaining, 2 ); ?> more</strong> for free shipping
          <?php endif; ?>
        </div>
        <div class="shipping-tracker__bar-wrap">
          <div class="shipping-tracker__bar-fill" style="width:<?php echo esc_attr( $pct ); ?>%"></div>
        </div>
        <?php if ( ! $unlocked ) : ?>
        <div class="shipping-tracker__labels">
          <span>$0</span>
          <span>Free at $<?php echo number_format( $threshold, 0 ); ?></span>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'syntra_free_shipping_tracker' );
