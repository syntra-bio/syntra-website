<?php
/*
 * Template Name: Topical GHK-Cu Landing Page
 * Standalone compliance page — no navigation to other products.
 * Only active links: Terms & Conditions, Refund Policy, Shipping Policy.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GHK-Cu Topical Copper Peptide | Syntra Global Pty Ltd</title>
  <meta name="description" content="Cosmetic-grade GHK-Cu (Copper Peptide) for topical formulation research. HPLC verified, 99%+ purity. Syntra Global Pty Ltd — ABN 22 694 777 494.">
  <meta name="robots" content="noindex, nofollow">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #1F3552; --teal: #2FB7B3; --pkg-blue: #97AEC8;
      --slate: #4E5F71; --mist: #E6EBF0; --off-white: #F7F8FA; --white: #fff;
      --font-sans: 'Inter', sans-serif; --font-mono: 'IBM Plex Mono', monospace;
    }
    html { scroll-behavior: smooth; }
    body { font-family: var(--font-sans); background: var(--off-white); color: var(--navy); font-size: 15px; line-height: 1.6; overflow-x: hidden; }
    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }
    .tg-container { max-width: 1100px; margin: 0 auto; padding: 0 24px; }

    /* ── Header ── */
    .tg-header { background: var(--white); border-bottom: 1px solid var(--mist); padding: 0; position: sticky; top: 0; z-index: 100; }
    .tg-header__inner { display: flex; align-items: center; justify-content: space-between; height: 64px; }
    .tg-logo { font-family: var(--font-sans); font-size: 20px; font-weight: 600; letter-spacing: 0.12em; color: var(--navy); text-transform: uppercase; }
    .tg-header__links { display: flex; gap: 24px; }
    .tg-header__link { font-size: 12px; font-weight: 500; color: var(--slate); letter-spacing: 0.04em; transition: color 0.2s; }
    .tg-header__link:hover { color: var(--navy); }

    /* ── Hero ── */
    .tg-hero { background: var(--navy); padding: 72px 0; }
    .tg-hero__inner { display: grid; grid-template-columns: 1fr; gap: 40px; }
    @media (min-width: 768px) { .tg-hero__inner { grid-template-columns: 1fr 1fr; align-items: center; } }
    .tg-hero__label { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.14em; text-transform: uppercase; color: var(--teal); margin-bottom: 16px; }
    .tg-hero__title { font-size: clamp(32px, 5vw, 52px); font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: var(--white); line-height: 1.1; margin-bottom: 16px; }
    .tg-hero__title span { color: var(--teal); }
    .tg-hero__sub { font-size: 15px; color: var(--pkg-blue); line-height: 1.7; margin-bottom: 32px; max-width: 480px; }
    .tg-hero__stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    @media (min-width: 480px) { .tg-hero__stats { grid-template-columns: repeat(4, 1fr); } }
    .tg-stat { background: rgba(255,255,255,0.04); border: 1px solid rgba(151,174,200,0.15); border-radius: 10px; padding: 16px; }
    .tg-stat__label { font-family: var(--font-mono); font-size: 9px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--pkg-blue); margin-bottom: 6px; }
    .tg-stat__value { font-family: var(--font-mono); font-size: 16px; font-weight: 500; color: var(--teal); }
    .tg-hero__badge { background: rgba(47,183,179,0.08); border: 1px solid rgba(47,183,179,0.25); border-radius: 100px; display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; margin-bottom: 24px; }
    .tg-hero__badge span { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--teal); }

    /* ── Product section ── */
    .tg-product { background: var(--white); padding: 72px 0; }
    .tg-product__inner { display: grid; grid-template-columns: 1fr; gap: 48px; }
    @media (min-width: 768px) { .tg-product__inner { grid-template-columns: 1fr 1fr; align-items: start; } }
    .tg-product__img { background: var(--off-white); border: 1px solid var(--mist); border-radius: 14px; aspect-ratio: 1; display: flex; align-items: center; justify-content: center; }
    .tg-product__img svg { opacity: 0.15; }
    .tg-section-label { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.14em; text-transform: uppercase; color: var(--teal); margin-bottom: 12px; }
    .tg-product__name { font-size: 28px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: var(--navy); margin-bottom: 8px; }
    .tg-product__desc { color: var(--slate); font-size: 14px; line-height: 1.7; margin-bottom: 24px; }
    .tg-specs { border: 1px solid var(--mist); border-radius: 10px; overflow: hidden; margin-bottom: 24px; }
    .tg-spec-row { display: flex; border-bottom: 1px solid var(--mist); }
    .tg-spec-row:last-child { border-bottom: none; }
    .tg-spec-label { font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.08em; text-transform: uppercase; color: var(--slate); padding: 12px 16px; background: var(--off-white); min-width: 140px; border-right: 1px solid var(--mist); }
    .tg-spec-value { font-family: var(--font-mono); font-size: 12px; color: var(--navy); padding: 12px 16px; font-weight: 500; }
    .tg-product__compliance { background: var(--off-white); border: 1px solid var(--mist); border-left: 3px solid var(--teal); border-radius: 0 8px 8px 0; padding: 14px 16px; font-size: 12px; color: var(--slate); line-height: 1.6; }

    /* ── Variants / pricing ── */
    .tg-variants { padding: 48px 0; background: var(--off-white); }
    .tg-variants__grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; margin-top: 32px; }
    .tg-variant-card { background: var(--white); border: 1px solid var(--mist); border-radius: 12px; padding: 24px; transition: border-color 0.2s, box-shadow 0.2s; }
    .tg-variant-card:hover { border-color: var(--teal); box-shadow: 0 4px 16px rgba(47,183,179,0.1); }
    .tg-variant-card__size { font-family: var(--font-mono); font-size: 18px; font-weight: 500; color: var(--navy); margin-bottom: 4px; }
    .tg-variant-card__label { font-family: var(--font-mono); font-size: 9px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--pkg-blue); margin-bottom: 16px; }
    .tg-variant-card__price { font-size: 22px; font-weight: 600; color: var(--navy); margin-bottom: 4px; }
    .tg-variant-card__purity { font-family: var(--font-mono); font-size: 10px; color: var(--teal); letter-spacing: 0.08em; }

    /* ── COA / verification ── */
    .tg-verification { background: var(--navy); padding: 72px 0; }
    .tg-verification h2 { font-size: 28px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: var(--white); margin-bottom: 12px; }
    .tg-verification__sub { color: var(--pkg-blue); font-size: 14px; margin-bottom: 40px; max-width: 560px; }
    .tg-pillars { display: grid; grid-template-columns: 1fr; gap: 16px; }
    @media (min-width: 768px) { .tg-pillars { grid-template-columns: repeat(3, 1fr); } }
    .tg-pillar { background: rgba(255,255,255,0.04); border: 1px solid rgba(151,174,200,0.15); border-top: 3px solid var(--teal); border-radius: 10px; padding: 28px; }
    .tg-pillar__num { font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.12em; color: var(--teal); margin-bottom: 12px; }
    .tg-pillar__title { font-size: 15px; font-weight: 500; color: var(--white); margin-bottom: 8px; }
    .tg-pillar__text { font-size: 13px; color: var(--pkg-blue); line-height: 1.6; }

    /* ── Contact / order ── */
    .tg-order { background: var(--white); padding: 72px 0; }
    .tg-order__inner { display: grid; grid-template-columns: 1fr; gap: 40px; }
    @media (min-width: 768px) { .tg-order__inner { grid-template-columns: 1fr 1fr; } }
    .tg-order h2 { font-size: 28px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: var(--navy); margin-bottom: 12px; }
    .tg-order__sub { color: var(--slate); font-size: 14px; line-height: 1.7; margin-bottom: 24px; }
    .tg-contact-block { background: var(--off-white); border: 1px solid var(--mist); border-radius: 12px; padding: 28px; }
    .tg-contact-block__label { font-family: var(--font-mono); font-size: 9px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--pkg-blue); margin-bottom: 8px; }
    .tg-contact-block__value { font-size: 16px; color: var(--navy); font-weight: 500; }
    .tg-contact-block + .tg-contact-block { margin-top: 12px; }
    .tg-btn { display: inline-block; background: var(--teal); color: var(--white); font-family: var(--font-sans); font-size: 13px; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; padding: 14px 28px; border-radius: 6px; margin-top: 24px; transition: opacity 0.2s; }
    .tg-btn:hover { opacity: 0.88; }

    /* ── Footer ── */
    .tg-footer { background: var(--navy); padding: 48px 0 32px; }
    .tg-footer__inner { display: grid; grid-template-columns: 1fr; gap: 32px; margin-bottom: 32px; }
    @media (min-width: 768px) { .tg-footer__inner { grid-template-columns: 2fr 1fr 1fr; } }
    .tg-footer__logo { font-family: var(--font-sans); font-size: 18px; font-weight: 600; letter-spacing: 0.12em; color: var(--white); text-transform: uppercase; margin-bottom: 12px; }
    .tg-footer__address { font-size: 12px; color: var(--pkg-blue); line-height: 1.8; }
    .tg-footer__col-title { font-family: var(--font-mono); font-size: 9px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--teal); margin-bottom: 16px; }
    .tg-footer__link { display: block; font-size: 13px; color: var(--pkg-blue); margin-bottom: 8px; transition: color 0.2s; }
    .tg-footer__link:hover { color: var(--white); }
    .tg-footer__bottom { border-top: 1px solid rgba(151,174,200,0.15); padding-top: 24px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between; }
    .tg-footer__copy { font-size: 11px; color: var(--pkg-blue); }
    .tg-footer__abn { font-family: var(--font-mono); font-size: 10px; color: var(--pkg-blue); letter-spacing: 0.06em; }
    .tg-footer__au { font-size: 11px; color: var(--pkg-blue); }

    /* ── Trust bar ── */
    .tg-trust { background: var(--off-white); border-top: 1px solid var(--mist); border-bottom: 1px solid var(--mist); padding: 24px 0; }
    .tg-trust__inner { display: flex; flex-wrap: wrap; gap: 24px; align-items: center; justify-content: center; }
    .tg-trust__item { display: flex; align-items: center; gap: 8px; font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.08em; text-transform: uppercase; color: var(--slate); }
    .tg-trust__dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal); flex-shrink: 0; }
  </style>
