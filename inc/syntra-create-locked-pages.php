<?php
/**
 * Auto-create locked policy pages for GHK-Cu compliance path.
 * Runs once on admin_init. Delete transient 'syntra_locked_pages_v1' to re-run.
 */

add_action( 'admin_init', 'syntra_create_locked_policy_pages' );

function syntra_create_locked_policy_pages() {
    if ( get_transient( 'syntra_locked_pages_v1' ) ) {
        return;
    }

    $template = 'page-locked-policy.php';

    syntra_maybe_create_page(
        'locked-terms',
        'Terms and Conditions',
        syntra_terms_content(),
        $template
    );

    syntra_maybe_create_page(
        'locked-refund',
        'Refund Policy',
        syntra_refund_content(),
        $template
    );

    syntra_maybe_create_page(
        'locked-shipping',
        'Shipping Policy',
        syntra_shipping_content(),
        $template
    );

    set_transient( 'syntra_locked_pages_v1', true );
}

function syntra_maybe_create_page( $slug, $title, $content, $template ) {
    $existing = get_page_by_path( $slug, OBJECT, 'page' );
    if ( $existing ) {
        return;
    }
    $post_id = wp_insert_post( array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'page',
    ) );
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_wp_page_template', $template );
    }
}

function syntra_terms_content() {
    return '<p><strong>Effective Date:</strong> 1 January 2025<br><strong>Last Updated:</strong> 1 March 2025</p>

<p>These Terms and Conditions (&quot;Terms&quot;) govern your access to and use of the Syntra Global Pty Ltd website at syntra.bio (&quot;Website&quot;) and the purchase of products from Syntra Global Pty Ltd (&quot;Syntra&quot;, &quot;we&quot;, &quot;us&quot;, &quot;our&quot;). By placing an order or using the Website you agree to be bound by these Terms.</p>

<h2>1. About Us</h2>
<p>Syntra Global Pty Ltd is an Australian proprietary company registered under the Corporations Act 2001 (Cth).</p>
<table><tr><th>Legal Entity</th><td>Syntra Global Pty Ltd</td></tr><tr><th>ABN</th><td>22 694 777 494</td></tr><tr><th>Registered Address</th><td>442 The Esplanade, Palm Beach QLD 4221, Australia</td></tr><tr><th>Contact Email</th><td>support@syntra.bio</td></tr><tr><th>Currency</th><td>Australian Dollar (AUD)</td></tr></table>

<h2>2. Product Use and Research Disclaimer</h2>
<p>All products sold by Syntra Global Pty Ltd are supplied exclusively for legitimate research, in vitro laboratory, and cosmetic formulation purposes. They are not approved by the Therapeutic Goods Administration (TGA) or any other regulatory body for human therapeutic use, diagnosis, treatment, or prevention of any medical condition.</p>
<p>By purchasing from Syntra Global Pty Ltd you confirm that:</p>
<ul>
<li>You are purchasing for legitimate research, laboratory, or cosmetic formulation use only.</li>
<li>You are not purchasing for human consumption, self-administration, or therapeutic use.</li>
<li>You are 18 years of age or older.</li>
<li>You accept full responsibility for compliance with all laws applicable in your jurisdiction.</li>
<li>You will handle, store, and dispose of all products safely and lawfully.</li>
</ul>
<p>Syntra Global Pty Ltd accepts no liability arising from misuse of any product, including use contrary to the intended research purpose.</p>

<h2>3. Eligibility</h2>
<p>You must be at least 18 years of age and have the legal capacity to enter into a binding contract to purchase from us. By placing an order you represent and warrant that you meet these requirements.</p>

<h2>4. Orders and Acceptance</h2>
<p>All orders are subject to acceptance by Syntra Global Pty Ltd. An order confirmation email constitutes our acceptance of your order and creates a binding contract. We reserve the right to refuse or cancel any order at our sole discretion, including where we suspect misuse or where a product is unavailable.</p>

<h2>5. Pricing and Payment</h2>
<p>All prices are displayed in Australian Dollars (AUD) and are inclusive of GST where applicable. Prices are subject to change without notice. Payment must be received in full before dispatch. We accept credit card, debit card, and bank transfer (BSB/Account). Orders paid by bank transfer will be dispatched once funds are cleared.</p>

<h2>6. Backorders</h2>
<p>Some products may be available on backorder. If you place a backorder, your payment will be collected at the time of order and your product will be dispatched as soon as stock is available. You will be notified of the estimated dispatch date by email. You may cancel a backorder at any time before dispatch by contacting support@syntra.bio.</p>

<h2>7. GST</h2>
<p>Syntra Global Pty Ltd is registered for Goods and Services Tax (GST) in Australia. GST is included in the displayed price where applicable. A tax invoice will be provided with your order.</p>

<h2>8. Intellectual Property</h2>
<p>All content on the Website including text, graphics, logos, product descriptions, and data is the intellectual property of Syntra Global Pty Ltd or its licensors and is protected by Australian and international copyright law. You may not reproduce, distribute, or create derivative works without our prior written consent.</p>

<h2>9. Limitation of Liability</h2>
<p>To the maximum extent permitted by Australian Consumer Law, Syntra Global Pty Ltd total liability to you for any claim arising out of or in connection with these Terms or any product is limited to the price paid for the product giving rise to the claim. We are not liable for any indirect, consequential, special, or punitive loss or damage.</p>
<p>Nothing in these Terms excludes, restricts, or modifies any right or remedy you may have under the Australian Consumer Law which cannot be excluded, restricted, or modified.</p>

<h2>10. Privacy</h2>
<p>We collect, hold, use, and disclose personal information in accordance with the Privacy Act 1988 (Cth) and the Australian Privacy Principles. For full details please contact support@syntra.bio.</p>

<h2>11. Governing Law</h2>
<p>These Terms are governed by the laws of Queensland, Australia. Any dispute arising under or in connection with these Terms will be subject to the exclusive jurisdiction of the courts of Queensland, Australia.</p>

<h2>12. Changes to These Terms</h2>
<p>We may update these Terms from time to time. Continued use of the Website or purchase of products after any update constitutes acceptance of the revised Terms. The effective date at the top of this page reflects the date of the most recent update.</p>

<h2>13. Contact</h2>
<p>For any questions regarding these Terms, please contact:<br><strong>Syntra Global Pty Ltd</strong><br>442 The Esplanade, Palm Beach QLD 4221, Australia<br>support@syntra.bio</p>';
}

