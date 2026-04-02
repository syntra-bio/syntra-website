<?php
/*
 * Template Name: Locked Policy Page
 * No navigation. No links to products.
 * Used for T&C, Refund Policy, Shipping Policy when accessed from the GHK-Cu compliance page.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?> Syntra Global Pty Ltd</title>
  <link rel="icon" type="image/jpeg" href="<?php echo esc_url( get_template_directory_uri() ); ?>/SYNTRA favicon .jpg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #1F3552; --teal: #2FB7B3; --pkg-blue: #97AEC8;
      --slate: #4E5F71; --mist: #E6EBF0; --off-white: #F7F8FA; --white: #fff;
      --font-sans: 'Inter', sans-serif;
    }
    body { font-family: var(--font-sans); background: var(--off-white); color: var(--navy); font-size: 15px; line-height: 1.6; }
    a { color: var(--teal); text-decoration: underline; }

    /* Header — logo only, no nav */
    .lp-header { background: var(--white); border-bottom: 1px solid var(--mist); padding: 0 24px; }
    .lp-header__inner { max-width: 860px; margin: 0 auto; height: 64px; display: flex; align-items: center; justify-content: space-between; }
    .lp-logo { font-family: var(--font-sans); font-size: 18px; font-weight: 600; letter-spacing: 0.12em; color: var(--navy); text-transform: uppercase; }
    .lp-header__abn { font-family: monospace; font-size: 11px; color: var(--slate); letter-spacing: 0.04em; }

    /* Content */
    .lp-content { max-width: 860px; margin: 0 auto; padding: 48px 24px 80px; }
    .lp-content h1 { font-size: 28px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: var(--navy); margin-bottom: 8px; }
    .lp-content h2 { font-size: 18px; font-weight: 600; color: var(--navy); margin: 32px 0 12px; }
    .lp-content h3 { font-size: 15px; font-weight: 600; color: var(--navy); margin: 24px 0 8px; }
    .lp-content p { color: var(--slate); font-size: 14px; line-height: 1.8; margin-bottom: 16px; }
    .lp-content ul, .lp-content ol { color: var(--slate); font-size: 14px; line-height: 1.8; margin-bottom: 16px; padding-left: 24px; }
    .lp-content li { margin-bottom: 6px; }
    .lp-content table { width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 13px; }
    .lp-content td, .lp-content th { padding: 10px 14px; border: 1px solid var(--mist); color: var(--slate); text-align: left; }
    .lp-content th { background: var(--off-white); font-weight: 600; color: var(--navy); }
    .lp-meta { background: var(--white); border: 1px solid var(--mist); border-left: 3px solid var(--teal); border-radius: 0 8px 8px 0; padding: 14px 18px; margin-bottom: 32px; }
    .lp-meta p { margin: 0; font-size: 13px; color: var(--slate); }
    .lp-meta strong { color: var(--navy); }

    /* Footer — legal info only */
    .lp-footer { background: var(--navy); padding: 32px 24px; }
    .lp-footer__inner { max-width: 860px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between; }
    .lp-footer__text { font-size: 12px; color: var(--pkg-blue); line-height: 1.7; }
    .lp-footer__abn { font-family: monospace; font-size: 11px; color: var(--pkg-blue); letter-spacing: 0.04em; }
    .lp-footer__au { font-size: 11px; color: var(--pkg-blue); }
  </style>
</head>
<body>

<!-- HEADER — logo + ABN only, no navigation -->
<header class="lp-header">
  <div class="lp-header__inner">
    <div class="lp-logo">SYNTRA</div>
    <div class="lp-header__abn">ABN 22 694 777 494</div>
  </div>
</header>

<!-- PAGE CONTENT -->
<div class="lp-content">
  <div class="lp-meta">
    <p><strong>Syntra Global Pty Ltd</strong> · ABN 22 694 777 494 · 442 The Esplanade, Palm Beach QLD 4221, Australia · support@syntra.bio</p>
  </div>
  <?php while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <div style="margin-top: 32px;">
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>
</div>

<!-- FOOTER — legal only -->
<footer class="lp-footer">
  <div class="lp-footer__inner">
    <div class="lp-footer__text">
      © <?php echo date('Y'); ?> Syntra Global Pty Ltd · ABN 22 694 777 494<br>
      442 The Esplanade, Palm Beach QLD 4221, Australia · support@syntra.bio
    </div>
    <div class="lp-footer__abn">Governed by Queensland law, Australia</div>
    <div class="lp-footer__au">🇦🇺 Australian Company · Prices in AUD</div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
