<?php get_header(); ?>

<?php
$shop_url = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '#';
$products = class_exists( 'WooCommerce' ) ? wc_get_products( [ 'status' => 'publish', 'limit' => 6, 'orderby' => 'popularity', 'order' => 'DESC' ] ) : [];
?>

<!-- HERO -->
<section class="hero grid-overlay" id="home">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <div class="hero-label fade-up">— SYNTRA RESEARCH COMPOUNDS</div>
        <h1 class="hero__headline fade-up">
          SYNTRA:<br>
          PRECISION<br>
          RESEARCH<br>
          COMPOUNDS.
        </h1>
        <p class="hero__subline fade-up">Clinically aligned. Rigorously verified.</p>
        <div class="hero__ctas fade-up">
          <a href="<?php echo esc_url( $shop_url . '?sort=bestsellers' ); ?>" class="btn btn-primary btn-lg">Top Compounds</a>
          <a href="#coa" class="btn btn-secondary btn-lg" style="border-color:rgba(151,174,200,0.4); color:var(--pkg-blue);">View Batch COAs</a>
        </div>
        <div class="hero__stats fade-up">
          <div>
            <div class="hero__stat-label">Purity Standard</div>
            <div class="hero__stat-value" style="color:var(--teal);">99%+</div>
          </div>
          <div>
            <div class="hero__stat-label">Compounds</div>
            <div class="hero__stat-value"><?php echo str_pad( wp_count_posts('product')->publish, 2, '0', STR_PAD_LEFT ); ?></div>
          </div>
          <div>
            <div class="hero__stat-label">Validation</div>
            <div class="hero__stat-value">HPLC+MS</div>
          </div>
          <div>
            <div class="hero__stat-label">Storage</div>
            <div class="hero__stat-value">−20°C</div>
          </div>
        </div>
      </div>
      <?php
      $hero_img_path = get_template_directory() . '/assets/images/hero-shot.jpg';
      $hero_img_url  = get_template_directory_uri() . '/assets/images/hero-shot.jpg';
      $has_hero_img  = file_exists( $hero_img_path );
      ?>
      <div class="hero__image-wrap fade-up<?php echo $has_hero_img ? ' hero__image-wrap--ready' : ' hero__image-wrap--placeholder'; ?>">
        <?php if ( $has_hero_img ) : ?>
          <img src="<?php echo esc_url( $hero_img_url ); ?>"
               alt="Syntra Research Compounds — Hero Shot"
               class="hero__photo"
               loading="eager"
               width="600">
        <?php else : ?>
          <div class="hero__image-placeholder">
            <svg width="64" height="64" viewBox="0 0 80 80" fill="none">
              <rect x="30" y="8" width="20" height="35" rx="3" fill="#1F3552"/>
              <rect x="20" y="43" width="40" height="30" rx="3" fill="#1F3552"/>
              <line x1="30" y1="20" x2="50" y2="20" stroke="#2FB7B3" stroke-width="2"/>
              <line x1="30" y1="28" x2="50" y2="28" stroke="#97AEC8" stroke-width="1.5"/>
              <circle cx="40" cy="60" r="8" fill="none" stroke="#2FB7B3" stroke-width="1.5"/>
            </svg>
            <span>Hero Shot Coming Soon</span>
          </div>
        <?php endif; ?>
        <div class="hero__verified-badge">
          <span class="verified-badge">99%+ Purity · HPLC Verified</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<section class="trust-bar grid-overlay">
  <div class="container">
    <div class="trust-bar__grid">
      <div class="trust-bar__item">
        <svg class="trust-bar__icon" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
          <path d="M14 3v8l4 4M14 3A11 11 0 1 0 25 14"/><circle cx="14" cy="14" r="2" fill="currentColor" stroke="none"/>
        </svg>
        <div class="trust-bar__text">
          <div class="trust-bar__label">Purity Standard</div>
          <div class="trust-bar__value">99%+ Guaranteed</div>
          <a href="#coa" class="trust-bar__link">View COA Library</a>
        </div>
      </div>
      <div class="trust-bar__item">
        <svg class="trust-bar__icon" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
          <circle cx="14" cy="14" r="11"/>
          <path d="M14 8v6l3 3M9 4l2 2M19 4l-2 2"/>
          <path d="M5 20c0-2 2-3 4-2s3 1 5 0 3-1 5 0 4 0 4 2"/>
        </svg>
        <div class="trust-bar__text">
          <div class="trust-bar__label">Cold-Chain Optimised</div>
          <div class="trust-bar__value">2–8°C Validated Shipping</div>
          <div class="trust-bar__sub">Lyophilised &amp; sealed</div>
        </div>
      </div>
      <div class="trust-bar__item">
        <svg class="trust-bar__icon" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
          <rect x="9" y="2" width="10" height="6" rx="1"/>
          <path d="M11 8v5l-5 9h16l-5-9V8"/>
          <circle cx="14" cy="18" r="2" fill="currentColor" stroke="none"/>
        </svg>
        <div class="trust-bar__text">
          <div class="trust-bar__label">Third-Party Validated</div>
          <div class="trust-bar__value">HPLC + Mass Spectrometry</div>
          <div class="trust-bar__sub">Independent laboratory testing</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- COLLECTION PREVIEW -->
