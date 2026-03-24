<?php get_header(); ?>

<?php
global $product;
if ( ! $product ) {
    $product = wc_get_product( get_the_ID() );
}
if ( ! $product ) {
    wp_redirect( home_url() );
    exit;
}

$slug       = $product->get_slug();
$p          = syntra_get_product_data( $slug );
$batch      = $p ? $p['batch']       : get_post_meta( $product->get_id(), 'syntra_batch',      true );
$purity     = $p ? $p['purity']      : get_post_meta( $product->get_id(), 'syntra_purity',     true );
$cas        = $p ? $p['cas']         : get_post_meta( $product->get_id(), 'syntra_cas',        true );
$formula    = $p ? $p['formula']     : get_post_meta( $product->get_id(), 'syntra_formula',    true );
$mw         = $p ? $p['mw']         : get_post_meta( $product->get_id(), 'syntra_mw',         true );
$storage    = $p ? $p['storage']     : get_post_meta( $product->get_id(), 'syntra_storage',    true );
$appearance = $p ? $p['appearance']  : get_post_meta( $product->get_id(), 'syntra_appearance', true );
$solubility = $p ? $p['solubility']  : get_post_meta( $product->get_id(), 'syntra_solubility', true );
$shelf_life = $p ? $p['shelfLife']   : '24 months from production date';
$descriptor = $p ? $p['descriptor']  : get_post_meta( $product->get_id(), 'syntra_descriptor', true );
$shop_url   = get_permalink( wc_get_page_id( 'shop' ) );
?>

<!-- BREADCRUMB -->
<div style="background:var(--white); border-bottom:1px solid var(--mist);">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
      <span>/</span>
      <a href="<?php echo esc_url( $shop_url ); ?>">Compound Library</a>
      <span>/</span>
      <span><?php echo esc_html( $product->get_name() ); ?></span>
    </div>
  </div>
</div>

<!-- SUB-NAV -->
<nav class="product-subnav" aria-label="Product sections">
  <div class="container">
    <div class="product-subnav__inner">
      <a href="#purchase"  class="product-subnav__link active">Purchase</a>
      <a href="#coa"       class="product-subnav__link">COA</a>
      <a href="#research"  class="product-subnav__link">Research</a>
      <a href="#specs"     class="product-subnav__link">Specs</a>
      <a href="#citations" class="product-subnav__link">Citations</a>
    </div>
  </div>
</nav>

<!-- PRODUCT HERO -->
<section class="product-hero" id="purchase">
  <div class="container">
    <div class="product-hero__inner">

      <!-- Gallery -->
      <div class="product-gallery">
        <div class="product-gallery__main">
          <?php if ( $product->get_image_id() ) : ?>
            <?php echo wp_get_attachment_image( $product->get_image_id(), 'large' ); ?>
          <?php else : ?>
            <div class="gallery-placeholder">
              <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                <rect x="30" y="8" width="20" height="35" rx="3" fill="#E6EBF0"/>
                <rect x="20" y="43" width="40" height="30" rx="3" fill="#E6EBF0"/>
                <circle cx="40" cy="60" r="8" fill="none" stroke="#97AEC8" stroke-width="1.5"/>
              </svg>
              <span>Product Image</span>
            </div>
          <?php endif; ?>
          <div class="coa-thumb-overlay">
            <span>COA ↓</span>
          </div>
        </div>
        <div class="product-gallery__thumbs">
          <div class="product-gallery__thumb active">
            <span>Product</span>
          </div>
          <div class="product-gallery__thumb">
            <span>COA Doc</span>
          </div>
          <?php if ( $batch ) : ?>
          <div class="product-gallery__thumb">
            <span><?php echo esc_html( $batch ); ?></span>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Product info -->
      <div class="product-info">
        <div class="product-info__chips">
          <?php if ( $purity ) : ?>
            <span class="verified-badge"><?php echo esc_html( $purity ); ?>% Purity</span>
          <?php endif; ?>
          <?php if ( $batch ) : ?>
            <span class="spec-chip"><?php echo esc_html( $batch ); ?></span>
          <?php endif; ?>
          <span class="spec-chip">Research Grade</span>
          <span class="spec-chip">HPLC Verified</span>
        </div>

        <h1 class="product-info__name"><?php echo esc_html( $product->get_name() ); ?></h1>

        <?php if ( $descriptor ) : ?>
          <div class="product-info__descriptor"><?php echo esc_html( $descriptor ); ?></div>
        <?php endif; ?>

        <div class="product-info__price">
          <?php echo $product->get_price_html(); ?>
        </div>

        <?php if ( $formula || $cas ) : ?>
        <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:20px;">
          <?php if ( $formula ) : ?>
            <span class="spec-chip"><?php echo esc_html( $formula ); ?></span>
          <?php endif; ?>
          <?php if ( $mw ) : ?>
            <span class="spec-chip">MW: <?php echo esc_html( $mw ); ?></span>
          <?php endif; ?>
          <?php if ( $cas ) : ?>
            <span class="spec-chip">CAS: <?php echo esc_html( $cas ); ?></span>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Qty + Add to Cart -->
        <form class="cart" method="post" enctype="multipart/form-data" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>">
          <div class="product-info__qty">
            <button type="button" class="qty-btn" data-action="minus" aria-label="Decrease quantity">−</button>
            <div class="qty-value">1</div>
            <button type="button" class="qty-btn" data-action="plus" aria-label="Increase quantity">+</button>
            <input type="hidden" name="quantity" class="qty-input" value="1" min="1">
          </div>
          <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>">
          <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
          <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn btn-primary btn-lg btn-full">
            Add to Cart — <?php echo $product->get_price_html(); ?>
          </button>
        </form>

        <div style="margin-top:16px; padding:12px; border:1px solid var(--mist); border-left:3px solid var(--teal); border-radius:0 8px 8px 0;">
          <p class="compliance-text">For in vitro laboratory research use only. Not for human consumption, diagnostic, or therapeutic use.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- COA SECTION -->
