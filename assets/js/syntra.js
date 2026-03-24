/* Syntra — Main JS */
(function () {
  'use strict';

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
