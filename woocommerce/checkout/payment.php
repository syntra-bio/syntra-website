<?php
/**
 * Syntra — Checkout Payment Section
 * Overrides: woocommerce/checkout/payment.php
 * Makes BACS bank details prominent, Place Order button bold.
 */
defined( 'ABSPATH' ) || exit;

if ( ! WC()->cart->needs_payment() ) :
  $order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place Order', 'woocommerce' ) );
  ?>
  <div id="payment">
    <?php do_action( 'woocommerce_review_order_before_payment' ); ?>
    <div class="syntra-place-order">
      <?php woocommerce_checkout_privacy_policy_text(); ?>
      <?php woocommerce_checkout_terms_and_conditions(); ?>
      <button type="submit" class="syntra-place-order__btn button alt" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo esc_attr( $order_button_text ); ?>" data-value="<?php echo esc_attr( $order_button_text ); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
        <?php echo esc_html( $order_button_text ); ?>
      </button>
    </div>
    <?php do_action( 'woocommerce_review_order_after_payment' ); ?>
  </div>
<?php return; endif; ?>

<div id="payment" class="syntra-payment-wrap">

  <?php do_action( 'woocommerce_review_order_before_payment' ); ?>

  <p class="mono-label" style="margin-bottom:20px;">Select Payment Method</p>

  <ul class="wc_payment_methods payment_methods methods syntra-payment-methods">
    <?php
    if ( ! empty( $available_gateways ) ) {
      foreach ( $available_gateways as $gateway ) {
        wc_get_template(
          'checkout/payment-method.php',
          [ 'gateway' => $gateway ]
        );
      }
    } else {
      echo '<li class="syntra-no-payment">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>';
    }
    ?>
  </ul>

  <!-- BACS (Bank Transfer) Highlight Box — shown when BACS is selected -->
  <div class="syntra-bacs-highlight" id="syntraBacsHighlight" style="display:none;">
    <div class="syntra-bacs-highlight__header">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
      Bank Transfer Details
    </div>
    <p class="syntra-bacs-highlight__note">Transfer payment <strong>after placing your order</strong>. Use your order number as the payment reference.</p>
    <div class="syntra-bacs-fields">
      <?php
      // Pull BACS settings from WooCommerce gateway
      $bacs = WC()->payment_gateways()->payment_gateways()['bacs'] ?? null;
      if ( $bacs && ! empty( $bacs->account_details ) ) :
        foreach ( $bacs->account_details as $account ) :
          if ( empty( $account['account_name'] ) ) continue;
      ?>
      <div class="syntra-bacs-account">
        <?php if ( ! empty( $account['account_name'] ) ) : ?>
        <div class="syntra-bacs-row">
          <span class="syntra-bacs-row__label">Account Name</span>
          <span class="syntra-bacs-row__value"><?php echo esc_html( $account['account_name'] ); ?></span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['bank_name'] ) ) : ?>
        <div class="syntra-bacs-row">
          <span class="syntra-bacs-row__label">Bank</span>
          <span class="syntra-bacs-row__value"><?php echo esc_html( $account['bank_name'] ); ?></span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['account_number'] ) ) : ?>
        <div class="syntra-bacs-row syntra-bacs-row--highlight">
          <span class="syntra-bacs-row__label">Account Number</span>
          <span class="syntra-bacs-row__value syntra-bacs-row__value--mono">
            <?php echo esc_html( $account['account_number'] ); ?>
            <button type="button" class="syntra-copy-btn" data-copy="<?php echo esc_attr( $account['account_number'] ); ?>" title="Copy">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            </button>
          </span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['sort_code'] ) ) : ?>
        <div class="syntra-bacs-row syntra-bacs-row--highlight">
          <span class="syntra-bacs-row__label">BSB</span>
          <span class="syntra-bacs-row__value syntra-bacs-row__value--mono">
            <?php echo esc_html( $account['sort_code'] ); ?>
            <button type="button" class="syntra-copy-btn" data-copy="<?php echo esc_attr( $account['sort_code'] ); ?>" title="Copy">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            </button>
          </span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['iban'] ) ) : ?>
        <div class="syntra-bacs-row">
          <span class="syntra-bacs-row__label">IBAN</span>
          <span class="syntra-bacs-row__value syntra-bacs-row__value--mono"><?php echo esc_html( $account['iban'] ); ?></span>
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $account['bic'] ) ) : ?>
        <div class="syntra-bacs-row">
          <span class="syntra-bacs-row__label">BIC/SWIFT</span>
          <span class="syntra-bacs-row__value syntra-bacs-row__value--mono"><?php echo esc_html( $account['bic'] ); ?></span>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; endif; ?>
      <div class="syntra-bacs-row syntra-bacs-row--reference">
        <span class="syntra-bacs-row__label">Reference</span>
        <span class="syntra-bacs-row__value syntra-bacs-row__value--mono" style="color:var(--teal);">Your order number (shown after placing order)</span>
      </div>
    </div>
    <div class="syntra-bacs-steps">
      <p class="syntra-bacs-steps__title">How it works</p>
      <ol class="syntra-bacs-steps__list">
        <li>Place your order below — you'll receive your order number immediately</li>
        <li>Log in to your bank and transfer the exact amount</li>
        <li>Use your order number as the payment reference</li>
        <li>We dispatch once payment clears (usually same business day)</li>
      </ol>
    </div>
  </div>

  <div class="syntra-place-order" id="payment">
    <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
    <?php woocommerce_checkout_privacy_policy_text(); ?>
    <?php woocommerce_checkout_terms_and_conditions(); ?>

    <?php $order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place Order', 'woocommerce' ) ); ?>
    <button type="submit" class="syntra-place-order__btn button alt" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo esc_attr( $order_button_text ); ?>" data-value="<?php echo esc_attr( $order_button_text ); ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      Place Order Securely
    </button>

    <div class="syntra-place-order__reassurance">
      <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> SSL Encrypted</span>
      <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> COA Verified</span>
      <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> 🇦🇺 AU Company</span>
    </div>

    <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
    <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
  </div>

  <?php do_action( 'woocommerce_review_order_after_payment' ); ?>