function syntra_refund_content() {
    return '<p><strong>Effective Date:</strong> 1 January 2025<br><strong>Last Updated:</strong> 1 March 2025</p>

<p>This Refund Policy applies to all purchases made from Syntra Global Pty Ltd (ABN 22 694 777 494) via syntra.bio. Your rights under this policy are in addition to any rights you have under the Australian Consumer Law.</p>

<h2>1. Our Commitment</h2>
<p>We want you to be satisfied with every order. If something is wrong with your order, we will work with you to resolve it promptly.</p>

<h2>2. Australian Consumer Law Guarantees</h2>
<p>Our products come with guarantees that cannot be excluded under the Australian Consumer Law. You are entitled to a replacement or refund for a major failure and compensation for any other reasonably foreseeable loss or damage. You are also entitled to have the goods repaired or replaced if the goods fail to be of acceptable quality and the failure does not amount to a major failure.</p>

<h2>3. Eligibility for Refund or Replacement</h2>
<p>You may be entitled to a refund or replacement in the following circumstances:</p>
<ul>
<li><strong>Wrong item received:</strong> You received a product different from what you ordered.</li>
<li><strong>Damaged in transit:</strong> Your order arrived damaged or broken.</li>
<li><strong>Product defect:</strong> The product is defective or fails to meet the described specification (e.g. purity, appearance).</li>
<li><strong>Lost in transit:</strong> Your order does not arrive within 14 business days of dispatch and tracking confirms loss.</li>
</ul>

<h2>4. How to Request a Refund or Replacement</h2>
<p>To initiate a claim, email support@syntra.bio within <strong>7 days of receiving your order</strong> (or within 14 days of the dispatch date if the order has not arrived). Please include:</p>
<ul>
<li>Your full name and order number</li>
<li>A description of the issue</li>
<li>Photographs of the product and packaging (where relevant)</li>
</ul>
<p>We will respond within 2 business days and confirm the outcome of your claim.</p>

<h2>5. Resolution Options</h2>
<p>Depending on the nature of the issue, we will offer one of the following:</p>
<ul>
<li>Full replacement of the affected product at no additional cost</li>
<li>Full or partial refund to your original payment method</li>
<li>Store credit (at your election)</li>
</ul>
<p>Refunds are processed within 5 to 7 business days of approval. Bank processing times may vary.</p>

<h2>6. Change of Mind</h2>
<p>Due to the nature of our products (research-grade peptides and biochemical compounds), we are unable to accept returns or issue refunds for change of mind. All sales are final once dispatched, except where required by the Australian Consumer Law.</p>

<h2>7. Backorder Cancellations</h2>
<p>Backorders may be cancelled at any time before dispatch. To cancel a backorder, email support@syntra.bio with your order number. A full refund will be issued within 5 to 7 business days.</p>

<h2>8. International Orders</h2>
<p>For orders shipped outside Australia, the customer is responsible for compliance with all import laws and regulations in their destination country. Syntra Global Pty Ltd will not issue refunds for orders refused or seized by customs authorities. We recommend customers verify local import regulations before ordering.</p>

<h2>9. Contact</h2>
<p>For all refund and returns enquiries:<br><strong>Syntra Global Pty Ltd</strong><br>442 The Esplanade, Palm Beach QLD 4221, Australia<br>support@syntra.bio</p>
<p>We aim to respond to all enquiries within 2 business days (Monday to Friday, AEST).</p>';
}

