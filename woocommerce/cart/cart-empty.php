<?php
/**
 * Syntra — Empty Cart Template
 * Overrides: woocommerce/cart/cart-empty.php
 */
defined( 'ABSPATH' ) || exit;
wc_print_notices();
do_action( 'woocommerce_cart_is_empty' );
$shop_url = get_permalink( wc_get_page_id( 'shop' ) );
?>
<div class="syntra-cart-empty">
  <div class="container">
    <div class="syntra-cart-empty__inner">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" class="syntra-cart-empty__icon">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <h2 class="syntra-cart-empty__heading">Your cart is empty</h2>
      <p class="syntra-cart-empty__sub">Browse our catalogue of precision research compounds — COA verified, 99%+ purity.</p>
      <a href="<?php echo esc_url( $shop_url ); ?>" class="syntra-checkout-btn" style="display:inline-flex;width:auto;">
        Browse Products
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <p class="syntra-cart-compliance" style="margin-top:24px;">For in vitro research use only · Not for human consumption</p>
    </div>
  </div>
</div>
