<?php
/**
 * Syntra — Order Confirmed / Thank You Page
 * Overrides: woocommerce/checkout/thankyou.php
 */
defined( 'ABSPATH' ) || exit;

// Flag so the woocommerce_thankyou hook knows the template already ran
if ( ! defined( 'SYNTRA_THANKYOU_LOADED' ) ) define( 'SYNTRA_THANKYOU_LOADED', true );

$is_bacs   = $order && $order->get_payment_method() === 'bacs';
$is_failed = $order && $order->get_status() === 'failed';
$bacs_due  = $is_bacs && $order && $order->has_status( [ 'pending', 'on-hold' ] );
?>

<div class="sty">
<div class="sty__inner">

<?php if ( $order ) :
  $bacs_gateway = WC()->payment_gateways()->payment_gateways()['bacs'] ?? null;
  $bacs_accs    = ( $bacs_gateway && ! empty( $bacs_gateway->account_details ) ) ? $bacs_gateway->account_details : [];
  $bacs_account = null;
  foreach ( $bacs_accs as $acc ) {
    if ( ! empty( $acc['account_name'] ) ) { $bacs_account = $acc; break; }
  }
?>

<!-- ═══════════════════════════════════════════
     ORDER RECEIVED HEADER
═══════════════════════════════════════════ -->
<div class="sty__hero">
  <div class="sty__hero-icon <?php echo $is_failed ? 'sty__hero-icon--fail' : 'sty__hero-icon--ok'; ?>">
    <?php if ( $is_failed ) : ?>
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
    <?php else : ?>
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
    <?php endif; ?>
  </div>
  <div class="sty__hero-text">
    <h1 class="sty__heading"><?php echo $is_failed ? 'Payment Failed' : 'Order received'; ?></h1>
    <p class="sty__sub">
      <?php if ( $is_failed ) : ?>
        Your order could not be processed. Please try again or <a href="mailto:support@syntra.bio">contact us</a>.
      <?php else : ?>
        Thank you. Your order has been received.
      <?php endif; ?>
    </p>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     ORDER DETAILS META BAR
═══════════════════════════════════════════ -->
<div class="sty__meta-bar">
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Order number</span>
    <span class="sty__meta-val"><?php echo esc_html( $order->get_order_number() ); ?></span>
  </div>
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Date</span>
    <span class="sty__meta-val"><?php echo esc_html( date_i18n( 'F j, Y', strtotime( $order->get_date_created() ) ) ); ?></span>
  </div>
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Total</span>
    <span class="sty__meta-val"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
  </div>
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Payment method</span>
    <span class="sty__meta-val"><?php echo esc_html( $order->get_payment_method_title() ); ?></span>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     BANK DETAILS BOX (BACS only)
═══════════════════════════════════════════ -->
<?php if ( $bacs_due && $bacs_account ) : ?>

<div class="sty__bank-box">
  <div class="sty__bank-box__header">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
    Our bank details
  </div>
  <div class="sty__bank-box__rows">
    <?php if ( ! empty( $bacs_account['account_name'] ) ) : ?>
    <div class="sty__bank-row">
      <span class="sty__bank-row__key"><?php echo esc_html( $bacs_account['account_name'] ); ?></span>
    </div>
    <?php endif; ?>
    <?php if ( ! empty( $bacs_account['bank_name'] ) ) : ?>
    <div class="sty__bank-row">
      <span class="sty__bank-row__label">Bank</span>
      <span class="sty__bank-row__val"><?php echo esc_html( $bacs_account['bank_name'] ); ?></span>
    </div>
    <?php endif; ?>
    <?php if ( ! empty( $bacs_account['account_number'] ) ) : ?>
    <div class="sty__bank-row sty__bank-row--mono">
      <span class="sty__bank-row__label">Account number</span>
      <span class="sty__bank-row__val">
        <?php echo esc_html( $bacs_account['account_number'] ); ?>
        <button type="button" class="sty__copy" data-copy="<?php echo esc_attr( $bacs_account['account_number'] ); ?>">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          Copy
        </button>
      </span>
    </div>
    <?php endif; ?>
    <?php if ( ! empty( $bacs_account['sort_code'] ) ) : ?>
    <div class="sty__bank-row sty__bank-row--mono">
      <span class="sty__bank-row__label">BSB</span>
      <span class="sty__bank-row__val">
        <?php echo esc_html( $bacs_account['sort_code'] ); ?>
        <button type="button" class="sty__copy" data-copy="<?php echo esc_attr( $bacs_account['sort_code'] ); ?>">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          Copy
        </button>
      </span>
    </div>
    <?php endif; ?>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     IMPORTANT NOTICE (red border + pill)
═══════════════════════════════════════════ -->
<div class="sty__important">
  <div class="sty__important__pill">⚠ Important</div>
  <p class="sty__important__text">
    Please transfer your order total to the account details above and use <strong>#<?php echo esc_html( $order->get_order_number() ); ?></strong> as your reference.
  </p>
  <p class="sty__important__text" style="margin-bottom:0;">
    Orders paid before 2PM Monday to Friday are dispatched same day. After 2PM or on weekends, dispatch will be the next business day.
  </p>
</div>

<?php endif; ?>

<!-- ═══════════════════════════════════════════
     ITEMS ORDERED (full width)
