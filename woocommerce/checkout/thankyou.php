<?php
/**
 * Syntra — Order Confirmed / Thank You Page
 * Overrides: woocommerce/checkout/thankyou.php
 */
defined( 'ABSPATH' ) || exit;

$is_bacs   = $order && $order->get_payment_method() === 'bacs';
$is_failed = $order && $order->get_status() === 'failed';
$bacs_due  = $is_bacs && $order && $order->has_status( [ 'pending', 'on-hold' ] );
?>

<div class="sty"><!-- syntra-thankyou root -->
<div class="container">

<?php if ( $order ) :
  $bacs_gateway = WC()->payment_gateways()->payment_gateways()['bacs'] ?? null;
  $bacs_accs    = ( $bacs_gateway && ! empty( $bacs_gateway->account_details ) ) ? $bacs_gateway->account_details : [];
  $bacs_account = null;
  foreach ( $bacs_accs as $acc ) {
    if ( ! empty( $acc['account_name'] ) ) { $bacs_account = $acc; break; }
  }
?>

<!-- ══ HERO ══════════════════════════════════════════════ -->
<div class="sty__hero">
  <div class="sty__hero-icon <?php echo $is_failed ? 'sty__hero-icon--fail' : 'sty__hero-icon--ok'; ?>">
    <?php if ( $is_failed ) : ?>
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
    <?php else : ?>
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
    <?php endif; ?>
  </div>
  <div>
    <h1 class="sty__heading"><?php echo $is_failed ? 'Payment Failed' : 'Order Confirmed'; ?></h1>
    <p class="sty__sub">
      <?php if ( $is_failed ) : ?>
        Your order could not be processed. Please try again or <a href="mailto:support@syntra.bio">contact us</a>.
      <?php else : ?>
        Thank you, <strong><?php echo esc_html( $order->get_billing_first_name() ); ?></strong>. Your research order has been received.
      <?php endif; ?>
    </p>
  </div>
</div>

<!-- ══ ORDER META BAR ═══════════════════════════════════ -->
<div class="sty__meta-bar">
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Order</span>
    <span class="sty__meta-val">#<?php echo esc_html( $order->get_order_number() ); ?></span>
  </div>
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Date</span>
    <span class="sty__meta-val"><?php echo esc_html( date_i18n( 'd M Y', strtotime( $order->get_date_created() ) ) ); ?></span>
  </div>
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Total</span>
    <span class="sty__meta-val"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
  </div>
  <div class="sty__meta-cell">
    <span class="sty__meta-label">Payment</span>
    <span class="sty__meta-val"><?php echo esc_html( $order->get_payment_method_title() ); ?></span>
  </div>
</div>

<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

<!-- ══ BACS TRANSFER INSTRUCTIONS ════════════════════════ -->
<?php if ( $bacs_due && $bacs_account ) : ?>
<div class="sty__bacs">

  <div class="sty__bacs-header">
    <div class="sty__bacs-header-left">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
      <span>Bank Transfer Instructions</span>
    </div>
    <span class="sty__bacs-badge">Action Required</span>
  </div>

  <p class="sty__bacs-intro">Your order is <strong>reserved</strong>. Transfer the exact amount below — we dispatch once payment clears.</p>

  <!-- Static account info (name + bank) -->
  <div class="sty__bacs-info">
    <?php if ( ! empty( $bacs_account['account_name'] ) ) : ?>
    <div class="sty__bacs-info-row">
      <span>Account Name</span>
      <strong><?php echo esc_html( $bacs_account['account_name'] ); ?></strong>
    </div>
    <?php endif; ?>
    <?php if ( ! empty( $bacs_account['bank_name'] ) ) : ?>
    <div class="sty__bacs-info-row">
      <span>Bank</span>
      <strong><?php echo esc_html( $bacs_account['bank_name'] ); ?></strong>
    </div>
    <?php endif; ?>
    <div class="sty__bacs-info-row">
      <span>Amount to Transfer</span>
      <strong class="sty__bacs-amount"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
    </div>
  </div>

  <!-- BSB — full width block -->
  <?php if ( ! empty( $bacs_account['sort_code'] ) ) : ?>
  <div class="sty__bacs-field">
    <div class="sty__bacs-field__label">BSB</div>
    <div class="sty__bacs-field__row">
      <span class="sty__bacs-field__number"><?php echo esc_html( $bacs_account['sort_code'] ); ?></span>
      <button type="button" class="sty__copy" data-copy="<?php echo esc_attr( $bacs_account['sort_code'] ); ?>">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        Copy
      </button>
    </div>
  </div>
  <?php endif; ?>

  <!-- Account Number — full width block -->
  <?php if ( ! empty( $bacs_account['account_number'] ) ) : ?>
  <div class="sty__bacs-field">
    <div class="sty__bacs-field__label">Account Number</div>
    <div class="sty__bacs-field__row">
      <span class="sty__bacs-field__number"><?php echo esc_html( $bacs_account['account_number'] ); ?></span>
      <button type="button" class="sty__copy" data-copy="<?php echo esc_attr( $bacs_account['account_number'] ); ?>">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        Copy
      </button>
    </div>
  </div>
  <?php endif; ?>

  <!-- Reference — most critical -->
  <div class="sty__bacs-ref">
    <div class="sty__bacs-ref__label">
      Payment Reference
      <span class="sty__bacs-ref__required">Must include this</span>
    </div>
    <div class="sty__bacs-ref__row">
      <span class="sty__bacs-ref__number"><?php echo esc_html( $order->get_order_number() ); ?></span>
      <button type="button" class="sty__copy sty__copy--light" data-copy="<?php echo esc_attr( $order->get_order_number() ); ?>">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        Copy
      </button>
    </div>
    <p class="sty__bacs-ref__note">Without a reference we cannot match your payment.</p>
  </div>

  <!-- Steps -->
  <ol class="sty__bacs-steps">
    <li>Open your banking app and go to <strong>Pay Anyone / Transfer</strong></li>
    <li>Enter <strong>BSB <?php echo ! empty( $bacs_account['sort_code'] ) ? esc_html( $bacs_account['sort_code'] ) : '—'; ?></strong> and account number <strong><?php echo ! empty( $bacs_account['account_number'] ) ? esc_html( $bacs_account['account_number'] ) : '—'; ?></strong></li>
    <li>Set the reference to <strong><?php echo esc_html( $order->get_order_number() ); ?></strong></li>
    <li>Transfer exactly <strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong> and submit</li>
  </ol>

  <p class="sty__bacs-footer">Questions? <a href="mailto:support@syntra.bio">support@syntra.bio</a> — include your order number.</p>
