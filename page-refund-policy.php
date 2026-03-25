<?php
/**
 * Template Name: Refund Policy
 * Template for the Returns & Refund Policy page — slug: refund-policy
 *
 * @package Syntra
 */
get_header();
?>

<div class="legal-page">
  <div class="legal-page__hero">
    <div class="container">
      <p class="mono-label">Legal</p>
      <h1 class="legal-page__title">Returns &amp; Refund Policy</h1>
      <p class="legal-page__meta">
        Syntra Global Pty Ltd &nbsp;·&nbsp; ABN 22&nbsp;694&nbsp;777&nbsp;494 &nbsp;·&nbsp;
        Last updated: <?php echo date( 'j F Y' ); ?>
      </p>
    </div>
  </div>

  <div class="container legal-page__body">

    <div class="legal-notice">
      Our Returns &amp; Refund Policy is consistent with your rights under the
      <strong>Australian Consumer Law (ACL)</strong>. Nothing in this policy limits
      or excludes any rights or guarantees you have under the ACL.
    </div>

    <!-- 1 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">1. Company Information</h2>
      <p>This policy applies to all purchases made from:</p>
      <div class="legal-address-block">
        <strong>Syntra Global Pty Ltd</strong><br>
        ABN: 22 694 777 494<br>
        1/83 Glen Ayr Drive<br>
        Banora Point NSW 2486<br>
        Australia<br>
        Email: <a href="mailto:admin@syntra.bio">admin@syntra.bio</a>
      </div>
    </div>

    <!-- 2 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">2. Eligible Returns</h2>
      <p>You may be entitled to a return and refund or replacement in the following circumstances:</p>
      <ul class="legal-list">
        <li><strong>Incorrect item received</strong> — the product delivered does not match your order.</li>
        <li><strong>Damaged in transit</strong> — the product arrived visibly damaged due to shipping.</li>
        <li><strong>Defective or compromised product</strong> — the product is demonstrably defective (e.g. broken vial seal, contamination visible upon receipt).</li>
        <li><strong>Major failure</strong> — the product fails to meet a consumer guarantee under the Australian Consumer Law.</li>
      </ul>
    </div>

    <!-- 3 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">3. Non-Eligible Returns</h2>
      <p>Returns will <strong>not</strong> be accepted in the following circumstances:</p>
      <ul class="legal-list">
        <li><strong>Change of mind</strong> — due to the perishable and regulated nature of research compounds, we do not accept change-of-mind returns.</li>
        <li><strong>Opened or used product</strong> — any product that has been opened, reconstituted, or otherwise used cannot be returned.</li>
        <li><strong>Improper storage</strong> — products damaged due to failure to follow recommended storage conditions after delivery.</li>
        <li><strong>Delay in reporting</strong> — claims not lodged within the timeframe outlined in Section 4.</li>
        <li><strong>International orders</strong> — we are unable to accept returns from international orders due to customs and regulatory constraints.</li>
      </ul>
    </div>

    <!-- 4 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">4. Timeframe to Lodge a Claim</h2>
      <p>All return or refund claims must be lodged within <strong>7 days of the delivery date</strong>
      as confirmed by the carrier tracking information.</p>
      <p>Claims received after this period will not be accepted unless the defect could not reasonably
      have been discovered upon delivery (in which case the ACL statutory guarantee period applies).</p>
    </div>

    <!-- 5 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">5. How to Initiate a Return</h2>
      <p>To lodge a return or refund claim, follow these steps:</p>
      <ol class="legal-list legal-list--numbered">
        <li>Email <a href="mailto:admin@syntra.bio">admin@syntra.bio</a> with the subject line
        <strong>"Return Request — Order #[your order number]"</strong>.</li>
        <li>Include your full name, order number, and a clear description of the issue.</li>
        <li>Attach photographs clearly showing the damage, defect, or incorrect item.</li>
        <li>Our team will respond within <strong>2 business days</strong> to assess your claim
        and provide a Return Authorisation (RA) number if approved.</li>
        <li>Do not send any items back until you have received a Return Authorisation — unauthorised
        returns will not be processed.</li>
        <li>Once authorised, return the item in its original packaging to:<br>
          <strong>Syntra Global Pty Ltd, 1/83 Glen Ayr Drive, Banora Point NSW 2486</strong>
        </li>
      </ol>
      <p>Return shipping costs for approved claims (incorrect item or damaged in transit) will be
      covered by Syntra Global Pty Ltd. In all other cases, return shipping is at the customer's cost.</p>
    </div>

    <!-- 6 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">6. Refund Method &amp; Timeframe</h2>
      <p>Approved refunds will be processed to the <strong>original payment method</strong> used at
      the time of purchase.</p>
      <p>Refunds are typically processed within <strong>5–10 business days</strong> of us receiving
      and verifying the returned item. Depending on your financial institution, funds may take an
      additional 2–5 business days to appear in your account.</p>
      <p>Where a replacement product is preferred and available, we will dispatch the replacement
      within 3 business days of approving the claim — no need to return the original item in cases
      of transit damage.</p>
    </div>

    <!-- 7 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">7. Australian Consumer Law</h2>
      <p>Our products come with guarantees that cannot be excluded under the
      <strong>Australian Consumer Law</strong>. You are entitled to a replacement or refund for a
      major failure and compensation for any other reasonably foreseeable loss or damage.
      You are also entitled to have the goods repaired or replaced if the goods fail to be of
      acceptable quality and the failure does not amount to a major failure.</p>
      <p>For more information about your consumer rights, visit
      <a href="https://www.accc.gov.au" target="_blank" rel="noopener noreferrer">accc.gov.au</a>.</p>
    </div>

    <!-- 8 -->
    <div class="legal-section">
      <h2 class="legal-section__heading">8. Contact</h2>
      <p>For all returns, refund enquiries, or questions about this policy:</p>
      <div class="legal-address-block">
        <strong>Syntra Global Pty Ltd</strong><br>
        1/83 Glen Ayr Drive, Banora Point NSW 2486, Australia<br>
        ABN: 22 694 777 494<br>
        Email: <a href="mailto:admin@syntra.bio">admin@syntra.bio</a>
      </div>
    </div>

  </div><!-- /.legal-page__body -->
</div><!-- /.legal-page -->

<?php get_footer(); ?>
