<?php get_header(); ?>

<?php
$products = wc_get_products( [ 'status' => 'publish', 'limit' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
// Attach total_sales to each product for JS sorting
foreach ( $products as $p ) {
    $p->syntra_sales = (int) get_post_meta( $p->get_id(), 'total_sales', true );
}
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
      <button class="filter-pill" data-filter="bestsellers" id="pillBestsellers">Best Sellers</button>
      <button class="filter-pill active" data-filter="all" id="pillAll">All (<?php echo $count; ?>)</button>
      <button class="filter-pill" data-filter="peptide">Peptides</button>
      <button class="filter-pill" data-filter="neuropeptide">Neuropeptides</button>
      <button class="filter-pill" data-filter="small molecule">Small Molecules</button>
      <button class="filter-pill" data-filter="stack">Stacks</button>
      <button class="filter-pill" data-filter="coenzyme">Coenzymes</button>
    </div>
    <select class="sort-select" id="sortSelect" aria-label="Sort products">
      <option value="default">Sort: Default</option>
      <option value="bestsellers">Sort: Best Sellers</option>
      <option value="price-asc">Sort: Price ↑</option>
      <option value="price-desc">Sort: Price ↓</option>
      <option value="name-asc">Sort: Name A–Z</option>
      <option value="purity-desc">Sort: Purity ↓</option>
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
        $agg      = function_exists('syntra_variant_aggregate_stock') ? syntra_variant_aggregate_stock( $product->get_id() ) : null;
        if ( $agg === 'instock' || ( $agg === null && $product->is_in_stock() ) ) {
            $stock = 'In Stock'; $stockCls = ' product-card__stock--in';
        } elseif ( $agg === 'onbackorder' ) {
            $stock = 'Backorder'; $stockCls = ' product-card__stock--bo';
        } else {
            $stock = 'Out of Stock'; $stockCls = ' product-card__stock--out';
        }
        $price    = $product->get_price();
      ?>
      <a class="product-card"
         href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
         data-category="<?php echo esc_attr( $category ); ?>"
         data-purity="<?php echo esc_attr( $purity ); ?>"
         data-price="<?php echo esc_attr( $price ); ?>"
         data-name="<?php echo esc_attr( $product->get_name() ); ?>"
         data-sales="<?php echo esc_attr( isset($product->syntra_sales) ? $product->syntra_sales : 0 ); ?>">
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
  var pills      = document.querySelectorAll('.filter-pill');
  var cards      = document.querySelectorAll('.product-card[data-category]');
  var countEl    = document.getElementById('catalogueCount');
  var emptyEl    = document.getElementById('emptyState');
  var grid       = document.getElementById('productGrid');
  var sortSelect = document.getElementById('sortSelect');

  // Store original DOM order
  var originalOrder = Array.from(cards);

  function sortCards(val) {
    var cardArray = Array.from(cards);
    cardArray.sort(function (a, b) {
      if (val === 'bestsellers') return parseInt(b.dataset.sales||0) - parseInt(a.dataset.sales||0);
      if (val === 'price-asc')   return parseFloat(a.dataset.price)  - parseFloat(b.dataset.price);
      if (val === 'price-desc')  return parseFloat(b.dataset.price)  - parseFloat(a.dataset.price);
      if (val === 'name-asc')    return a.dataset.name.localeCompare(b.dataset.name);
      if (val === 'purity-desc') return parseFloat(b.dataset.purity||0) - parseFloat(a.dataset.purity||0);
      // default: restore original order
      return originalOrder.indexOf(a) - originalOrder.indexOf(b);
    });
    cardArray.forEach(function (card) { grid.appendChild(card); });
    grid.appendChild(emptyEl);
  }

  function applyFilter(filter) {
    var visible = 0;
    cards.forEach(function (card) {
      var match = filter === 'all' || filter === 'bestsellers' || card.dataset.category === filter;
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    countEl.textContent = 'Showing ' + visible + ' compound' + (visible !== 1 ? 's' : '');
    emptyEl.classList.toggle('visible', visible === 0);
    // Best sellers pill also triggers sort
    if (filter === 'bestsellers') {
      sortSelect.value = 'bestsellers';
      sortCards('bestsellers');
    }
  }

  pills.forEach(function (pill) {
    pill.addEventListener('click', function () {
      pills.forEach(function (p) { p.classList.remove('active'); });
      pill.classList.add('active');
      applyFilter(pill.dataset.filter);
    });
  });

  sortSelect.addEventListener('change', function () {
    sortCards(this.value);
  });

  // Auto-activate from URL param ?sort=bestsellers
  var urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('sort') === 'bestsellers') {
    pills.forEach(function (p) { p.classList.remove('active'); });
    document.getElementById('pillBestsellers').classList.add('active');
    applyFilter('bestsellers');
  }
})();
</script>

<?php get_footer(); ?>