</head>
<body>

<!-- HEADER -->
<header class="tg-header">
  <div class="tg-container">
    <div class="tg-header__inner">
      <div class="tg-logo">SYNTRA</div>
      <nav class="tg-header__links">
        <a href="<?php echo esc_url( home_url( '/locked-terms/' ) ); ?>" class="tg-header__link" target="_blank" rel="noopener">Terms &amp; Conditions</a>
        <a href="<?php echo esc_url( home_url( '/locked-refund/' ) ); ?>" class="tg-header__link" target="_blank" rel="noopener">Refund Policy</a>
        <a href="<?php echo esc_url( home_url( '/locked-shipping/' ) ); ?>" class="tg-header__link" target="_blank" rel="noopener">Shipping Policy</a>
      </nav>
    </div>
  </div>
</header>

<!-- HERO -->
<section class="tg-hero">
  <div class="tg-container">
    <div class="tg-hero__inner">
      <div>
        <div class="tg-hero__label">Topical Copper Peptide — Cosmetic Grade</div>
        <h1 class="tg-hero__title">GHK-Cu<br><span>Copper</span><br>Peptide</h1>
        <p class="tg-hero__sub">HPLC-verified GHK-Cu for topical formulation research and in vitro dermal studies. Every batch independently tested to 99%+ purity.</p>
        <div class="tg-hero__badge">
          <div class="tg-trust__dot"></div>
          <span>99%+ Purity · HPLC + Mass Spectrometry Verified</span>
        </div>
        <div class="tg-hero__stats">
          <div class="tg-stat">
            <div class="tg-stat__label">Purity</div>
            <div class="tg-stat__value">99%+</div>
          </div>
          <div class="tg-stat">
            <div class="tg-stat__label">Validation</div>
            <div class="tg-stat__value">HPLC+MS</div>
          </div>
          <div class="tg-stat">
            <div class="tg-stat__label">Storage</div>
            <div class="tg-stat__value">−20°C</div>
          </div>
          <div class="tg-stat">
            <div class="tg-stat__label">Form</div>
            <div class="tg-stat__value">Lyophil.</div>
          </div>
        </div>
      </div>
      <div class="tg-product__img" style="max-width:420px; margin-left:auto;">
        <svg width="120" height="120" viewBox="0 0 80 80" fill="none">
          <rect x="30" y="8" width="20" height="35" rx="3" fill="#1F3552"/>
          <rect x="20" y="43" width="40" height="30" rx="3" fill="#1F3552"/>
          <line x1="30" y1="20" x2="50" y2="20" stroke="#2FB7B3" stroke-width="2"/>
          <line x1="30" y1="28" x2="50" y2="28" stroke="#97AEC8" stroke-width="1.5"/>
          <circle cx="40" cy="60" r="8" fill="none" stroke="#2FB7B3" stroke-width="1.5"/>
        </svg>
      </div>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<div class="tg-trust">
  <div class="tg-container">
    <div class="tg-trust__inner">
      <div class="tg-trust__item"><div class="tg-trust__dot"></div> Third-Party Tested</div>
      <div class="tg-trust__item"><div class="tg-trust__dot"></div> HPLC Verified Purity</div>
      <div class="tg-trust__item"><div class="tg-trust__dot"></div> Mass Spectrometry Confirmed</div>
      <div class="tg-trust__item"><div class="tg-trust__dot"></div> Batch COA Available</div>
      <div class="tg-trust__item"><div class="tg-trust__dot"></div> Australian Business</div>
    </div>
  </div>
