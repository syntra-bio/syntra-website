<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-59V8GGQX');</script>
  <!-- End Google Tag Manager -->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-59V8GGQX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- ANNOUNCEMENT BAR -->
<div class="announcement-bar">
  <div class="announcement-bar__track">
    <span class="announcement-bar__text">
      FOR RESEARCH USE ONLY &mdash; All compounds sold for in vitro laboratory research &nbsp;&bull;&nbsp; 99%+ PURITY GUARANTEED &nbsp;&bull;&nbsp; THIRD-PARTY HPLC &amp; MASS SPECTROMETRY VERIFIED &nbsp;&bull;&nbsp; COLD-CHAIN OPTIMISED SHIPPING &nbsp;&bull;&nbsp;
    </span>
    <span class="announcement-bar__text" aria-hidden="true">
      FOR RESEARCH USE ONLY &mdash; All compounds sold for in vitro laboratory research &nbsp;&bull;&nbsp; 99%+ PURITY GUARANTEED &nbsp;&bull;&nbsp; THIRD-PARTY HPLC &amp; MASS SPECTROMETRY VERIFIED &nbsp;&bull;&nbsp; COLD-CHAIN OPTIMISED SHIPPING &nbsp;&bull;&nbsp;
    </span>
  </div>
</div>

<!-- HEADER -->
<header class="site-header" id="siteHeader">
  <div class="site-header__inner container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-text">SYNTRA</a>

    <nav class="site-header__nav" aria-label="Primary navigation">
      <?php
      $shop_url    = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '#';
      $current_url = ( is_shop() || is_product_category() || is_product() ) ? 'active' : '';
      ?>
      <a href="<?php echo esc_url( $shop_url ); ?>" class="site-header__nav-link <?php echo esc_attr( $current_url ); ?>">Products</a>
      <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="site-header__nav-link <?php echo is_home() || is_singular( 'post' ) ? 'active' : ''; ?>">Research</a>
      <a href="#" class="site-header__nav-link">COA Library</a>
      <a href="#" class="site-header__nav-link">About</a>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="site-header__nav-link">Contact</a>
    </nav>

    <div class="site-header__icons">
      <?php if ( class_exists( 'WooCommerce' ) ) : ?>
        <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="icon-btn" aria-label="Account">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
        </a>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="icon-btn" aria-label="Cart">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          <?php $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
          <span class="cart-count js-cart-count"<?php echo $count === 0 ? ' style="display:none"' : ''; ?>><?php echo $count; ?></span>
        </a>
      <?php endif; ?>
      <!-- Hamburger — mobile only -->
      <button class="hamburger icon-btn" id="mobileMenuBtn" aria-label="Open navigation" aria-expanded="false" aria-controls="mobileNav">
        <svg class="hamburger__icon hamburger__icon--open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
          <line x1="3" y1="6"  x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
        <svg class="hamburger__icon hamburger__icon--close" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" style="display:none">
          <line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/>
        </svg>
      </button>
    </div>
  </div>
</header>

<!-- MOBILE NAV DRAWER -->
<div class="mobile-nav" id="mobileNav" aria-hidden="true">
  <nav aria-label="Mobile navigation">
    <?php
    $shop_url    = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '#';
    ?>
    <a href="<?php echo esc_url( $shop_url ); ?>" class="mobile-nav__link">Products</a>
    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="mobile-nav__link">Research</a>
    <a href="#" class="mobile-nav__link">COA Library</a>
    <a href="#" class="mobile-nav__link">About</a>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-nav__link">Contact</a>
  </nav>
  <div class="mobile-nav__footer">
    <span class="compliance-text">FOR RESEARCH USE ONLY · IN VITRO LABORATORY USE</span>
  </div>
</div>
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