<?php if ( $p && ! empty( $p['coaBatches'] ) ) : ?>
<section class="coa-section grid-overlay" id="coa">
  <div class="container">
    <p class="mono-label mono-label--dark">Certificate of Analysis</p>
    <h2 style="color:var(--white);">BATCH VERIFICATION</h2>
    <p style="color:var(--pkg-blue); margin-top:12px; max-width:560px;">Every batch independently tested by accredited third-party laboratory. Full COA available on request.</p>
    <div class="coa-cards">
      <?php foreach ( $p['coaBatches'] as $batch_item ) : ?>
      <div class="coa-card <?php echo $batch_item['current'] ? 'coa-card--current' : ''; ?>">
        <?php if ( $batch_item['current'] ) : ?>
          <div style="font-family:var(--font-mono); font-size:8px; letter-spacing:0.1em; text-transform:uppercase; color:var(--teal); margin-bottom:8px;">Current Batch</div>
        <?php endif; ?>
        <div class="coa-card__purity"><?php echo esc_html( $batch_item['purity'] ); ?></div>
        <div class="coa-card__purity-label">HPLC Purity</div>
        <div class="coa-card__row">
          <span class="coa-card__row-label">Lot Number</span>
          <span class="coa-card__row-value"><?php echo esc_html( $batch_item['id'] ); ?></span>
        </div>
        <div class="coa-card__row">
          <span class="coa-card__row-label">Test Date</span>
          <span class="coa-card__row-value"><?php echo esc_html( $batch_item['date'] ); ?></span>
        </div>
        <div class="coa-card__row">
          <span class="coa-card__row-label">Labeled</span>
          <span class="coa-card__row-value"><?php echo esc_html( $batch_item['labeled'] ); ?></span>
        </div>
        <div class="coa-card__row">
          <span class="coa-card__row-label">Actual</span>
          <span class="coa-card__row-value"><?php echo esc_html( $batch_item['actual'] ); ?></span>
        </div>
        <button class="coa-card__btn">View COA →</button>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- RESEARCH STATS -->
