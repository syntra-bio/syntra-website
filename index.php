<?php get_header(); ?>
<div class="container" style="padding-top:80px; padding-bottom:80px; text-align:center;">
  <h1>Welcome to Syntra</h1>
  <p style="margin-top:16px;">Research-grade compounds. Independently verified.</p>
  <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary" style="margin-top:32px; display:inline-flex;">
      Explore Compounds
    </a>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
