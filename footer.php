<?php $shop_url = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '#'; ?>

<!-- FOOTER -->
<footer class="site-footer grid-overlay">
  <div class="container">
    <div class="site-footer__grid">

      <div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-text">SYNTRA</a>
        <p class="footer-tagline">Precision research compounds for the quantitative scientist.</p>
        <div class="footer-badges">
          <span class="verified-badge">99%+ Purity</span>
          <span class="verified-badge">COA Verified</span>
          <span class="verified-badge">🇦🇺 Australian Company</span>
        </div>
        <div class="footer-entity">
          <p class="footer-entity__name">Syntra Global Pty Ltd</p>
          <p class="footer-entity__detail">ABN 22 694 777 494</p>
          <p class="footer-entity__detail">1/83 Glen Ayr Drive<br>Banora Point NSW 2486<br>Australia</p>
          <p class="footer-entity__detail"><a href="mailto:admin@syntra.bio" class="footer-entity__email">admin@syntra.bio</a></p>
        </div>
      </div>

      <div>
        <p class="mono-label mono-label--dark" style="margin-bottom:20px;">Navigation</p>
        <a href="<?php echo esc_url( $shop_url ); ?>" class="footer-nav-link">Products</a>
        <a href="<?php echo esc_url( home_url( '/#research' ) ); ?>" class="footer-nav-link">Research</a>
        <a href="#" class="footer-nav-link">COA Library</a>
        <a href="#" class="footer-nav-link">About Syntra</a>
        <a href="#" class="footer-nav-link">Contact</a>
      </div>

      <div>
        <p class="mono-label mono-label--dark" style="margin-bottom:20px;">Legal</p>
        <a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>" class="footer-nav-link">Terms &amp; Conditions</a>
        <a href="<?php echo esc_url( home_url( '/refund-policy/' ) ); ?>" class="footer-nav-link">Returns &amp; Refund Policy</a>
        <a href="#" class="footer-nav-link">Privacy Policy</a>
        <a href="#" class="footer-nav-link">Shipping Policy</a>
        <div class="footer-compliance">
          <p class="compliance-text">All products sold strictly for in vitro laboratory research use only. Not for human consumption.</p>
        </div>
      </div>

      <div>
        <p class="mono-label mono-label--dark" style="margin-bottom:20px;">Research Updates</p>
        <p class="footer-newsletter-copy">Stay current on batch releases, new compounds, and laboratory insights.</p>
        <div class="footer-input-row">
          <?php if ( function_exists( 'mc4wp_show_form' ) ) : ?>
            <?php mc4wp_show_form(); ?>
          <?php else : ?>
            <input class="footer-input" type="email" placeholder="your@email.com" aria-label="Email address">
            <button class="footer-submit" type="button">→</button>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <p class="compliance-text">© <?php echo date( 'Y' ); ?> Syntra Global Pty Ltd (ABN 22 694 777 494). All rights reserved.</p>
      <p class="compliance-text">For In Vitro Research Use Only — Not For Human Consumption &nbsp;·&nbsp; Banora Point NSW 2486, Australia</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
