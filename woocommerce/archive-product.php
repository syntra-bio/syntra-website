<?php get_header(); ?>

<?php
$products = wc_get_products( [ 'status' => 'publish', 'limit' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
$count    = count( $products );
?>

<!-- CATALOGUE HERO -->
<section class="cat-hero">
  <div class="container">
    <div class="cat-hero__inner">
      <div>
        <div class="cat-hero__breadcrumb">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
          <span>/</span>
          <span>Compound Library</span>
        </div>
        <h1 class="cat-hero__title">Compound<br>Library</h1>
        <p class="cat-hero__subline"><?php echo esc_html( $count ); ?> research-grade compounds. Every batch independently verified.</p>
      </div>
      <div class="cat-hero__stats">
        <div class="cat-hero__stat">
          <div class="cat-hero__stat-label">Compounds</div>
          <div class="cat-hero__stat-value accent"><?php echo str_pad( $count, 2, '0', STR_PAD_LEFT ); ?></div>
        </div>
        <div class="cat-hero__stat">
          <div class="cat-hero__stat-label">Purity Standard</div>
          <div class="cat-hero__stat-value">99%+</div>
        </div>
        <div class="cat-hero__stat">
          <div class="cat-hero__stat-label">Validation</div>
          <div class="cat-hero__stat-value">HPLC+MS</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FILTER + SORT BAR -->
<div class="filter-bar" id="filterBar">
  <div class="filter-bar__inner container">
    <div class="filter-pills" role="group" aria-label="Filter by category">
      <button class="filter-pill active" data-filter="all">All (<?php echo $count; ?>)</button>
      <button class="filter-pill" data-filter="peptide">Peptides</button>
      <button class="filter-pill" data-filter="nootropic">Nootropics</button>
      <button class="filter-pill" data-filter="longevity">Longevity</button>
    </div>
    <select class="sort-select" id="sortSelect" aria-label="Sort products">
      <option value="purity-desc">Sort: Purity ↓</option>
      <option value="purity-asc">Sort: Purity ↑</option>
      <option value="price-asc">Sort: Price ↑</option>
      <option value="price-desc">Sort: Price ↓</option>
      <option value="name-asc">Sort: Name A–Z</option>
    </select>
  </div>
</div>

<!-- CATALOGUE GRID -->
<section class="catalogue">
  <div class="container">
    <div class="catalogue__count" id="catalogueCount">Showing <?php echo $count; ?> compounds</div>
    <div class="catalogue__grid" id="productGrid">

      <?php foreach ( $products as $product ) :
        $slug     = $product->get_slug();
        $pdata    = syntra_get_product_data( $slug );
        $batch    = $pdata ? $pdata['batch']    : get_post_meta( $product->get_id(), 'syntra_batch',    true );
        $purity   = $pdata ? $pdata['purity']   : get_post_meta( $product->get_id(), 'syntra_purity',   true );
        $formula  = $pdata ? $pdata['formula']  : get_post_meta( $product->get_id(), 'syntra_formula',  true );
        $mw       = $pdata ? $pdata['mw']       : get_post_meta( $product->get_id(), 'syntra_mw',       true );
        $category = $pdata ? $pdata['category'] : get_post_meta( $product->get_id(), 'syntra_category', true );
        $descriptor = $pdata ? $pdata['descriptor'] : get_post_meta( $product->get_id(), 'syntra_descriptor', true );
        $stock    = $product->is_in_stock() ? 'In Stock' : 'Out of Stock';
        $stockCls = $product->is_in_stock() ? '' : ' low';
        $price    = $product->get_price();
      ?>
      <a class="product-card"
         href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
         data-category="<?php echo esc_attr( $category ); ?>"
         data-purity="<?php echo esc_attr( $purity ); ?>"
         data-price="<?php echo esc_attr( $price ); ?>"
         data-name="<?php echo esc_attr( $product->get_name() ); ?>">
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
          <?php if ( $descriptor ) : ?>
            <div class="product-card__type"><?php echo esc_html( $descriptor ); ?></div>
          <?php endif; ?>
          <div class="product-card__name"><?php echo esc_html( $product->get_name() ); ?></div>
          <?php if ( $formula ) : ?>
            <div class="product-card__formula"><?php echo esc_html( $formula ); ?><?php echo $mw ? ' · MW: ' . esc_html( $mw ) : ''; ?></div>
          <?php endif; ?>
          <div class="product-card__footer">
            <div class="product-card__price"><?php echo $product->get_price_html(); ?></div>
            <div class="product-card__stock<?php echo esc_attr( $stockCls ); ?>"><?php echo esc_html( $stock ); ?></div>
          </div>
        </div>
      </a>
      <?php endforeach; ?>

      <div class="catalogue__empty" id="emptyState">
        <p>No compounds match this filter.</p>
      </div>

    </div>
  </div>
</section>

<script>
(function () {
  var pills   = document.querySelectorAll('.filter-pill');
  var cards   = document.querySelectorAll('.product-card[data-category]');
  var countEl = document.getElementById('catalogueCount');
  var emptyEl = document.getElementById('emptyState');
  var grid    = document.getElementById('productGrid');

  function applyFilter(filter) {
    var visible = 0;
    cards.forEach(function (card) {
      var match = filter === 'all' || card.dataset.category === filter;
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    countEl.textContent = 'Showing ' + visible + ' compound' + (visible !== 1 ? 's' : '');
    emptyEl.classList.toggle('visible', visible === 0);
  }

  pills.forEach(function (pill) {
    pill.addEventListener('click', function () {
      pills.forEach(function (p) { p.classList.remove('active'); });
      pill.classList.add('active');
      applyFilter(pill.dataset.filter);
    });
  });

  document.getElementById('sortSelect').addEventListener('change', function () {
    var val       = this.value;
    var cardArray = Array.from(cards);
    cardArray.sort(function (a, b) {
      if (val === 'purity-desc') return parseFloat(b.dataset.purity) - parseFloat(a.dataset.purity);
      if (val === 'purity-asc')  return parseFloat(a.dataset.purity) - parseFloat(b.dataset.purity);
      if (val === 'price-asc')   return parseFloat(a.dataset.price)  - parseFloat(b.dataset.price);
      if (val === 'price-desc')  return parseFloat(b.dataset.price)  - parseFloat(a.dataset.price);
      if (val === 'name-asc')    return a.dataset.name.localeCompare(b.dataset.name);
      return 0;
    });
    cardArray.forEach(function (card) { grid.appendChild(card); });
    grid.appendChild(emptyEl);
  });
})();
</script>

<?php get_footer(); ?>
