/* main.js — Gedeelde JavaScript voor alle pagina's op MKB-kleding.nl */

(function () {
  'use strict';

  /* =========================================================
     1. MOBILE NAV TOGGLE
     ========================================================= */
  const navToggle = document.querySelector('.nav-toggle');
  const navLinks  = document.getElementById('navLinks');

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      const isOpen = navLinks.classList.toggle('open');
      navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    // Close nav when any link inside it is clicked
    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        navLinks.classList.remove('open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* =========================================================
     2. SCROLL REVEAL
     ========================================================= */
  const revealEls = document.querySelectorAll('.reveal');

  if (revealEls.length > 0) {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reducedMotion) {
      // Skip animation entirely — elements are already visible in CSS fallback
    } else if (!('IntersectionObserver' in window)) {
      // No support — show everything immediately
      revealEls.forEach(function (el) {
        el.classList.add('visible');
      });
    } else {
      const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;

          const el    = entry.target;
          const index = parseInt(el.dataset.revealIndex || '0', 10);
          const delay = Math.min(index * 70, 280);

          el.style.transitionDelay = delay + 'ms';
          el.classList.add('visible');
          observer.unobserve(el);
        });
      }, { threshold: 0.15 });

      revealEls.forEach(function (el, i) {
        el.dataset.revealIndex = String(i);
        observer.observe(el);
      });
    }
  }

  /* =========================================================
     3. ACTIVE NAV LINK
     ========================================================= */
  (function () {
    const path      = window.location.pathname;
    const allLinks  = document.querySelectorAll('nav a, #navLinks a');

    // Normalise a pathname to a canonical key for comparison
    function normalise(p) {
      // Strip trailing slash, lowercase
      return p.replace(/\/$/, '').toLowerCase() || '/';
    }

    // Convert /blog/ → /blog.html and vice-versa for fuzzy matching
    function equivalents(p) {
      const norm = normalise(p);
      const variants = [norm];
      if (norm.endsWith('.html')) {
        variants.push(norm.slice(0, -5));          // /blog.html → /blog
        variants.push(norm.slice(0, -5) + '/');    // /blog.html → /blog/
      } else {
        variants.push(norm + '.html');              // /blog → /blog.html
        variants.push(norm + '/');                  // /blog → /blog/
      }
      return variants;
    }

    const currentVariants = equivalents(path);

    allLinks.forEach(function (link) {
      const href = link.getAttribute('href');
      if (!href) return;

      // Resolve to absolute path
      let linkPath;
      try {
        linkPath = new URL(href, window.location.href).pathname;
      } catch (_) {
        return;
      }

      const linkVariants = equivalents(linkPath);

      // Direct match
      const directMatch = currentVariants.some(function (cv) {
        return linkVariants.includes(cv);
      });

      if (directMatch) {
        link.classList.add('active');
        return;
      }

      // Parent match: mark link if current page starts with link's path
      // (e.g. link = /blog, current = /blog/artikel-1)
      const normLink = normalise(linkPath);
      if (normLink !== '/' && normLink !== '' &&
          normalise(path).startsWith(normLink + '/')) {
        link.classList.add('active');
      }
    });
  }());

  /* =========================================================
     4. FORM VALIDATION — #offerteForm
     ========================================================= */
  const offerteForm = document.getElementById('offerteForm');

  if (offerteForm) {
    const emailRe    = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    const telefoonRe = /^[\d\s\+\-\(\)]{7,20}$/;

    function setInvalid(fieldEl, invalid) {
      if (!fieldEl) return;
      if (invalid) {
        fieldEl.classList.add('invalid');
      } else {
        fieldEl.classList.remove('invalid');
      }
    }

    function getField(name) {
      // .form-field wrapper that contains the named input/select/textarea
      const input = offerteForm.querySelector('[name="' + name + '"]');
      return input ? input.closest('.form-field') : null;
    }

    function val(name) {
      const el = offerteForm.querySelector('[name="' + name + '"]');
      return el ? el.value.trim() : '';
    }

    // Clear .invalid on input / change
    offerteForm.querySelectorAll('input, select, textarea').forEach(function (el) {
      el.addEventListener('input', function () {
        const wrapper = el.closest('.form-field');
        if (wrapper) wrapper.classList.remove('invalid');
      });
      el.addEventListener('change', function () {
        const wrapper = el.closest('.form-field');
        if (wrapper) wrapper.classList.remove('invalid');
      });
    });

    offerteForm.addEventListener('submit', function (e) {
      e.preventDefault();

      // Honeypot check
      const honeypot = offerteForm.querySelector('#website');
      if (honeypot && honeypot.value !== '') {
        return; // Silent — bot detected
      }

      let valid = true;

      // naam
      const naam = val('naam');
      const naamField = getField('naam');
      const naamInvalid = naam.length < 2;
      setInvalid(naamField, naamInvalid);
      if (naamInvalid) valid = false;

      // bedrijf
      const bedrijf = val('bedrijf');
      const bedrijfField = getField('bedrijf');
      const bedrijfInvalid = bedrijf.length < 2;
      setInvalid(bedrijfField, bedrijfInvalid);
      if (bedrijfInvalid) valid = false;

      // email
      const email = val('email');
      const emailField = getField('email');
      const emailInvalid = !emailRe.test(email);
      setInvalid(emailField, emailInvalid);
      if (emailInvalid) valid = false;

      // telefoon (optional)
      const telefoon = val('telefoon');
      const telefoonField = getField('telefoon');
      if (telefoon !== '') {
        const telInvalid = !telefoonRe.test(telefoon);
        setInvalid(telefoonField, telInvalid);
        if (telInvalid) valid = false;
      } else {
        setInvalid(telefoonField, false);
      }

      // sector (required, non-empty)
      const sector = val('sector');
      const sectorField = getField('sector');
      const sectorInvalid = sector === '';
      setInvalid(sectorField, sectorInvalid);
      if (sectorInvalid) valid = false;

      // bericht
      const bericht = val('bericht');
      const berichtField = getField('bericht');
      const berichtInvalid = bericht.length < 5;
      setInvalid(berichtField, berichtInvalid);
      if (berichtInvalid) valid = false;

      if (!valid) return;

      // Success
      offerteForm.style.display = 'none';
      const formSucces = document.getElementById('formSucces');
      if (formSucces) {
        formSucces.hidden = false;
        formSucces.removeAttribute('hidden');
        formSucces.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  /* =========================================================
     5. SMOOTH SCROLL FOR ANCHOR LINKS
     ========================================================= */
  (function () {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reducedMotion) return;

    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        const targetId = link.getAttribute('href').slice(1);
        if (!targetId) return;
        const target = document.getElementById(targetId);
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  }());

}());
