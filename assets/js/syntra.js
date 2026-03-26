/* Syntra — Main JS */
(function () {
  'use strict';

  /* ── Mobile nav hamburger ── */
  var menuBtn     = document.getElementById('mobileMenuBtn');
  var mobileNav   = document.getElementById('mobileNav');
  var navOverlay  = document.getElementById('mobileNavOverlay');

  function openMobileNav() {
    mobileNav.classList.add('is-open');
    navOverlay.classList.add('is-active');
    menuBtn.setAttribute('aria-expanded', 'true');
    mobileNav.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    menuBtn.querySelector('.hamburger__icon--open').style.display  = 'none';
    menuBtn.querySelector('.hamburger__icon--close').style.display = '';
  }

  function closeMobileNav() {
    mobileNav.classList.remove('is-open');
    navOverlay.classList.remove('is-active');
    menuBtn.setAttribute('aria-expanded', 'false');
    mobileNav.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    menuBtn.querySelector('.hamburger__icon--open').style.display  = '';
    menuBtn.querySelector('.hamburger__icon--close').style.display = 'none';
  }

  if (menuBtn && mobileNav) {
    menuBtn.addEventListener('click', function () {
      mobileNav.classList.contains('is-open') ? closeMobileNav() : openMobileNav();
    });
    if (navOverlay) { navOverlay.addEventListener('click', closeMobileNav); }
    mobileNav.querySelectorAll('.mobile-nav__link').forEach(function (link) {
      link.addEventListener('click', closeMobileNav);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { closeMobileNav(); }
    });
  }

  /* ── Header scroll shadow ── */
  var header = document.getElementById('siteHeader');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('is-scrolled', window.scrollY > 10);
    }, { passive: true });
  }

  /* ── Product sub-nav active state on scroll ── */
  var subNavLinks = document.querySelectorAll('.product-subnav__link');
  if (subNavLinks.length) {
    var sections = Array.from(subNavLinks).map(function (link) {
      var id = link.getAttribute('href').replace('#', '');
      return document.getElementById(id);
    }).filter(Boolean);

    window.addEventListener('scroll', function () {
      var scrollY = window.scrollY + 120;
      sections.forEach(function (section, i) {
        if (section.offsetTop <= scrollY && (section.offsetTop + section.offsetHeight) > scrollY) {
          subNavLinks.forEach(function (l) { l.classList.remove('active'); });
          if (subNavLinks[i]) subNavLinks[i].classList.add('active');
        }
      });
    }, { passive: true });
  }

  /* ── Mobile sticky CTA visibility ── */
  var cta  = document.getElementById('mobileSticyCta');
  var hero = document.getElementById('purchase');
  if (cta && hero) {
    var observer = new IntersectionObserver(function (entries) {
      cta.classList.toggle('is-visible', !entries[0].isIntersecting);
    }, { threshold: 0 });
    observer.observe(hero);
  }

  /* ── Qty buttons (product page) ── */
  document.addEventListener('click', function (e) {
    var btn = e.target.closest('.qty-btn');
    if (!btn) return;
    var wrap  = btn.closest('.product-info__qty');
    var input = wrap && wrap.querySelector('.qty-input');
    var display = wrap && wrap.querySelector('.qty-value');
    if (!display) return;
    var current = parseInt(display.textContent, 10) || 1;
    var next = btn.dataset.action === 'minus' ? Math.max(1, current - 1) : current + 1;
    display.textContent = next;
    if (input) { input.value = next; }
  });

  /* ── Bundle options (variant-aware) ── */
  (function () {
    var _variantPrice = null; // updated by variant pill handler

    // Read initial variant price if pills exist
    var activePill = document.querySelector('.variant-pill--active');
    if (activePill && window.syntraVariants) {
      var initIdx = parseInt(activePill.dataset.index, 10);
      var initV   = window.syntraVariants[initIdx];
      if (initV) _variantPrice = initV.price;
    }

    function bundleTotal(variantPrice, qty, discPct) {
      return variantPrice * qty * (1 - discPct / 100);
    }

    function setPriceDisplay(total) {
      var priceEl  = document.querySelector('.js-bundle-price');
      var atcPrice = document.querySelector('.js-atc-price');
      if (priceEl)  priceEl.innerHTML = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>' + total.toFixed(2) + '</bdi></span>';
      if (atcPrice) atcPrice.textContent = '$' + total.toFixed(2);
    }

    function recalcAllBundleCards(variantPrice) {
      document.querySelectorAll('.bundle-option').forEach(function (opt) {
        var qty    = parseInt(opt.dataset.qty, 10)      || 1;
        var disc   = parseInt(opt.dataset.discount, 10) || 0;
        var total  = bundleTotal(variantPrice, qty, disc);
        var perV   = total / qty;

        var priceEl = opt.querySelector('.bundle-option__price');
        var perEl   = opt.querySelector('.bundle-option__per');
        var saveEl  = opt.querySelector('.bundle-option__save');

        if (priceEl) priceEl.textContent = '$' + total.toFixed(2);
        if (perEl)   perEl.textContent   = '$' + perV.toFixed(2) + ' / vial' + (disc > 0 ? ' \u00B7 ' + disc + '% off' : '');
        if (saveEl)  saveEl.textContent  = disc > 0 ? 'You save $' + (variantPrice * qty - total).toFixed(2) : '';

        opt.dataset.price = total.toFixed(2); // keep data-price in sync
      });
    }

    // Expose so variant pill handler can trigger bundle recalc + price update
    window.syntraBundleOnVariant = function (variantPrice) {
      _variantPrice = variantPrice;
      if (!document.querySelector('.bundle-option')) return;
      recalcAllBundleCards(variantPrice);
      // Refresh price display for whichever bundle is active
      var active = document.querySelector('.bundle-option--active');
      if (active) {
        var disc  = parseInt(active.dataset.discount, 10) || 0;
        var qty   = parseInt(active.dataset.qty, 10)      || 1;
        var total = bundleTotal(variantPrice, qty, disc);
        var di    = document.querySelector('.js-bundle-discount');
        if (di) di.value = disc;
        setPriceDisplay(total);
      }
    };

    // Bundle click
    document.addEventListener('click', function (e) {
      var opt = e.target.closest('.bundle-option');
      if (!opt) return;

      document.querySelectorAll('.bundle-option').forEach(function (o) { o.classList.remove('bundle-option--active'); });
      opt.classList.add('bundle-option--active');

      var qty  = parseInt(opt.dataset.qty, 10)      || 1;
      var disc = parseInt(opt.dataset.discount, 10) || 0;

      var total = (_variantPrice !== null)
        ? bundleTotal(_variantPrice, qty, disc)
        : parseFloat(opt.dataset.price) || 0;

      var qtyInput  = document.querySelector('.qty-input');
      var qtyDisp   = document.querySelector('.qty-value');
      var discInput = document.querySelector('.js-bundle-discount');

      if (qtyInput)  qtyInput.value         = qty;
      if (qtyDisp)   qtyDisp.textContent    = qty;
      if (discInput) discInput.value         = disc;

      setPriceDisplay(total);
    });

    // Initial recalc on page load if variant + bundles coexist
    if (_variantPrice !== null && document.querySelector('.bundle-option')) {
      recalcAllBundleCards(_variantPrice);
      var active = document.querySelector('.bundle-option--active');
      if (active) {
        var disc  = parseInt(active.dataset.discount, 10) || 0;
        var qty   = parseInt(active.dataset.qty, 10)      || 1;
        var di    = document.querySelector('.js-bundle-discount');
        if (di) di.value = disc;
        setPriceDisplay(bundleTotal(_variantPrice, qty, disc));
      }
    }
  })();

  /* ── FAQ accordion ── */
  document.addEventListener('click', function (e) {
    var btn = e.target.closest('.faq-item__btn');
    if (!btn) return;
    var expanded = btn.getAttribute('aria-expanded') === 'true';
    var answerId = btn.getAttribute('aria-controls');
    var answer   = document.getElementById(answerId);
    btn.setAttribute('aria-expanded', !expanded);
    if (answer) { answer.hidden = expanded; }
  });

  /* ── Animate finding bars on scroll ── */
  var barFills = document.querySelectorAll('.finding-bar-fill');
  if (barFills.length && 'IntersectionObserver' in window) {
    var barObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
          barObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    barFills.forEach(function (bar) {
      bar.style.animationPlayState = 'paused';
      barObserver.observe(bar);
    });
  }

  /* ── Gallery thumb switching ── */
  document.addEventListener('click', function (e) {
    var thumb = e.target.closest('.product-gallery__thumb');
    if (!thumb) return;
    var gallery = thumb.closest('.product-gallery');
    if (!gallery) return;
    gallery.querySelectorAll('.product-gallery__thumb').forEach(function (t) {
      t.classList.remove('active');
    });
    thumb.classList.add('active');
  });

})();