═══════════════════════════════════════════ -->
<div class="sty__items-section">
  <p class="mono-label sty__col-label">Items Ordered</p>

  <?php foreach ( $order->get_items() as $item_id => $item ) :
    $_product = $item->get_product();
    $img      = $_product ? $_product->get_image( 'thumbnail' ) : '';
    $variant  = $item->get_meta( 'Strength' ) ?: $item->get_meta( 'syntra_variant_label' );
  ?>
  <div class="sty__item">
    <div class="sty__item__img <?php echo $img ? '' : 'sty__item__img--empty'; ?>">
      <?php if ( $img ) : echo $img; else : ?>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
      <?php endif; ?>
    </div>
    <div class="sty__item__body">
      <span class="sty__item__name"><?php echo wp_kses_post( $item->get_name() ); ?></span>
      <?php if ( $variant ) : ?>
      <span class="sty__item__variant"><?php echo esc_html( $variant ); ?></span>
      <?php endif; ?>
      <span class="sty__item__qty">Qty: <?php echo (int) $item->get_quantity(); ?></span>
    </div>
    <span class="sty__item__price"><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></span>
  </div>
  <?php endforeach; ?>

  <div class="sty__totals">
    <div class="sty__totals__row">
      <span>Subtotal</span>
      <span><?php echo wp_kses_post( wc_price( $order->get_subtotal() ) ); ?></span>
    </div>
    <?php if ( $order->get_total_discount() > 0 ) : ?>
    <div class="sty__totals__row sty__totals__row--discount">
      <span>Discount</span>
      <span>−<?php echo wp_kses_post( wc_price( $order->get_total_discount() ) ); ?></span>
    </div>
    <?php endif; ?>
    <div class="sty__totals__row">
      <span>Shipping</span>
      <span><?php echo (float) $order->get_shipping_total() > 0 ? wp_kses_post( wc_price( $order->get_shipping_total() ) ) : 'Free'; ?></span>
    </div>
    <div class="sty__totals__row sty__totals__row--total">
      <span>Total</span>
      <span><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     SHIPPING + NEXT STEPS (horizontal, side by side)
═══════════════════════════════════════════ -->
<div class="sty__bottom-cols">

  <?php
  $ship_addr = $order->get_formatted_shipping_address();
  $bill_addr = $order->get_formatted_billing_address();
  $addr      = $ship_addr ?: $bill_addr;
  if ( $addr ) : ?>
  <div class="sty__card">
    <p class="mono-label sty__col-label">Shipping To</p>
    <address class="sty__address"><?php echo wp_kses_post( $addr ); ?></address>
  </div>
  <?php endif; ?>

  <div class="sty__card">
    <p class="mono-label sty__col-label">What Happens Next</p>
    <div class="sty__steps">

      <div class="sty__step sty__step--done">
        <div class="sty__step__dot"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg></div>
        <div class="sty__step__body">
          <strong>Order Confirmed</strong>
          <span>Confirmation sent to <?php echo esc_html( $order->get_billing_email() ); ?></span>
        </div>
      </div>

      <?php if ( $is_bacs ) : ?>
      <div class="sty__step <?php echo $bacs_due ? 'sty__step--active' : 'sty__step--done'; ?>">
        <div class="sty__step__dot"><?php echo $bacs_due ? '2' : '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>'; ?></div>
        <div class="sty__step__body">
          <strong>Bank Transfer</strong>
          <span><?php echo $bacs_due ? 'Transfer using the bank details above' : 'Payment received'; ?></span>
        </div>
      </div>
      <?php endif; ?>

      <div class="sty__step">
        <div class="sty__step__dot"><?php echo $is_bacs ? '3' : '2'; ?></div>
        <div class="sty__step__body">
          <strong>Dispatch</strong>
          <span>Same day before 2PM AEST Mon–Fri</span>
        </div>
      </div>

      <div class="sty__step">
        <div class="sty__step__dot"><?php echo $is_bacs ? '4' : '3'; ?></div>
        <div class="sty__step__body">
          <strong>Tracking Email</strong>
          <span>Tracking number sent to your email</span>
        </div>
      </div>

    </div>
  </div>

</div><!-- /.sty__bottom-cols -->

<!-- Actions -->
<div class="sty__actions">
  <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="syntra-checkout-btn" style="display:inline-flex;width:auto;min-width:220px;">
    Continue Shopping
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
  </a>
  <?php if ( is_user_logged_in() ) : ?>
  <a href="<?php echo esc_url( wc_get_account_endpoint_url('orders') ); ?>" class="sty__link">View My Orders</a>
  <?php endif; ?>
</div>

<?php else : ?>

<div class="sty__hero">
  <div class="sty__hero-icon sty__hero-icon--ok">
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
  </div>
  <div class="sty__hero-text">
    <h1 class="sty__heading">Order received</h1>
    <p class="sty__sub">Thank you. Your order has been received.</p>
  </div>
</div>

<?php endif; ?>

</div><!-- .sty__inner -->
</div><!-- .sty -->

<script>
document.addEventListener('click', function(e) {
  var btn = e.target.closest('.sty__copy');
  if (!btn) return;
  var text = btn.dataset.copy;
  if (!text) return;
  function flash() {
    var orig = btn.innerHTML;
    btn.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2FB7B3" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
    btn.classList.add('sty__copy--copied');
    setTimeout(function() { btn.innerHTML = orig; btn.classList.remove('sty__copy--copied'); }, 2000);
  }
  if (navigator.clipboard) {
    navigator.clipboard.writeText(text).then(flash).catch(function() {
      var el = document.createElement('textarea');
      el.value = text; el.style.cssText = 'position:fixed;opacity:0;top:0;left:0';
      document.body.appendChild(el); el.select();
      try { document.execCommand('copy'); flash(); } catch(x) {}
      document.body.removeChild(el);
    });
  } else {
    var el = document.createElement('textarea');
    el.value = text; el.style.cssText = 'position:fixed;opacity:0;top:0;left:0';
    document.body.appendChild(el); el.select();
    try { document.execCommand('copy'); flash(); } catch(x) {}
    document.body.removeChild(el);
  }
});
</script>