</div>

<script>
(function() {
  // Show/hide BACS highlight box when BACS selected
  function updateBacsBox() {
    var bacsRadio = document.querySelector('input[value="bacs"]');
    var box = document.getElementById('syntraBacsHighlight');
    if (!box) return;
    if (bacsRadio && bacsRadio.checked) {
      box.style.display = '';
    } else {
      // Check if bacs is the only method and has no radio
      var allRadios = document.querySelectorAll('.wc_payment_methods input[type="radio"]');
      if (allRadios.length === 0 && bacsRadio) {
        box.style.display = '';
      } else {
        box.style.display = 'none';
      }
    }
  }

  document.addEventListener('change', function(e) {
    if (e.target.name === 'payment_method') updateBacsBox();
  });

  // Auto-show if BACS is pre-selected or only option
  document.addEventListener('DOMContentLoaded', function() {
    updateBacsBox();
    // Also check if BACS is checked by default
    var bacsInput = document.querySelector('input[value="bacs"]');
    if (bacsInput && bacsInput.checked) updateBacsBox();
    // Single payment method (no radio shown)
    var singleMethod = document.querySelector('li.payment_method_bacs input[type="radio"]');
    if (!singleMethod) {
      var bacsLi = document.querySelector('li.payment_method_bacs');
      if (bacsLi) {
        var box = document.getElementById('syntraBacsHighlight');
        if (box) box.style.display = '';
      }
    }
  });

  // Copy buttons
  document.addEventListener('click', function(e) {
    var btn = e.target.closest('.syntra-copy-btn');
    if (!btn) return;
    var text = btn.dataset.copy;
    if (!text) return;
    navigator.clipboard.writeText(text).then(function() {
      var orig = btn.innerHTML;
      btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2FB7B3" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>';
      setTimeout(function() { btn.innerHTML = orig; }, 1500);
    });
  });
})();
</script>