/* ── Variant pill selector ── */
(function () {
  var pills = document.querySelectorAll('.variant-pill');
  if (!pills.length) return;

  var variants     = window.syntraVariants || [];
  var priceEl      = document.querySelector('.js-bundle-price');
  var stockBadge   = document.querySelector('.js-stock-badge');
  var stockText    = document.querySelector('.js-stock-text');
  var variantLabel = document.querySelector('.js-variant-label');
  var variantIdx   = document.querySelector('.js-variant-index');
  var atcBtn       = document.querySelector('.js-atc-btn');
  var atcPrice     = document.querySelector('.js-atc-price');
  var atcVerb      = document.querySelector('.js-atc-verb');
  var cartSection  = document.querySelector('.js-cart-section');
  var soldSection  = document.querySelector('.js-soldout-section');
  var boNotice     = document.querySelector('.js-backorder-notice');
  var galleryImg   = document.querySelector('.js-gallery-main-img');

  function applyVariant(v) {
    // Update label above pills
    if (variantLabel) variantLabel.textContent = v.label;

    // Update price display
    if (priceEl) priceEl.innerHTML = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>' + parseFloat(v.price).toFixed(2) + '</bdi></span>';

    // Update stock badge class + text
    if (stockBadge) {
      stockBadge.classList.remove('stock-badge--in', 'stock-badge--out', 'stock-badge--backorder');
      if (v.stock === 'instock') {
        stockBadge.classList.add('stock-badge--in');
        if (stockText) stockText.textContent = 'In Stock \u2014 Same Day Dispatch on Orders Before 2PM AEST Mon\u2013Fri';
      } else if (v.stock === 'onbackorder') {
        stockBadge.classList.add('stock-badge--backorder');
        if (stockText) stockText.textContent = 'Available on Backorder';
      } else {
        stockBadge.classList.add('stock-badge--out');
        if (stockText) stockText.textContent = 'Out of Stock';
      }
    }

    // Toggle sold-out vs cart sections
    if (v.stock === 'outofstock') {
      if (cartSection)  cartSection.style.display  = 'none';
      if (soldSection)  soldSection.style.display  = '';
    } else {
      if (soldSection)  soldSection.style.display  = 'none';
      if (cartSection)  cartSection.style.display  = '';

      // Backorder notice
      if (boNotice) boNotice.style.display = v.stock === 'onbackorder' ? '' : 'none';

      // ATC button
      if (atcBtn) {
        atcBtn.classList.toggle('btn--backorder', v.stock === 'onbackorder');
      }
      if (atcVerb) atcVerb.textContent = v.stock === 'onbackorder' ? 'Pre-Order' : 'Add to Cart';
      if (atcPrice) atcPrice.textContent = '$' + parseFloat(v.price).toFixed(2);
    }

    // Update hidden variant index input
    if (variantIdx) variantIdx.value = v.index;

    // Swap gallery image if variant has one
    if (galleryImg && v.imgUrl) {
      galleryImg.src = v.imgUrl;
      galleryImg.srcset = '';
    } else if (galleryImg && galleryImg.dataset.defaultSrc) {
      galleryImg.src = galleryImg.dataset.defaultSrc;
      galleryImg.srcset = '';
    }

    // Recalculate bundle prices for the new variant price
    // (syntraBundleOnVariant also updates price display + discount input for active bundle)
    if (typeof window.syntraBundleOnVariant === 'function') {
      window.syntraBundleOnVariant(v.price);
    }
  }

  pills.forEach(function (pill) {
    pill.addEventListener('click', function () {
      // Update active pill
      pills.forEach(function (p) { p.classList.remove('variant-pill--active'); });
      pill.classList.add('variant-pill--active');

      var idx = parseInt(pill.dataset.index, 10);
      var v   = variants[idx];
      if (v) applyVariant(v);
    });
  });
})();

/* ── Blog category filter ── */
document.addEventListener('click', function(e) {
  var btn = e.target.closest('.blog-filter-btn');
  if (!btn) return;
  var cat = btn.dataset.cat;
  document.querySelectorAll('.blog-filter-btn').forEach(function(b) { b.classList.remove('active'); });
  btn.classList.add('active');
  document.querySelectorAll('.blog-card').forEach(function(card) {
    card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
  });
});
