<?php get_header(); ?>
<div class="container" style="padding-top:64px; padding-bottom:80px;">
  <?php while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <div style="margin-top:32px;"><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
