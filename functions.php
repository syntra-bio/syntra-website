<?php
if ( ! defined( 'ABSPATH' ) ) exit;

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

require_once get_template_directory() . '/inc/product-data.php';

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
        [ 'syntra-fonts' ], '1.0.0' );

    // Theme JS
    wp_enqueue_script( 'syntra-js',
        get_template_directory_uri() . '/assets/js/syntra.js',
        [], '1.0.0', true );

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
   WOOCOMMERCE — REMOVE DEFAULT WRAPPERS
───────────────────────────────────────────────────────── */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', function() { echo '<div class="woo-wrap">'; }, 10 );
add_action( 'woocommerce_after_main_content',  function() { echo '</div>'; }, 10 );

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