</div>

<!-- PRODUCT DETAIL -->
<section class="tg-product">
  <div class="tg-container">
    <div class="tg-product__inner">
      <div>
        <div class="tg-section-label">Product Specifications</div>
        <div class="tg-product__name">GHK-Cu<br>Copper Peptide</div>
        <p class="tg-product__desc">GHK-Cu (Glycyl-L-histidyl-L-lysine copper complex) is a naturally occurring copper peptide with widespread application in cosmetic formulation research and in vitro dermal studies. Supplied as a lyophilised powder, independently verified for identity and purity by accredited third-party laboratory.</p>
        <div class="tg-specs">
          <div class="tg-spec-row">
            <div class="tg-spec-label">CAS Number</div>
            <div class="tg-spec-value">89030-95-5</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Molecular Formula</div>
            <div class="tg-spec-value">C₁₄H₂₃CuN₆O₄</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Molecular Weight</div>
            <div class="tg-spec-value">403.9 g/mol</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Purity</div>
            <div class="tg-spec-value">≥99% (HPLC)</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Appearance</div>
            <div class="tg-spec-value">Blue lyophilised powder</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Solubility</div>
            <div class="tg-spec-value">Water (soluble)</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Storage</div>
            <div class="tg-spec-value">−20°C, desiccated, away from light</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Validation</div>
            <div class="tg-spec-value">HPLC + Mass Spectrometry</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">COA</div>
            <div class="tg-spec-value">Available per batch on request</div>
          </div>
          <div class="tg-spec-row">
            <div class="tg-spec-label">Origin</div>
            <div class="tg-spec-value">Sold by Syntra Global Pty Ltd · ABN 22 694 777 494</div>
          </div>
        </div>
        <div class="tg-product__compliance">
          For cosmetic formulation research and in vitro dermal studies only. Not for human therapeutic use, internal consumption, or diagnostic purposes.
        </div>
      </div>
      <div style="display:flex; flex-direction:column; gap:16px;">
        <div class="tg-product__img">
          <svg width="120" height="120" viewBox="0 0 80 80" fill="none">
            <rect x="30" y="8" width="20" height="35" rx="3" fill="#1F3552"/>
            <rect x="20" y="43" width="40" height="30" rx="3" fill="#1F3552"/>
            <line x1="30" y1="20" x2="50" y2="20" stroke="#2FB7B3" stroke-width="2"/>
            <line x1="30" y1="28" x2="50" y2="28" stroke="#97AEC8" stroke-width="1.5"/>
            <circle cx="40" cy="60" r="8" fill="none" stroke="#2FB7B3" stroke-width="1.5"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- VARIANTS / PRICING -->
