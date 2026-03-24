<?php
/**
 * Single — Individual peptide research article
 *
 * @package Syntra
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

if ( ! have_posts() ) {
    wp_redirect( home_url( '/blog/' ) );
    exit;
}

the_post();

$slug = get_post_field( 'post_name', get_the_ID() );
$p    = syntra_get_blog_data( $slug );

// Bail-safe: if no data, render minimal fallback
$has_data = ( $p !== null );
?>

<!-- ═══ BREADCRUMB ═══ -->
<nav class="post-breadcrumb" aria-label="Breadcrumb">
    <div class="container">
        <ol class="post-breadcrumb__list">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li aria-hidden="true">/</li>
            <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Research Library</a></li>
            <li aria-hidden="true">/</li>
            <li aria-current="page"><?php the_title(); ?></li>
        </ol>
    </div>
</nav>

<?php if ( $has_data ) : ?>

<!-- ═══ STICKY SUB-NAV ═══ -->
<nav class="product-subnav" aria-label="Article sections">
    <div class="container">
        <div class="product-subnav__inner">
            <a class="product-subnav__link active" href="#introduction">Introduction</a>
            <a class="product-subnav__link" href="#mechanisms">Mechanisms</a>
            <a class="product-subnav__link" href="#research">Research</a>
            <a class="product-subnav__link" href="#safety">Safety</a>
            <a class="product-subnav__link" href="#citations">Citations</a>
        </div>
    </div>
</nav>

<!-- ═══ HERO / INTRODUCTION ═══ -->
<section id="introduction" class="post-hero"
         style="background: <?php echo esc_attr( $p['gradient'] ); ?>;">
    <div class="container">
        <div class="post-hero__inner">
            <div class="post-hero__badge-row">
                <span class="post-hero__cat"><?php echo esc_html( $p['category'] ); ?></span>
                <span class="post-hero__compliance">In Vitro Research Only</span>
            </div>

            <h1 class="post-hero__title"><?php the_title(); ?></h1>

            <div class="post-hero__stat-block">
                <span class="post-hero__stat"><?php echo esc_html( $p['hero_stat'] ); ?></span>
                <span class="post-hero__stat-label"><?php echo esc_html( $p['hero_label'] ); ?></span>
            </div>

            <p class="post-hero__intro"><?php echo esc_html( $p['intro'] ); ?></p>

            <p class="post-hero__disclaimer">
                For in vitro laboratory research use only. Not for human consumption.
                All findings described are from preclinical or in vitro models.
            </p>
        </div>
    </div>
</section>

<!-- ═══ MECHANISMS ═══ -->
<section id="mechanisms" class="post-section">
    <div class="container">
        <h2 class="post-section__heading">MECHANISMS OF ACTION</h2>
        <p class="post-section__sub">In vitro and preclinical mechanistic observations</p>
        <div class="mechanism-cards">
            <?php foreach ( $p['mechanisms'] as $mech ) : ?>
            <div class="mechanism-card">
                <div class="mechanism-card__icon"><?php echo esc_html( $mech['emoji'] ); ?></div>
                <h3 class="mechanism-card__title"><?php echo esc_html( $mech['title'] ); ?></h3>
                <p class="mechanism-card__desc"><?php echo esc_html( $mech['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══ RESEARCH STATS ═══ -->
<section id="research" class="post-section post-section--alt">
    <div class="container">
        <h2 class="post-section__heading">KEY RESEARCH DATA</h2>
        <p class="post-section__sub">Quantitative findings from published preclinical research</p>

        <div class="stat-cards-grid">
            <?php foreach ( $p['stats'] as $stat ) : ?>
            <div class="stat-card">
                <div class="stat-card__emoji"><?php echo esc_html( $stat['emoji'] ); ?></div>
                <div class="stat-card__num"><?php echo esc_html( $stat['num'] ); ?></div>
                <div class="stat-card__label"><?php echo esc_html( $stat['label'] ); ?></div>
                <div class="stat-card__sub"><?php echo esc_html( $stat['sub'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- ── Chart ── -->
        <div class="post-chart-wrap">
            <h3 class="post-chart-title"><?php echo esc_html( $p['chart_title'] ); ?></h3>

            <?php
            $chart_type   = $p['chart_type'];
            $chart_labels = $p['chart_labels'];
            $chart_data   = $p['chart_data'];
            $chart_id     = 'chart-' . esc_attr( $slug );

            if ( $chart_type === 'bar' ) :
            ?>
            <div class="post-chart-canvas-wrap">
                <canvas id="<?php echo $chart_id; ?>" aria-label="<?php echo esc_attr( $p['chart_title'] ); ?>" role="img"></canvas>
            </div>

            <?php elseif ( $chart_type === 'hbar' ) : ?>
            <div class="hbar-chart">
                <?php
                $max = max( $chart_data ) ?: 100;
                foreach ( $chart_labels as $i => $label ) :
                    $val  = isset( $chart_data[ $i ] ) ? (int) $chart_data[ $i ] : 0;
                    $pct  = round( ( $val / $max ) * 100 );
                ?>
                <div class="hbar-row">
                    <div class="hbar-label"><?php echo esc_html( $label ); ?></div>
                    <div class="hbar-track">
                        <div class="finding-bar-fill hbar-fill" style="--bar-width: <?php echo $pct; ?>%;"></div>
                    </div>
                    <div class="hbar-value"><?php echo esc_html( $val ); ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php elseif ( $chart_type === 'donut' ) : ?>
            <div class="donut-grid">
                <?php
                $total = array_sum( $chart_data ) ?: 100;
                foreach ( $chart_labels as $i => $label ) :
                    $val  = isset( $chart_data[ $i ] ) ? (float) $chart_data[ $i ] : 0;
                    $pct  = round( ( $val / $total ) * 100 );
                    $deg  = round( $pct * 3.6 );
                ?>
                <div class="donut-item">
                    <div class="donut-ring"
                         style="background: conic-gradient(var(--teal) 0deg <?php echo $deg; ?>deg, var(--mist) <?php echo $deg; ?>deg 360deg);">
                        <div class="donut-inner">
                            <span class="donut-pct"><?php echo $pct; ?>%</span>
                        </div>
                    </div>
                    <p class="donut-label"><?php echo esc_html( $label ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <?php endif; ?>

            <p class="post-chart-note"><?php echo esc_html( $p['chart_note'] ); ?></p>
        </div>
    </div>
</section>

<!-- ═══ SAFETY ═══ -->
<section id="safety" class="post-section">
    <div class="container">
        <h2 class="post-section__heading">PRECLINICAL SAFETY PROFILE</h2>
        <p class="post-section__sub">Observed tolerability data from in vitro and animal model research</p>
        <div class="safety-rings">
            <?php foreach ( $p['safety'] as $s ) :
                $pct     = (int) $s['pct'];
                $deg     = round( $pct * 3.6 );
                $sev     = esc_attr( $s['severity'] );
                $color   = ( $sev === 'medium' ) ? 'var(--pkg-blue)' : 'var(--teal)';
            ?>
            <div class="safety-ring-wrap">
                <div class="safety-ring"
                     style="background: conic-gradient(<?php echo $color; ?> 0deg <?php echo $deg; ?>deg, var(--mist) <?php echo $deg; ?>deg 360deg);">
                    <div class="safety-ring__inner">
                        <span class="safety-ring__pct"><?php echo $pct; ?>%</span>
                    </div>
                </div>
                <p class="safety-ring__label"><?php echo esc_html( $s['label'] ); ?></p>
                <span class="safety-ring__severity safety-ring__severity--<?php echo $sev; ?>"><?php echo ucfirst( $sev ); ?> Severity</span>
            </div>
            <?php endforeach; ?>
        </div>
        <p class="safety-disclaimer">
            Safety data reflects preclinical observations only. Human clinical safety profiles may differ substantially.
            For in vitro laboratory research use only. Not for human consumption.
        </p>
    </div>
</section>

<!-- ═══ CITATIONS ═══ -->
<section id="citations" class="post-section post-section--alt">
    <div class="container">
        <h2 class="post-section__heading">RESEARCH CITATIONS</h2>
        <p class="post-section__sub">Primary literature — links open PubMed or original journal source</p>
        <div class="citations-list">
            <?php foreach ( $p['citations'] as $i => $cit ) : ?>
            <a class="citation-card"
               href="<?php echo esc_url( $cit['url'] ); ?>"
               target="_blank"
               rel="noopener noreferrer">
                <span class="citation-card__num">[<?php echo ( $i + 1 ); ?>]</span>
                <div class="citation-card__body">
                    <div class="citation-card__journal"><?php echo esc_html( $cit['journal'] ); ?> &middot; <?php echo esc_html( $cit['year'] ); ?></div>
                    <div class="citation-card__title"><?php echo esc_html( $cit['title'] ); ?></div>
                    <div class="citation-card__author"><?php echo esc_html( $cit['author'] ); ?></div>
                    <?php if ( $cit['pmid'] !== 'N/A' ) : ?>
                    <div class="citation-card__pmid">PMID: <?php echo esc_html( $cit['pmid'] ); ?></div>
                    <?php endif; ?>
                </div>
                <span class="citation-card__arrow" aria-hidden="true">&rarr;</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══ PRODUCT CTA ═══ -->
<?php if ( ! empty( $p['product_slug'] ) ) :
    $product_url  = home_url( '/product/' . $p['product_slug'] . '/' );
    $peptide_display = strtoupper( str_replace( '-', '-', $p['product_slug'] ) );
?>
<section class="post-cta">
    <div class="container">
        <div class="post-cta__inner">
            <p class="post-cta__eyebrow">Syntra Compound Library</p>
            <p class="post-cta__text">
                View <strong><?php echo esc_html( $peptide_display ); ?></strong> specifications, batch data, and Certificate of Analysis in the Syntra research compound catalogue.
            </p>
            <a class="post-cta__btn"
               href="<?php echo esc_url( $product_url ); ?>">
                View <?php echo esc_html( strtoupper( $p['product_slug'] ) ); ?> in the Syntra Compound Library &rarr;
            </a>
            <p class="post-cta__disclaimer">For in vitro laboratory research use only. Not for human consumption.</p>
        </div>
    </div>
</section>
<?php endif; ?>

<?php else : // No blog data — render WP post content fallback ?>

<article class="post-fallback">
    <div class="container">
        <h1 class="post-fallback__title"><?php the_title(); ?></h1>
        <div class="post-fallback__content">
            <?php the_content(); ?>
        </div>
        <p class="post-fallback__disclaimer">For in vitro laboratory research use only. Not for human consumption.</p>
    </div>
</article>

<?php endif; ?>

<!-- ═══ BACK TO LIBRARY ═══ -->
<div class="post-back-link">
    <div class="container">
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="post-back-link__a">
            &larr; Back to Peptide Research Library
        </a>
    </div>
</div>

<?php
/* ── Chart.js initialisation (bar charts only) ── */
if ( $has_data && $p['chart_type'] === 'bar' ) :
    $chart_id     = 'chart-' . $slug;
    $labels_json  = json_encode( $p['chart_labels'] );
    $data_json    = json_encode( $p['chart_data'] );
    $chart_title  = esc_js( $p['chart_title'] );
?>
<script>
window.addEventListener('load', function() {
    var ctx = document.getElementById(<?php echo json_encode( $chart_id ); ?>);
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo $labels_json; ?>,
            datasets: [{
                label: <?php echo json_encode( $p['chart_title'] ); ?>,
                data: <?php echo $data_json; ?>,
                backgroundColor: 'rgba(47, 183, 179, 0.25)',
                borderColor: '#2FB7B3',
                borderWidth: 2,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1F3552',
                    titleFont: { family: "'IBM Plex Mono', monospace", size: 11 },
                    bodyFont:  { family: "'IBM Plex Mono', monospace", size: 11 }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(150,174,200,0.15)' },
                    ticks: { font: { family: "'IBM Plex Mono', monospace", size: 10 }, color: '#4E5F71' }
                },
                y: {
                    grid: { color: 'rgba(150,174,200,0.15)' },
                    ticks: { font: { family: "'IBM Plex Mono', monospace", size: 10 }, color: '#4E5F71' }
                }
            }
        }
    });
});
</script>
<?php endif; ?>

<?php get_footer(); ?>