<?php if ( $p && ! empty( $p['stats'] ) ) : ?>
<section class="stats-section" id="research">
  <div class="container">
    <p class="mono-label">Research Data</p>
    <h2>KEY FINDINGS</h2>
    <div class="stat-cards">
      <?php foreach ( $p['stats'] as $stat ) : ?>
      <div class="stat-card">
        <span class="stat-card__emoji"><?php echo $stat['emoji']; ?></span>
        <div class="stat-card__num"><?php echo esc_html( $stat['num'] ); ?></div>
        <div class="stat-card__label"><?php echo esc_html( $stat['label'] ); ?></div>
        <div class="stat-card__sub"><?php echo esc_html( $stat['sub'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- KEY FINDING CHART -->
<?php if ( $p && ! empty( $p['finding'] ) ) :
  $f = $p['finding'];
  $bar_colors = [ 'teal', 'blue', 'muted' ];
?>
<section class="finding-section">
  <div class="container">
    <div style="display:grid; grid-template-columns:1fr; gap:48px; align-items:start;">
      <div style="max-width:480px;">
        <div class="finding-hero">
          <span class="finding-hero__num"><?php echo esc_html( $f['number'] ); ?></span>
          <span class="finding-hero__unit"><?php echo esc_html( $f['unit'] ); ?></span>
        </div>
        <div class="finding-hero__title"><?php echo esc_html( $f['title'] ); ?></div>
        <p class="finding-hero__desc"><?php echo esc_html( $f['desc'] ); ?></p>
      </div>
      <div>
        <div class="finding-chart-wrap">
          <div class="finding-chart-title"><?php echo esc_html( $f['chartTitle'] ); ?></div>
          <?php foreach ( $f['bars'] as $i => $bar ) :
            $color = $bar_colors[ min( $i, 2 ) ];
          ?>
          <div class="finding-bar-row">
            <div class="finding-bar-label">
              <span><?php echo esc_html( $bar['label'] ); ?></span>
              <span><?php echo esc_html( $bar['value'] ); ?></span>
            </div>
            <div class="finding-bar-track">
              <div class="finding-bar-fill finding-bar-fill--<?php echo esc_attr( $color ); ?>"
                   style="--bar-w:<?php echo esc_attr( $bar['pct'] ); ?>%"></div>
            </div>
          </div>
          <?php endforeach; ?>
          <div class="finding-chart-source"><?php echo esc_html( $f['chartSource'] ); ?></div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- PURITY CHART -->
<?php if ( $p && ! empty( $p['purityData'] ) ) : ?>
<section class="purity-section" id="specs">
  <div class="container">
    <p class="mono-label">Analytical Data</p>
    <h2>PURITY VERIFICATION</h2>
    <div class="purity-chart-card" style="margin-top:32px;">
      <div style="font-family:var(--font-mono); font-size:9px; letter-spacing:0.12em; text-transform:uppercase; color:var(--slate); margin-bottom:16px;">
        Purity by Method — Batch <?php echo esc_html( $p['batchFull'] ?? $p['batch'] ); ?>
      </div>
      <canvas id="purityChart" height="160"></canvas>
    </div>

    <!-- Spec table -->
    <table class="spec-table" style="margin-top:48px;">
      <thead>
        <tr>
          <th>Specification</th>
          <th>Value</th>
        </tr>
      </thead>
      <tbody>
        <?php if ( $cas )        : ?><tr><td>CAS Number</td>        <td><?php echo esc_html( $cas ); ?></td></tr><?php endif; ?>
        <?php if ( $formula )    : ?><tr><td>Molecular Formula</td>  <td><?php echo esc_html( $formula ); ?></td></tr><?php endif; ?>
        <?php if ( $mw )         : ?><tr><td>Molecular Weight</td>   <td><?php echo esc_html( $mw ); ?></td></tr><?php endif; ?>
        <?php if ( $purity )     : ?><tr><td>Purity (HPLC)</td>      <td><?php echo esc_html( $purity ); ?>%</td></tr><?php endif; ?>
        <?php if ( $appearance ) : ?><tr><td>Appearance</td>         <td><?php echo esc_html( $appearance ); ?></td></tr><?php endif; ?>
        <?php if ( $solubility ) : ?><tr><td>Solubility</td>         <td><?php echo esc_html( $solubility ); ?></td></tr><?php endif; ?>
        <?php if ( $storage )    : ?><tr><td>Storage</td>            <td><?php echo esc_html( $storage ); ?></td></tr><?php endif; ?>
        <tr><td>Shelf Life</td>          <td><?php echo esc_html( $shelf_life ); ?></td></tr>
        <tr><td>Research Grade</td>      <td>Yes — For In Vitro Use Only</td></tr>
      </tbody>
    </table>
  </div>
</section>

<script>
(function () {
  var ctx = document.getElementById('purityChart');
  if (!ctx || typeof Chart === 'undefined') return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['HPLC', 'Mass Spec', 'NMR'],
      datasets: [{
        data: <?php echo json_encode( $p['purityData'] ); ?>,
        backgroundColor: ['#2FB7B3', '#2FB7B3', '#2FB7B3'],
        borderRadius: 6,
        barThickness: 48,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function(ctx) { return ctx.raw + '%'; }
          }
        }
      },
      scales: {
        y: {
          min: 98,
          max: 100,
          ticks: {
            font: { family: "'IBM Plex Mono', monospace", size: 10 },
            color: '#4E5F71',
            callback: function(v) { return v + '%'; }
          },
          grid: { color: '#E6EBF0' }
        },
        x: {
          ticks: {
            font: { family: "'IBM Plex Mono', monospace", size: 10 },
            color: '#4E5F71'
          },
          grid: { display: false }
        }
      }
    }
  });
})();
</script>
<?php endif; ?>

<!-- CITATIONS -->
<?php if ( $p && ! empty( $p['citations'] ) ) : ?>
<section class="citations-section" id="citations">
  <div class="container">
    <p class="mono-label">Peer-Reviewed Literature</p>
    <h2>RESEARCH CITATIONS</h2>
    <div class="citation-cards">
      <?php foreach ( $p['citations'] as $cit ) : ?>
      <div class="citation-card">
        <div class="citation-card__journal"><?php echo esc_html( $cit['journal'] ); ?></div>
        <div class="citation-card__title"><?php echo esc_html( $cit['title'] ); ?></div>
        <div class="citation-card__meta">
          <span class="citation-card__year"><?php echo esc_html( $cit['year'] ); ?></span>
          <span class="citation-card__author"><?php echo esc_html( $cit['author'] ); ?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <p class="compliance-text" style="margin-top:32px; opacity:0.6;">
      All citations refer to published peer-reviewed in vitro research. Data presented for scientific reference only. No claims made regarding human therapeutic use.
    </p>
  </div>
</section>
<?php endif; ?>

<!-- MOBILE STICKY CTA -->
<div class="mobile-sticky-cta" id="mobileSticyCta">
  <div class="mobile-sticky-cta__price"><?php echo $product->get_price_html(); ?></div>
  <form method="post" style="flex:1;" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>">
    <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>">
    <input type="hidden" name="quantity" value="1">
    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn btn-primary btn-full">
      Add to Cart
    </button>
  </form>
</div>

<?php get_footer(); ?>