<section class="tg-variants">
  <div class="tg-container">
    <div class="tg-section-label">Available Sizes</div>
    <h2 style="font-size:24px; font-weight:600; letter-spacing:0.04em; text-transform:uppercase; color:var(--navy); margin-bottom:8px;">Select Your Quantity</h2>
    <p style="color:var(--slate); font-size:14px; margin-bottom:0;">All sizes supplied as lyophilised powder. Prices in AUD (GST inclusive where applicable).</p>
    <div class="tg-variants__grid">
      <?php
      // Pull live pricing from WooCommerce if available
      $ghkcu = null;
      if ( class_exists('WooCommerce') ) {
          $products = wc_get_products(['status' => 'publish', 'limit' => -1]);
          foreach ($products as $p) {
              if (strpos(strtolower($p->get_slug()), 'ghk') !== false) {
                  $ghkcu = $p; break;
              }
          }
      }
      $variants = $ghkcu ? syntra_get_variants($ghkcu->get_id()) : [];
      if (!empty($variants)) :
          foreach ($variants as $v) :
              $label = ($v['label'] ?? '') . ($v['unit'] ?? '');
              $price = $v['price'] ?? 0;
              if (!$label || !$price) continue;
      ?>
      <div class="tg-variant-card">
        <div class="tg-variant-card__size"><?php echo esc_html($label); ?></div>
        <div class="tg-variant-card__label">GHK-Cu · Lyophilised</div>
        <div class="tg-variant-card__price">$<?php echo number_format((float)$price, 2); ?> AUD</div>
        <div class="tg-variant-card__purity">99%+ HPLC Verified</div>
      </div>
      <?php endforeach; else : ?>
      <div class="tg-variant-card">
        <div class="tg-variant-card__size">50mg</div>
        <div class="tg-variant-card__label">GHK-Cu · Lyophilised</div>
        <div class="tg-variant-card__price">Contact for pricing</div>
        <div class="tg-variant-card__purity">99%+ HPLC Verified</div>
      </div>
      <div class="tg-variant-card">
        <div class="tg-variant-card__size">100mg</div>
        <div class="tg-variant-card__label">GHK-Cu · Lyophilised</div>
        <div class="tg-variant-card__price">Contact for pricing</div>
        <div class="tg-variant-card__purity">99%+ HPLC Verified</div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- VERIFICATION -->
