<?php
/**
 * Syntra — Empty Cart Template
 * Overrides: woocommerce/cart/cart-empty.php
 */
defined( 'ABSPATH' ) || exit;
wc_print_notices();
do_action( 'woocommerce_cart_is_empty' );
$shop_url     = get_permalink( wc_get_page_id( 'shop' ) );
$top_products = wc_get_products( [ 'status' => 'publish', 'limit' => 4, 'orderby' => 'popularity', 'order' => 'DESC' ] );
?>

<div class="syntra-cart-empty">
  <div class="container">

    <!-- Empty state message -->
    <div class="syntra-cart-empty__inner">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" class="syntra-cart-empty__icon">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <h2 class="syntra-cart-empty__heading">Your cart is empty</h2>
      <p class="syntra-cart-empty__sub">Browse our most popular research compounds below — COA verified, 99%+ purity.</p>
    </div>

    <!-- Top products -->
    <?php if ( ! empty( $top_products ) ) : ?>
    <div class="syntra-empty-products">
      <p class="mono-label" style="text-align:center; margin-bottom:24px;">Best Sellers</p>
      <div class="syntra-empty-products__grid">
        <?php foreach ( $top_products as $product ) :
          $slug       = $product->get_slug();
          $pdata      = function_exists('syntra_get_product_data') ? syntra_get_product_data( $slug ) : null;
          $purity     = $pdata ? $pdata['purity']     : get_post_meta( $product->get_id(), 'syntra_purity', true );
          $batch      = $pdata ? $pdata['batch']      : get_post_meta( $product->get_id(), 'syntra_batch', true );
          $descriptor = $pdata ? $pdata['descriptor'] : get_post_meta( $product->get_id(), 'syntra_descriptor', true );
          $formula    = $pdata ? $pdata['formula']    : '';
          $mw         = $pdata ? $pdata['mw']         : '';
          $agg        = function_exists('syntra_variant_aggregate_stock') ? syntra_variant_aggregate_stock( $product->get_id() ) : null;
          if ( $agg === 'instock' || ( $agg === null && $product->is_in_stock() ) ) {
              $stock = 'In Stock'; $stock_cls = 'product-card__stock--in';
          } elseif ( $agg === 'onbackorder' ) {
              $stock = 'Backorder'; $stock_cls = 'product-card__stock--bo';
          } else {
              $stock = 'Out of Stock'; $stock_cls = 'product-card__stock--out';
          }
        ?>
        <a class="product-card" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
          <div class="product-card__img">
            <?php if ( $product->get_image_id() ) : ?>
              <?php echo $product->get_image( 'woocommerce_thumbnail' ); ?>
            <?php else : ?>
              <div class="product-card__img-placeholder">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="18" y="4" width="12" height="22" rx="2" fill="#E6EBF0"/><rect x="12" y="26" width="24" height="18" rx="2" fill="#E6EBF0"/><circle cx="24" cy="36" r="5" fill="none" stroke="#97AEC8" stroke-width="1.5"/></svg>
              </div>
            <?php endif; ?>
            <?php if ( $batch ) : ?><span class="product-card__batch"><?php echo esc_html( $batch ); ?></span><?php endif; ?>
            <?php if ( $purity ) : ?><span class="product-card__purity"><?php echo esc_html( $purity ); ?>%</span><?php endif; ?>
          </div>
          <div class="product-card__body">
            <?php if ( $descriptor ) : ?><div class="product-card__type"><?php echo esc_html( $descriptor ); ?></div><?php endif; ?>
            <div class="product-card__name"><?php echo esc_html( $product->get_name() ); ?></div>
            <?php if ( $formula && $mw ) : ?><div class="product-card__formula"><?php echo esc_html( $formula ); ?> · MW: <?php echo esc_html( $mw ); ?></div><?php endif; ?>
            <div class="product-card__footer">
              <div class="product-card__price"><?php echo $product->get_price_html(); ?></div>
              <div class="product-card__stock <?php echo esc_attr( $stock_cls ); ?>"><?php echo esc_html( $stock ); ?></div>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
      <div style="text-align:center; margin-top:32px;">
        <a href="<?php echo esc_url( $shop_url . '?sort=bestsellers' ); ?>" class="syntra-checkout-btn" style="display:inline-flex;width:auto;">
          View All Compounds
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
    <?php endif; ?>

    <p class="syntra-cart-compliance" style="text-align:center; margin-top:32px;">For in vitro research use only · Not for human consumption</p>
  </div>
</div>

<style>
.syntra-empty-products { margin-top: 48px; }
.syntra-empty-products__grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}
@media (min-width: 768px) {
  .syntra-empty-products__grid { grid-template-columns: repeat(4, 1fr); }
}
</style>
