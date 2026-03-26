<?php
/**
 * Syntra — Cart Template
 * Overrides: woocommerce/cart/cart.php
 */
defined( 'ABSPATH' ) || exit;
wc_print_notices();
do_action( 'woocommerce_before_cart' );
?>

<div class="syntra-cart-page">
  <div class="container">

    <!-- Progress Steps -->
    <div class="syntra-steps">
      <div class="syntra-step syntra-step--done">
        <div class="syntra-step__dot"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
        <span>Cart</span>
      </div>
      <div class="syntra-step__line"></div>
      <div class="syntra-step syntra-step--active">
        <div class="syntra-step__dot">2</div>
        <span>Details</span>
      </div>
      <div class="syntra-step__line"></div>
      <div class="syntra-step">
        <div class="syntra-step__dot">3</div>
        <span>Payment</span>
      </div>
      <div class="syntra-step__line"></div>
      <div class="syntra-step">
        <div class="syntra-step__dot">4</div>
        <span>Confirm</span>
      </div>
    </div>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
      <?php do_action( 'woocommerce_before_cart_table' ); ?>

      <div class="syntra-cart-layout">

        <!-- ── LEFT: Cart Items ── -->
        <div class="syntra-cart-items">
          <p class="mono-label">Research Order (<?php echo WC()->cart->get_cart_contents_count(); ?> <?php echo WC()->cart->get_cart_contents_count() === 1 ? 'item' : 'items'; ?>)</p>

          <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) continue;
            if ( ! apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) continue;

            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
          ?>
          <div class="syntra-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

            <!-- Thumbnail -->
            <div class="syntra-cart-item__img">
              <?php
              $thumb = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );
              echo $product_permalink ? '<a href="' . esc_url( $product_permalink ) . '">' . $thumb . '</a>' : $thumb;
              ?>
            </div>

            <!-- Info -->
            <div class="syntra-cart-item__info">
              <a class="syntra-cart-item__name" href="<?php echo esc_url( $product_permalink ); ?>">
                <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
              </a>

              <?php if ( ! empty( $cart_item['syntra_variant_label'] ) ) : ?>
              <div class="syntra-cart-item__variant">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
                <?php echo esc_html( $cart_item['syntra_variant_label'] ); ?>
              </div>
              <?php endif; ?>

              <?php if ( ! empty( $cart_item['syntra_bundle_discount'] ) && (int) $cart_item['syntra_bundle_discount'] > 0 ) : ?>
              <div class="syntra-cart-item__disc-badge"><?php echo esc_html( $cart_item['syntra_bundle_discount'] ); ?>% bundle discount</div>
              <?php endif; ?>

              <?php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ); ?>
              <p class="syntra-cart-item__compliance">For in vitro research use only.</p>
            </div>

            <!-- Right: price + qty + remove -->
            <div class="syntra-cart-item__right">
              <div class="syntra-cart-item__price">
                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
              </div>

              <div class="syntra-cart-item__qty-wrap">
                <?php
                if ( $_product->is_sold_individually() ) {
                  echo '<span class="syntra-cart-item__qty-single">Qty: 1</span>';
                  echo '<input type="hidden" name="cart[' . esc_attr( $cart_item_key ) . '][qty]" value="1" />';
                } else {
                  echo woocommerce_quantity_input(
                    [
                      'input_name'   => "cart[{$cart_item_key}][qty]",
                      'input_value'  => $cart_item['quantity'],
                      'max_value'    => $_product->get_max_purchase_quantity(),
                      'min_value'    => '0',
                      'product_name' => $_product->get_name(),
                    ],
                    $_product, false
                  );
                }
                ?>
              </div>

              <?php
              echo apply_filters(
                'woocommerce_cart_item_remove_link',
                sprintf(
                  '<a href="%s" class="syntra-cart-item__remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                  esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                  esc_html__( 'Remove this item from your cart', 'woocommerce' ),
                  esc_attr( $product_id ),
                  esc_attr( $_product->get_sku() )
                ),
                $cart_item_key
              );
              ?>
            </div>

          </div>
          <?php endforeach; ?>

          <?php do_action( 'woocommerce_cart_contents' ); ?>

          <!-- Coupon + Update row -->
          <div class="syntra-cart-actions">
            <?php if ( wc_coupons_enabled() ) : ?>
            <div class="syntra-coupon">
              <button type="button" class="syntra-coupon__toggle" id="syntraCouponToggle">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                Have a promo code?
              </button>
              <div class="syntra-coupon__form" id="syntraCouponForm" hidden>
                <?php do_action( 'woocommerce_cart_coupon' ); ?>
              </div>
            </div>
            <?php endif; ?>

            <button type="submit" class="syntra-update-btn" name="update_cart" value="Update">
              <?php esc_html_e( 'Update Cart', 'woocommerce' ); ?>
            </button>

            <?php do_action( 'woocommerce_cart_actions' ); ?>
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
          </div>

          <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        </div>

        <!-- ── RIGHT: Order Summary ── -->
        <div class="syntra-cart-summary">
          <div class="syntra-cart-summary__sticky">
            <p class="mono-label">Order Summary</p>

            <?php do_action( 'woocommerce_before_cart_totals' ); ?>

            <!-- Coupons -->
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <div class="syntra-summary-row syntra-summary-row--coupon">
              <span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
              <span class="syntra-summary-row__discount"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
            </div>
            <?php endforeach; ?>

            <!-- Fees -->
            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <div class="syntra-summary-row">
              <span><?php echo esc_html( $fee->name ); ?></span>
              <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
            </div>
            <?php endforeach; ?>

            <div class="syntra-summary-row">
              <span>Subtotal</span>
              <span><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>

            <?php if ( wc_shipping_enabled() && WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <div class="syntra-summary-row">
              <span>Shipping</span>
              <span class="syntra-summary-shipping"><?php wc_cart_totals_shipping_html(); ?></span>
            </div>
            <?php else : ?>
            <div class="syntra-summary-row">
              <span>Shipping</span>
              <span class="syntra-summary-row__note">Calculated at checkout</span>
            </div>
            <?php endif; ?>

            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
            <div class="syntra-summary-row">
              <span><?php echo esc_html( $tax->label ); ?></span>
              <span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

            <div class="syntra-summary-divider"></div>
            <div class="syntra-summary-total">
              <span>Total <small style="font-weight:400;font-size:11px;color:var(--slate);">(AUD incl. GST)</small></span>
              <span class="syntra-summary-total__amount"><?php wc_cart_totals_order_total_html(); ?></span>
            </div>

            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
            <?php do_action( 'woocommerce_after_cart_totals' ); ?>

            <!-- Checkout CTA -->
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="syntra-checkout-btn">
              Proceed to Checkout
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>

            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="syntra-continue-link">
              ← Continue Shopping
            </a>

            <!-- Trust Signals -->
            <div class="syntra-trust-grid">
              <div class="syntra-trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>Secure Checkout</span>
              </div>
              <div class="syntra-trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>99%+ Purity Verified</span>
              </div>
              <div class="syntra-trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                <span>Same-Day Dispatch*</span>
              </div>
              <div class="syntra-trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                <span>🇦🇺 Australian Company</span>
              </div>
            </div>

            <p class="syntra-cart-compliance">All compounds sold for in vitro laboratory research use only. Not for human consumption.</p>
          </div>
        </div>

      </div><!-- .syntra-cart-layout -->

      <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>

  </div><!-- .container -->
</div><!-- .syntra-cart-page -->

<?php do_action( 'woocommerce_after_cart' ); ?>

<script>
(function() {
  var toggle = document.getElementById('syntraCouponToggle');
  var form   = document.getElementById('syntraCouponForm');
  if (toggle && form) {
    toggle.addEventListener('click', function() {
      var hidden = form.hasAttribute('hidden');
      if (hidden) { form.removeAttribute('hidden'); toggle.style.color = 'var(--teal)'; }
      else        { form.setAttribute('hidden', ''); toggle.style.color = ''; }
    });
  }
})();
</script>