<section class="tg-verification">
  <div class="tg-container">
    <div class="tg-section-label" style="color:var(--teal);">Laboratory Verification</div>
    <h2>BATCH VERIFICATION &amp; COA</h2>
    <p class="tg-verification__sub">Every batch of GHK-Cu is independently tested by an accredited third-party laboratory. Certificate of Analysis available for every order.</p>
    <div class="tg-pillars">
      <div class="tg-pillar">
        <div class="tg-pillar__num">01 / HPLC</div>
        <div class="tg-pillar__title">High-Performance Liquid Chromatography</div>
        <p class="tg-pillar__text">Every batch analysed by HPLC to confirm purity percentage, identify impurities, and validate compound identity against reference standards.</p>
      </div>
      <div class="tg-pillar">
        <div class="tg-pillar__num">02 / MS</div>
        <div class="tg-pillar__title">Mass Spectrometry Confirmation</div>
        <p class="tg-pillar__text">Molecular weight confirmation via mass spectrometry provides secondary verification of compound identity and structural integrity.</p>
      </div>
      <div class="tg-pillar">
        <div class="tg-pillar__num">03 / COA</div>
        <div class="tg-pillar__title">Certificate of Analysis Per Batch</div>
        <p class="tg-pillar__text">Independent third-party laboratory reports available for every batch. Batch numbers traceable from order confirmation through to delivery.</p>
      </div>
    </div>
  </div>