function syntra_shipping_content() {
    return '<p><strong>Effective Date:</strong> 1 January 2025<br><strong>Last Updated:</strong> 1 March 2025</p>

<p>This Shipping Policy applies to all orders placed with Syntra Global Pty Ltd (ABN 22 694 777 494) via syntra.bio.</p>

<h2>1. Dispatch</h2>
<p>Orders are dispatched Monday to Friday. Orders placed and paid before <strong>2:00 PM AEST</strong> on a business day are dispatched the same day. Orders placed after 2:00 PM AEST, or on weekends and public holidays, are dispatched the following business day.</p>
<p>All products are shipped from Palm Beach, Queensland, Australia.</p>

<h2>2. Domestic Shipping (Australia)</h2>
<table><tr><th>Service</th><th>Estimated Delivery</th><th>Cost</th></tr><tr><td>Australia Post Express Post</td><td>1 to 3 business days</td><td>From $9.95 AUD</td></tr><tr><td>Free Shipping</td><td>1 to 3 business days</td><td>Free on orders over $100 AUD</td></tr></table>
<p>Delivery timeframes are estimates provided by Australia Post and are not guaranteed. Remote or rural areas may experience longer delivery times.</p>

<h2>3. Free Shipping Threshold</h2>
<p>Orders with a product subtotal of <strong>$100 AUD or more</strong> qualify for free standard shipping within Australia. Free shipping is applied automatically at checkout. No coupon code required.</p>

<h2>4. International Shipping</h2>
<p>We currently ship to selected international destinations. International shipping costs and timeframes vary by destination and will be calculated at checkout.</p>
<table><tr><th>Region</th><th>Estimated Delivery</th></tr><tr><td>New Zealand</td><td>3 to 7 business days</td></tr><tr><td>United States</td><td>7 to 14 business days</td></tr><tr><td>United Kingdom and Europe</td><td>7 to 14 business days</td></tr><tr><td>Other International</td><td>7 to 21 business days</td></tr></table>
<p>International delivery timeframes are estimates and may vary due to customs processing and local postal service delays.</p>

<h2>5. Customs, Duties and Import Taxes</h2>
<p>For international orders, the customer is responsible for all customs duties, import taxes, and compliance with the laws of the destination country. Syntra Global Pty Ltd is not responsible for delays caused by customs processing or for orders held or seized by customs authorities.</p>
<p>We strongly recommend customers verify local import regulations before placing an international order.</p>

<h2>6. Tracking</h2>
<p>A tracking number will be emailed to you once your order has been dispatched. You can track your order at auspost.com.au or via the link provided in your dispatch confirmation email.</p>

<h2>7. Packaging</h2>
<p>All products are packaged in tamper-evident, discreet packaging. Cold-sensitive products are packed with appropriate insulating materials where required. We take care to ensure products arrive in the condition in which they left our facility.</p>

<h2>8. Lost or Delayed Orders</h2>
<p>If your order has not arrived within 14 business days of the dispatch date, please contact us at support@syntra.bio with your order number. We will investigate with Australia Post or the relevant carrier and, where the order is confirmed lost, arrange a replacement or refund in accordance with our Refund Policy.</p>

<h2>9. Address Accuracy</h2>
<p>It is your responsibility to provide a complete and accurate shipping address at checkout. Syntra Global Pty Ltd is not responsible for orders delayed or undelivered due to an incorrect or incomplete address provided by the customer. Re-delivery or replacement costs arising from address errors may be charged to the customer.</p>

<h2>10. Contact</h2>
<p>For all shipping enquiries:<br><strong>Syntra Global Pty Ltd</strong><br>442 The Esplanade, Palm Beach QLD 4221, Australia<br>support@syntra.bio</p>
<p>We aim to respond to all enquiries within 2 business days (Monday to Friday, AEST).</p>';
}