<section class="collection" id="products">
  <div class="container">
    <div class="collection__header">
      <p class="mono-label">01 / Top Compounds</p>
      <h2>BEST SELLERS</h2>
      <p style="margin-top:12px; max-width:560px;">Our most ordered research compounds. Every batch independently verified for purity, potency, and stability.</p>
    </div>

    <div class="collection__grid">
      <?php if ( ! empty( $products ) ) : ?>
        <?php foreach ( $products as $product ) :
          $slug      = $product->get_slug();
          $pdata     = syntra_get_product_data( $slug );
          $batch     = $pdata ? $pdata['batch']    : get_post_meta( $product->get_id(), 'syntra_batch', true );
          $purity    = $pdata ? $pdata['purity']   : get_post_meta( $product->get_id(), 'syntra_purity', true );
          $formula   = $pdata ? $pdata['formula']  : get_post_meta( $product->get_id(), 'syntra_formula', true );
          $mw        = $pdata ? $pdata['mw']       : get_post_meta( $product->get_id(), 'syntra_mw', true );
          $category  = $pdata ? $pdata['descriptor'] : get_post_meta( $product->get_id(), 'syntra_descriptor', true );
          $agg = function_exists('syntra_variant_aggregate_stock') ? syntra_variant_aggregate_stock( $product->get_id() ) : null;
          if ( $agg === 'instock' || ( $agg === null && $product->is_in_stock() ) ) {
              $stock = 'In Stock'; $stock_cls = 'product-card__stock--in';
          } elseif ( $agg === 'onbackorder' ) {
              $stock = 'Backorder'; $stock_cls = 'product-card__stock--bo';
          } else {
              $stock = 'Out of Stock'; $stock_cls = 'product-card__stock--out';
          }
        ?>
        <a class="product-card" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
          <div class="product-card__img">
            <?php if ( $product->get_image_id() ) : ?>
              <?php echo $product->get_image( 'woocommerce_thumbnail' ); ?>
            <?php else : ?>
              <div class="product-card__img-placeholder">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="18" y="4" width="12" height="22" rx="2" fill="#E6EBF0"/><rect x="12" y="26" width="24" height="18" rx="2" fill="#E6EBF0"/><circle cx="24" cy="36" r="5" fill="none" stroke="#97AEC8" stroke-width="1.5"/></svg>
              </div>
            <?php endif; ?>
            <?php if ( $batch ) : ?>
              <span class="product-card__batch"><?php echo esc_html( $batch ); ?></span>
            <?php endif; ?>
            <?php if ( $purity ) : ?>
              <span class="product-card__purity"><?php echo esc_html( $purity ); ?>%</span>
            <?php endif; ?>
          </div>
          <div class="product-card__body">
            <?php if ( $category ) : ?>
              <div class="product-card__type"><?php echo esc_html( $category ); ?></div>
            <?php endif; ?>
            <div class="product-card__name"><?php echo esc_html( $product->get_name() ); ?></div>
            <?php if ( $formula && $mw ) : ?>
              <div class="product-card__formula"><?php echo esc_html( $formula ); ?> · MW: <?php echo esc_html( $mw ); ?></div>
            <?php endif; ?>
            <div class="product-card__footer">
              <div class="product-card__price"><?php echo $product->get_price_html(); ?></div>
              <div class="product-card__stock <?php echo esc_attr( $stock_cls ); ?>"><?php echo esc_html( $stock ); ?></div>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      <?php else : ?>
        <?php
        // Fallback: show static cards from product data
        require_once get_template_directory() . '/inc/product-data.php';
        $i = 0;
        foreach ( SYNTRA_PRODUCTS as $slug => $p ) :
          if ( $i >= 6 ) break; $i++;
        ?>
        <a class="product-card" href="<?php echo esc_url( $shop_url . $slug . '/' ); ?>">
          <div class="product-card__img">
            <div class="product-card__img-placeholder">
              <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="18" y="4" width="12" height="22" rx="2" fill="#E6EBF0"/><rect x="12" y="26" width="24" height="18" rx="2" fill="#E6EBF0"/><circle cx="24" cy="36" r="5" fill="none" stroke="#97AEC8" stroke-width="1.5"/></svg>
            </div>
            <span class="product-card__batch"><?php echo esc_html( $p['batch'] ); ?></span>
            <span class="product-card__purity"><?php echo esc_html( $p['purity'] ); ?>%</span>
          </div>
          <div class="product-card__body">
            <div class="product-card__type"><?php echo esc_html( $p['descriptor'] ); ?></div>
            <div class="product-card__name"><?php echo esc_html( $p['name'] ); ?></div>
            <div class="product-card__formula"><?php echo esc_html( $p['formula'] ); ?> · MW: <?php echo esc_html( $p['mw'] ); ?></div>
            <div class="product-card__footer">
              <div class="product-card__price"><?php echo esc_html( $p['price'] ); ?></div>
              <div class="product-card__stock product-card__stock--in">In Stock</div>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="collection__cta">
      <a href="<?php echo esc_url( $shop_url . '?sort=bestsellers' ); ?>" class="btn btn-secondary">View All Compounds →</a>
    </div>
  </div>