</section>

<!-- ORDER / CONTACT -->
<section class="tg-order">
  <div class="tg-container">
    <div class="tg-order__inner">
      <div>
        <div class="tg-section-label">Place an Order</div>
        <h2>HOW TO ORDER</h2>
        <p class="tg-order__sub">Orders are processed via our secure checkout. We accept bank transfer (BSB/Account) and credit card payments. All prices are in Australian Dollars (AUD).</p>
        <p class="tg-order__sub">Same-day dispatch for orders placed before 2:00 PM AEST Monday–Friday. Orders are shipped via Australia Post Express Post.</p>
        <a href="mailto:support@syntra.bio" class="tg-btn">Contact Us to Order →</a>
      </div>
      <div>
        <div class="tg-section-label">Business Details</div>
        <div class="tg-contact-block">
          <div class="tg-contact-block__label">Legal Entity</div>
          <div class="tg-contact-block__value">Syntra Global Pty Ltd</div>
        </div>
        <div class="tg-contact-block">
          <div class="tg-contact-block__label">ABN</div>
          <div class="tg-contact-block__value">22 694 777 494</div>
        </div>
        <div class="tg-contact-block">
          <div class="tg-contact-block__label">Trading Address</div>
          <div class="tg-contact-block__value">442 The Esplanade, Palm Beach QLD 4221, Australia</div>
        </div>
        <div class="tg-contact-block">
          <div class="tg-contact-block__label">Email</div>
          <div class="tg-contact-block__value">support@syntra.bio</div>
        </div>
        <div class="tg-contact-block">
          <div class="tg-contact-block__label">Currency</div>
          <div class="tg-contact-block__value">Australian Dollar (AUD)</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="tg-footer">
  <div class="tg-container">
    <div class="tg-footer__inner">
      <div>
        <div class="tg-footer__logo">SYNTRA</div>
        <div class="tg-footer__address">
          Syntra Global Pty Ltd<br>
          ABN 22 694 777 494<br>
          442 The Esplanade, Palm Beach QLD 4221<br>
          Australia<br>
          support@syntra.bio
        </div>
      </div>
      <div>
        <div class="tg-footer__col-title">Legal</div>
        <a href="<?php echo esc_url( home_url( '/locked-terms/' ) ); ?>" class="tg-footer__link" target="_blank" rel="noopener">Terms &amp; Conditions</a>
        <a href="<?php echo esc_url( home_url( '/locked-refund/' ) ); ?>" class="tg-footer__link" target="_blank" rel="noopener">Refund Policy</a>
        <a href="<?php echo esc_url( home_url( '/locked-shipping/' ) ); ?>" class="tg-footer__link" target="_blank" rel="noopener">Shipping Policy</a>
      </div>
      <div>
        <div class="tg-footer__col-title">Compliance</div>
        <div class="tg-footer__address" style="font-size:11px; line-height:1.8;">
          For cosmetic formulation research and in vitro dermal studies only.<br><br>
          Not for human therapeutic use or internal consumption.<br><br>
          Governed by Queensland law, Australia.
        </div>
      </div>
    </div>
    <div class="tg-footer__bottom">
      <div class="tg-footer__copy">© <?php echo date('Y'); ?> Syntra Global Pty Ltd. All rights reserved.</div>
      <div class="tg-footer__abn">ABN 22 694 777 494</div>
      <div class="tg-footer__au">🇦🇺 Australian Company · Prices in AUD</div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