</div>
<?php endif; ?>

<!-- ══ TWO-COLUMN LAYOUT: items left, sidebar right ══════ -->
<div class="sty__cols">

  <!-- Left: Order items -->
  <div class="sty__items-col">
    <p class="mono-label">Items Ordered</p>

    <?php foreach ( $order->get_items() as $item_id => $item ) :
      $_product  = $item->get_product();
      $img       = $_product ? $_product->get_image( 'thumbnail' ) : '';
      $variant   = $item->get_meta( 'Strength' ) ?: $item->get_meta( 'syntra_variant_label' );
    ?>
    <div class="sty__item">
      <?php if ( $img ) : ?>
      <div class="sty__item__img"><?php echo $img; ?></div>
      <?php endif; ?>
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

    <!-- Totals -->
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
      <?php if ( (float) $order->get_shipping_total() > 0 ) : ?>
      <div class="sty__totals__row">
        <span>Shipping</span>
        <span><?php echo wp_kses_post( wc_price( $order->get_shipping_total() ) ); ?></span>
      </div>
      <?php else : ?>
      <div class="sty__totals__row sty__totals__row--free">
        <span>Shipping</span>
        <span>Free</span>
      </div>
      <?php endif; ?>
      <div class="sty__totals__row sty__totals__row--total">
        <span>Total</span>
        <span><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
      </div>
    </div>
  </div>

  <!-- Right: Address + What's next -->
  <div class="sty__side-col">

    <?php if ( $order->get_shipping_address_1() ) : ?>
    <div class="sty__card">
      <p class="mono-label" style="margin-bottom:12px;">Shipping To</p>
      <address class="sty__address"><?php echo wp_kses_post( $order->get_formatted_shipping_address() ); ?></address>
    </div>
    <?php endif; ?>

    <div class="sty__card">
      <p class="mono-label" style="margin-bottom:16px;">What Happens Next</p>
      <div class="sty__steps">

        <div class="sty__step sty__step--done">
          <div class="sty__step__dot"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div class="sty__step__body">
            <strong>Order Confirmed</strong>
            <span>Confirmation sent to <?php echo esc_html( $order->get_billing_email() ); ?></span>
          </div>
        </div>

        <?php if ( $is_bacs ) : ?>
        <div class="sty__step <?php echo $bacs_due ? 'sty__step--active' : 'sty__step--done'; ?>">
          <div class="sty__step__dot"><?php echo $bacs_due ? '2' : '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>'; ?></div>
          <div class="sty__step__body">
            <strong>Bank Transfer</strong>
            <span><?php echo $bacs_due ? 'Complete transfer using the details above' : 'Payment received'; ?></span>
          </div>
        </div>
        <?php endif; ?>

        <div class="sty__step">
          <div class="sty__step__dot"><?php echo $is_bacs ? '3' : '2'; ?></div>
          <div class="sty__step__body">
            <strong>Dispatch</strong>
            <span>Same day if paid before 2PM AEST Mon–Fri</span>
          </div>
        </div>

        <div class="sty__step">
          <div class="sty__step__dot"><?php echo $is_bacs ? '4' : '3'; ?></div>
          <div class="sty__step__body">
            <strong>Tracking</strong>
            <span>Shipping confirmation with tracking number</span>
          </div>
        </div>

      </div>
    </div>

  </div>
</div><!-- .sty__cols -->

<!-- ══ BOTTOM ACTIONS ════════════════════════════════════ -->
<div class="sty__actions">
  <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="syntra-checkout-btn" style="display:inline-flex;width:auto;min-width:200px;">
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
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
  </div>
  <div>
    <h1 class="sty__heading">Order Received</h1>
    <p class="sty__sub">Thank you. A confirmation email is on its way.</p>
  </div>
</div>
<?php endif; ?>

</div><!-- .container -->
</div><!-- .sty -->

<script>
document.addEventListener('click', function(e) {
  var btn = e.target.closest('.sty__copy');
  if (!btn) return;
  var text = btn.dataset.copy;
  if (!text) return;
  navigator.clipboard.writeText(text).then(function() {
    var orig = btn.innerHTML;
    btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2FB7B3" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
    btn.style.borderColor = 'var(--teal)';
    btn.style.color = 'var(--teal)';
    setTimeout(function() { btn.innerHTML = orig; btn.style.borderColor = ''; btn.style.color = ''; }, 2000);
  }).catch(function() {
    // Fallback for older browsers
    var el = document.createElement('textarea');
    el.value = text; el.style.position = 'fixed'; el.style.opacity = '0';
    document.body.appendChild(el); el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
  });
});
</script>
