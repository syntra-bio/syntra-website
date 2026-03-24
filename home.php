<?php
/**
 * Archive — Blog landing page (Peptide Research Library)
 *
 * @package Syntra
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<!-- ═══ BLOG HERO ═══ -->
<section class="blog-hero">
    <div class="container">
        <p class="blog-hero__eyebrow">In Vitro Research Library</p>
        <h1 class="blog-hero__title">PEPTIDE RESEARCH LIBRARY</h1>
        <p class="blog-hero__sub">
            Peer-reviewed mechanisms, preclinical data, and research citations for 20 scientifically studied peptide compounds.
            All content reflects in vitro and animal model findings only.
        </p>
        <p class="blog-hero__disclaimer">
            For in vitro laboratory research use only. Not for human consumption.
        </p>
    </div>
</section>

<!-- ═══ CATEGORY FILTERS ═══ -->
<section class="blog-filters-wrap">
    <div class="container">
        <div class="blog-filters">
            <button class="blog-filter-btn active" data-cat="all">All</button>
            <button class="blog-filter-btn" data-cat="recovery">Recovery</button>
            <button class="blog-filter-btn" data-cat="longevity">Longevity</button>
            <button class="blog-filter-btn" data-cat="hormone">Hormone</button>
            <button class="blog-filter-btn" data-cat="nootropic">Nootropic</button>
            <button class="blog-filter-btn" data-cat="metabolic">Metabolic</button>
            <button class="blog-filter-btn" data-cat="immune">Immune</button>
            <button class="blog-filter-btn" data-cat="sexual-health">Sexual Health</button>
        </div>
    </div>
</section>

<!-- ═══ BLOG GRID ═══ -->
<section class="blog-grid-section">
    <div class="container">
        <?php
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ];
        $q = new WP_Query( $args );

        if ( $q->have_posts() ) :
        ?>
        <div class="blog-grid">
            <?php while ( $q->have_posts() ) : $q->the_post();
                $slug = get_post_field( 'post_name', get_the_ID() );
                $p    = syntra_get_blog_data( $slug );

                // If no matching data, fall back gracefully
                $gradient  = $p ? esc_attr( $p['gradient'] )    : 'linear-gradient(135deg, #1F3552 0%, #2FB7B3 100%)';
                $cat_label = $p ? esc_html( $p['category'] )    : '';
                $cat_slug  = $p ? esc_attr( $p['cat_slug'] )    : '';
                $hero_stat = $p ? esc_html( $p['hero_stat'] )   : '';
                $hero_lbl  = $p ? esc_html( $p['hero_label'] )  : '';
                $intro     = $p ? esc_html( $p['intro'] )        : '';
                $excerpt   = mb_substr( $intro, 0, 120 );
                if ( mb_strlen( $intro ) > 120 ) $excerpt .= '…';

                $peptide_name = strtoupper( str_replace( '-', ' ', $slug ) );
            ?>
            <a class="blog-card"
               href="<?php the_permalink(); ?>"
               data-cat="<?php echo $cat_slug; ?>"
               aria-label="<?php echo esc_attr( get_the_title() ); ?>">

                <div class="blog-card__visual" style="background: <?php echo $gradient; ?>;">
                    <span class="blog-card__peptide-name"><?php echo esc_html( $peptide_name ); ?></span>
                </div>

                <div class="blog-card__body">
                    <?php if ( $cat_label ) : ?>
                    <span class="blog-card__cat"><?php echo $cat_label; ?></span>
                    <?php endif; ?>

                    <?php if ( $hero_stat ) : ?>
                    <div class="blog-card__stat"><?php echo $hero_stat; ?></div>
                    <div class="blog-card__stat-label"><?php echo $hero_lbl; ?></div>
                    <?php endif; ?>

                    <h2 class="blog-card__title"><?php the_title(); ?></h2>

                    <?php if ( $excerpt ) : ?>
                    <p class="blog-card__excerpt"><?php echo $excerpt; ?></p>
                    <?php endif; ?>

                    <span class="blog-card__cta" aria-hidden="true">Read Research &rarr;</span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div><!-- .blog-grid -->

        <?php else : ?>
        <div class="blog-empty">
            <p>No research articles published yet. Check back soon.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ═══ COMPLIANCE FOOTER NOTE ═══ -->
<section class="blog-compliance">
    <div class="container">
        <p class="blog-compliance__text">
            All content on this page describes in vitro laboratory research observations and preclinical findings only.
            Nothing herein constitutes medical advice, dosing guidance, or therapeutic recommendations.
            For in vitro laboratory research use only. Not for human consumption.
        </p>
    </div>
</section>

<?php get_footer(); ?>
