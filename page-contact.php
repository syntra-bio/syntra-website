<?php
/**
 * Template Name: Contact
 * Template for the Contact page — slug: contact
 *
 * @package Syntra
 */
get_header();

$sent    = false;
$error   = false;

if ( isset( $_POST['syntra_contact_nonce'] ) && wp_verify_nonce( $_POST['syntra_contact_nonce'], 'syntra_contact' ) ) {
    $name    = sanitize_text_field( $_POST['contact_name'] ?? '' );
    $email   = sanitize_email( $_POST['contact_email'] ?? '' );
    $subject = sanitize_text_field( $_POST['contact_subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

    if ( $name && is_email( $email ) && $subject && $message ) {
        $to      = 'support@syntra.bio';
        $headers = [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $name . ' <' . $email . '>',
        ];
        $body  = "Name: {$name}\n";
        $body .= "Email: {$email}\n\n";
        $body .= "Message:\n{$message}";

        $sent = wp_mail( $to, '[Syntra Enquiry] ' . $subject, $body, $headers );
        if ( ! $sent ) { $error = true; }
    } else {
        $error = true;
    }
}
?>

<div class="legal-page">
  <div class="legal-page__hero">
    <div class="container">
      <p class="mono-label">Get In Touch</p>
      <h1 class="legal-page__title">Contact Syntra</h1>
      <p class="legal-page__meta">
        Syntra Global Pty Ltd &nbsp;·&nbsp; support@syntra.bio &nbsp;·&nbsp; Palm Beach QLD 4221, Australia
      </p>
    </div>
  </div>

  <div class="container contact-page__body">

    <div class="contact-page__grid">

      <!-- Contact Form -->
      <div class="contact-form-wrap">

        <?php if ( $sent ) : ?>
          <div class="contact-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            Message sent. We'll get back to you at <strong><?php echo esc_html( $_POST['contact_email'] ); ?></strong> within 1–2 business days.
          </div>
        <?php else : ?>

          <?php if ( $error ) : ?>
            <div class="contact-error">Please fill in all fields with a valid email address and try again.</div>
          <?php endif; ?>

          <form class="contact-form" method="post" action="">
            <?php wp_nonce_field( 'syntra_contact', 'syntra_contact_nonce' ); ?>

            <div class="contact-form__row">
              <div class="contact-form__field">
                <label class="contact-form__label" for="contact_name">Name</label>
                <input class="contact-form__input" type="text" id="contact_name" name="contact_name"
                  placeholder="Your name" required
                  value="<?php echo esc_attr( $_POST['contact_name'] ?? '' ); ?>">
              </div>
              <div class="contact-form__field">
                <label class="contact-form__label" for="contact_email">Email</label>
                <input class="contact-form__input" type="email" id="contact_email" name="contact_email"
                  placeholder="your@email.com" required autocomplete="email"
                  value="<?php echo esc_attr( $_POST['contact_email'] ?? '' ); ?>">
              </div>
            </div>

            <div class="contact-form__field">
              <label class="contact-form__label" for="contact_subject">Subject</label>
              <select class="contact-form__input contact-form__select" id="contact_subject" name="contact_subject" required>
                <option value="">Select a topic…</option>
                <option value="Order Enquiry" <?php selected( ($_POST['contact_subject'] ?? ''), 'Order Enquiry' ); ?>>Order Enquiry</option>
                <option value="Product Information" <?php selected( ($_POST['contact_subject'] ?? ''), 'Product Information' ); ?>>Product Information</option>
                <option value="Returns & Refunds" <?php selected( ($_POST['contact_subject'] ?? ''), 'Returns & Refunds' ); ?>>Returns &amp; Refunds</option>
                <option value="COA / Batch Data" <?php selected( ($_POST['contact_subject'] ?? ''), 'COA / Batch Data' ); ?>>COA / Batch Data</option>
                <option value="Wholesale / Bulk" <?php selected( ($_POST['contact_subject'] ?? ''), 'Wholesale / Bulk' ); ?>>Wholesale / Bulk</option>
                <option value="Other" <?php selected( ($_POST['contact_subject'] ?? ''), 'Other' ); ?>>Other</option>
              </select>
            </div>

            <div class="contact-form__field">
              <label class="contact-form__label" for="contact_message">Message</label>
              <textarea class="contact-form__input contact-form__textarea" id="contact_message" name="contact_message"
                placeholder="How can we help?" required rows="6"><?php echo esc_textarea( $_POST['contact_message'] ?? '' ); ?></textarea>
            </div>

            <button type="submit" class="contact-form__btn">Send Message &rarr;</button>
          </form>

        <?php endif; ?>
      </div>

      <!-- Contact Details -->
      <div class="contact-details">

        <div class="contact-detail-block">
          <div class="contact-detail-block__icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <p class="contact-detail-block__label">Email</p>
            <a href="mailto:support@syntra.bio" class="contact-detail-block__value">support@syntra.bio</a>
            <p class="contact-detail-block__note">Response within 1–2 business days</p>
          </div>
        </div>

        <div class="contact-detail-block">
          <div class="contact-detail-block__icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <p class="contact-detail-block__label">Address</p>
            <p class="contact-detail-block__value">442 The Esplanade<br>Palm Beach QLD 4221<br>Australia</p>
          </div>
        </div>

        <div class="contact-detail-block">
          <div class="contact-detail-block__icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div>
            <p class="contact-detail-block__label">Business Hours</p>
            <p class="contact-detail-block__value">Monday – Friday<br>9:00 AM – 5:00 PM AEST</p>
            <p class="contact-detail-block__note">Excluding Queensland public holidays</p>
          </div>
        </div>

        <div class="contact-detail-block">
          <div class="contact-detail-block__icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          </div>
          <div>
            <p class="contact-detail-block__label">Same-Day Dispatch</p>
            <p class="contact-detail-block__value">Orders before 2:00 PM AEST</p>
            <p class="contact-detail-block__note">Monday – Friday, excluding public holidays</p>
          </div>
        </div>

        <div class="contact-compliance">
          <p>Syntra Global Pty Ltd &nbsp;·&nbsp; ABN 22 694 777 494</p>
          <p>For in vitro laboratory research use only. Not for human consumption.</p>
        </div>

      </div>
    </div>

  </div>
</div>

<?php get_footer(); ?>
