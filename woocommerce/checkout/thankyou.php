<?php
/**
 * Syntra — Order Received / Thank You Page
 * Overrides: woocommerce/checkout/thankyou.php
 */
defined( 'ABSPATH' ) || exit;
?>

<div class="syntra-thankyou">
  <div class="container">

  <?php if ( $order ) : ?>

    <!-- ── Confirmation Header ── -->
    <div class="syntra-thankyou__hero">
      <div class="syntra-thankyou__icon syntra-thankyou__icon--<?php echo esc_attr( $order->get_status() ); ?>">
        <?php if ( $order->get_status() === 'failed' ) : ?>
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        <?php else : ?>
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
        <?php endif; ?>
      </div>

      <?php if ( $order->get_status() === 'failed' ) : ?>
        <h1 class="syntra-thankyou__heading">Payment Failed</h1>
        <p class="syntra-thankyou__sub">Unfortunately your order could not be processed. Please try again or contact us.</p>
      <?php else : ?>
        <h1 class="syntra-thankyou__heading">Order Confirmed</h1>
        <p class="syntra-thankyou__sub">Thank you, <?php echo esc_html( $order->get_billing_first_name() ); ?>. Your research order has been received and is being processed.</p>
      <?php endif; ?>
    </div>

    <!-- ── Order Meta Strip ── -->
    <div class="syntra-order-meta">
      <div class="syntra-order-meta__item">
        <span class="syntra-order-meta__label">Order Number</span>
        <span class="syntra-order-meta__value">#<?php echo esc_html( $order->get_order_number() ); ?></span>
      </div>
      <div class="syntra-order-meta__item">
        <span class="syntra-order-meta__label">Date</span>
        <span class="syntra-order-meta__value"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></span>
      </div>
      <div class="syntra-order-meta__item">
        <span class="syntra-order-meta__label">Total</span>
        <span class="syntra-order-meta__value"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
      </div>
      <div class="syntra-order-meta__item">
        <span class="syntra-order-meta__label">Payment</span>
        <span class="syntra-order-meta__value"><?php echo esc_html( $order->get_payment_method_title() ); ?></span>
      </div>
    </div>

    <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
    <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

    <!-- ── BACS Payment Instructions ── -->
    <?php if ( $order->get_payment_method() === 'bacs' && $order->has_status( [ 'pending', 'on-hold' ] ) ) :
      $bacs     = WC()->payment_gateways()->payment_gateways()['bacs'] ?? null;
      $accounts = $bacs ? $bacs->account_details : [];
    ?>
    <div class="syntra-bacs-box">
      <div class="syntra-bacs-box__header">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        <span>Complete Your Bank Transfer</span>
        <span class="syntra-bacs-box__urgent">Action Required</span>
      </div>
      <p class="syntra-bacs-box__intro">Your order is <strong>reserved</strong> but won't be dispatched until payment clears. Transfer the exact amount below using your order number as the reference.</p>

      <?php if ( ! empty( $accounts ) ) :
        foreach ( $accounts as $account ) :
          if ( empty( $account['account_name'] ) ) continue;
      ?>
      <div class="syntra-bacs-details">
        <?php if ( ! empty( $account['account_name'] ) ) : ?>
        <div class="syntra-bacs-detail-row">
          <span class="syntra-bacs-detail-row__label">Account Name</span>
          <span class="syntra-bacs-detail-row__val"><?php echo esc_html( $account['account_name'] ); ?></span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['bank_name'] ) ) : ?>
        <div class="syntra-bacs-detail-row">
          <span class="syntra-bacs-detail-row__label">Bank</span>
          <span class="syntra-bacs-detail-row__val"><?php echo esc_html( $account['bank_name'] ); ?></span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['sort_code'] ) ) : ?>
        <div class="syntra-bacs-detail-row syntra-bacs-detail-row--big">
          <span class="syntra-bacs-detail-row__label">BSB</span>
          <span class="syntra-bacs-detail-row__val syntra-bacs-detail-row__val--mono">
            <?php echo esc_html( $account['sort_code'] ); ?>
            <button type="button" class="syntra-copy-btn" data-copy="<?php echo esc_attr( $account['sort_code'] ); ?>" title="Copy BSB">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              Copy
            </button>
          </span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['account_number'] ) ) : ?>
        <div class="syntra-bacs-detail-row syntra-bacs-detail-row--big">
          <span class="syntra-bacs-detail-row__label">Account Number</span>
          <span class="syntra-bacs-detail-row__val syntra-bacs-detail-row__val--mono">
            <?php echo esc_html( $account['account_number'] ); ?>
            <button type="button" class="syntra-copy-btn" data-copy="<?php echo esc_attr( $account['account_number'] ); ?>" title="Copy Account Number">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              Copy
            </button>
          </span>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; endif; ?>

      <!-- Reference — most important field -->
      <div class="syntra-bacs-reference">
        <span class="syntra-bacs-reference__label">Payment Reference <span class="syntra-bacs-reference__required">Required</span></span>
        <div class="syntra-bacs-reference__value">
          <?php echo esc_html( $order->get_order_number() ); ?>
          <button type="button" class="syntra-copy-btn syntra-copy-btn--large" data-copy="<?php echo esc_attr( $order->get_order_number() ); ?>" title="Copy reference">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            Copy
          </button>
        </div>
        <p class="syntra-bacs-reference__note">Without a reference we cannot match your payment to your order.</p>
      </div>

      <!-- Steps -->
      <ol class="syntra-bacs-steps-list">
        <li><strong>Open your bank app</strong> and go to Transfers / BPAY / Pay Anyone</li>
        <li><strong>Enter the details above</strong> exactly as shown — BSB, account number, amount</li>
        <li><strong>Use your order number</strong> (<?php echo esc_html( $order->get_order_number() ); ?>) as the payment reference</li>
        <li><strong>Submit transfer</strong> — we'll dispatch once payment clears (same day if before 2PM AEST Mon–Fri)</li>
      </ol>

      <p class="syntra-bacs-box__footer">Questions? Email <a href="mailto:support@syntra.bio">support@syntra.bio</a> with your order number.</p>
    </div>
    <?php endif; ?>

    <!-- ── Order Items ── -->
    <div class="syntra-thankyou__section">
      <p class="mono-label">Items Ordered</p>
      <div class="syntra-order-items">
        <?php foreach ( $order->get_items() as $item_id => $item ) :
          $_product = $item->get_product();
          $image    = $_product ? $_product->get_image( 'thumbnail' ) : '';
        ?>
        <div class="syntra-order-item">
          <?php if ( $image ) : ?>
          <div class="syntra-order-item__img"><?php echo $image; ?></div>
          <?php endif; ?>
          <div class="syntra-order-item__info">
            <span class="syntra-order-item__name"><?php echo wp_kses_post( $item->get_name() ); ?></span>
            <?php if ( ! empty( $item->get_meta('syntra_variant_label') ) ) : ?>
            <span class="syntra-order-item__variant"><?php echo esc_html( $item->get_meta('syntra_variant_label') ); ?></span>
            <?php endif; ?>
            <span class="syntra-order-item__qty">Qty: <?php echo esc_html( $item->get_quantity() ); ?></span>
          </div>
          <div class="syntra-order-item__total"><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="syntra-order-totals">
        <div class="syntra-order-totals__row">
          <span>Subtotal</span>
          <span><?php echo wp_kses_post( wc_price( $order->get_subtotal() ) ); ?></span>
        </div>
        <?php if ( $order->get_shipping_total() > 0 ) : ?>
        <div class="syntra-order-totals__row">
          <span>Shipping</span>
          <span><?php echo wp_kses_post( wc_price( $order->get_shipping_total() ) ); ?></span>
        </div>
        <?php endif; ?>
        <?php foreach ( $order->get_coupons() as $coupon ) : ?>
        <div class="syntra-order-totals__row" style="color:var(--teal);">
          <span>Discount (<?php echo esc_html( $coupon->get_name() ); ?>)</span>
          <span>−<?php echo wp_kses_post( wc_price( $coupon->get_discount() ) ); ?></span>
        </div>
        <?php endforeach; ?>
        <div class="syntra-order-totals__row syntra-order-totals__row--total">
          <span>Total</span>
          <span><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
        </div>
      </div>
    </div>

    <!-- ── Shipping Address ── -->
    <?php if ( $order->get_shipping_address_1() ) : ?>
    <div class="syntra-thankyou__section">
      <p class="mono-label">Shipping To</p>
      <address class="syntra-thankyou__address">
        <?php echo wp_kses_post( $order->get_formatted_shipping_address() ); ?>
      </address>
    </div>
    <?php endif; ?>

    <!-- ── What Happens Next ── -->
    <div class="syntra-next-steps">
      <p class="mono-label">What Happens Next</p>
      <div class="syntra-next-steps__grid">
        <div class="syntra-next-step">
          <div class="syntra-next-step__num">1</div>
          <div>
            <strong>Confirmation Email</strong>
            <p>A confirmation has been sent to <?php echo esc_html( $order->get_billing_email() ); ?></p>
          </div>
        </div>
        <?php if ( $order->get_payment_method() === 'bacs' ) : ?>
        <div class="syntra-next-step">
          <div class="syntra-next-step__num">2</div>
          <div>
            <strong>Transfer Payment</strong>
            <p>Complete your bank transfer using the details above</p>
          </div>
        </div>
        <?php endif; ?>
        <div class="syntra-next-step">
          <div class="syntra-next-step__num"><?php echo $order->get_payment_method() === 'bacs' ? '3' : '2'; ?></div>
          <div>
            <strong>Same-Day Dispatch</strong>
            <p>Orders paid before 2PM AEST Mon–Fri are dispatched same day</p>
          </div>
        </div>
        <div class="syntra-next-step">
          <div class="syntra-next-step__num"><?php echo $order->get_payment_method() === 'bacs' ? '4' : '3'; ?></div>
          <div>
            <strong>Tracking Notification</strong>
            <p>You'll receive a shipping confirmation with tracking once dispatched</p>
          </div>
        </div>
      </div>
    </div>

    <div class="syntra-thankyou__actions">
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="syntra-checkout-btn" style="display:inline-flex;width:auto;">
        Continue Shopping
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <?php if ( is_user_logged_in() ) : ?>
      <a href="<?php echo esc_url( wc_get_account_endpoint_url('orders') ); ?>" class="syntra-thankyou__link">View My Orders</a>
      <?php endif; ?>
    </div>

  <?php else : ?>
    <div class="syntra-thankyou__hero">
      <h1 class="syntra-thankyou__heading">Order Received</h1>
      <p class="syntra-thankyou__sub">Thank you for your order. A confirmation email is on its way.</p>
    </div>
  <?php endif; ?>

  </div><!-- .container -->
</div><!-- .syntra-thankyou -->

<script>
document.addEventListener('click', function(e) {
  var btn = e.target.closest('.syntra-copy-btn');
  if (!btn) return;
  var text = btn.dataset.copy;
  if (!text) return;
  navigator.clipboard.writeText(text).then(function() {
    var orig = btn.innerHTML;
    btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2FB7B3" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
    btn.style.color = 'var(--teal)';
    setTimeout(function() { btn.innerHTML = orig; btn.style.color = ''; }, 2000);
  });
});
</script>