</section>

<!-- LAB STANDARDS -->
<section class="lab-standards grid-overlay" id="research">
  <div class="container">
    <div class="lab-standards__header">
      <p class="mono-label mono-label--dark">02 / Lab Standards</p>
      <h2>WHY SYNTRA VERIFICATION<br>MATTERS TO RESEARCHERS</h2>
    </div>
    <div class="lab-standards__grid">
      <div class="lab-pillar">
        <div class="lab-pillar__num">01 / HPLC</div>
        <div class="lab-pillar__title">High-Performance Liquid Chromatography</div>
        <p class="lab-pillar__text">Every batch analysed by HPLC to confirm purity percentage, identify impurities, and validate compound identity against reference standards.</p>
      </div>
      <div class="lab-pillar">
        <div class="lab-pillar__num">02 / MS</div>
        <div class="lab-pillar__title">Mass Spectrometry Confirmation</div>
        <p class="lab-pillar__text">Molecular weight confirmation via mass spectrometry provides secondary verification of compound identity and structural integrity post-synthesis.</p>
      </div>
      <div class="lab-pillar">
        <div class="lab-pillar__num">03 / COA</div>
        <div class="lab-pillar__title">Certificate of Analysis Per Batch</div>
        <p class="lab-pillar__text">Independent third-party laboratory reports available for every batch. Batch numbers traceable from order confirmation through to delivery.</p>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
