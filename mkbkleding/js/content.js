/* content.js — toont reviews, portfolio en blog vanuit de data-bestanden in /data.
   Werkt op de live site én lokaal (geen server nodig). Bewerk de inhoud via beheer.html. */
(function () {
  'use strict';

  function esc(s) {
    return String(s == null ? '' : s)
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
  }

  function stars(n) {
    var h = '';
    for (var i = 1; i <= 5; i++) h += (i <= n)
      ? '<i class="fas fa-star" aria-hidden="true"></i>'
      : '<i class="far fa-star" aria-hidden="true"></i>';
    return h;
  }

  /* ---------- REVIEWS ---------- */
  function reviewCard(r) {
    return '<article class="review-card">' +
      '<div class="review-stars" aria-label="' + (r.sterren || 0) + ' van 5 sterren">' + stars(r.sterren) + '</div>' +
      '<p class="review-tekst"><em>&ldquo;' + esc(r.tekst) + '&rdquo;</em></p>' +
      '<p class="review-auteur">' + esc(r.naam) + '</p>' +
      '<p class="review-bedrijf">' + esc(r.functie) + ' bij ' + esc(r.bedrijf) + '</p>' +
      '<span class="review-sector">' + esc(r.sector) + '</span>' +
      '</article>';
  }
  function renderReviews(containerId, maxItems) {
    var el = document.getElementById(containerId);
    if (!el) return;
    var list = (window.MKB_REVIEWS || []).filter(function (r) { return r.goedgekeurd; });
    list.sort(function (a, b) { return String(b.datum).localeCompare(String(a.datum)); });
    if (maxItems) list = list.slice(0, maxItems);
    el.innerHTML = list.length
      ? list.map(reviewCard).join('')
      : '<p class="reviews-leeg">Er zijn nog geen beoordelingen beschikbaar.</p>';
  }

  /* ---------- PORTFOLIO ---------- */
  function portfolioCard(p, index) {
    var inner = p.afbeelding
      ? '<button type="button" class="portfolio-knop" data-lightbox="' + index + '" ' +
          'aria-label="Bekijk groter: ' + esc(p.label) + '">' +
          '<img src="' + esc(p.afbeelding) + '" alt="' + esc(p.label) + '" loading="lazy" ' +
            'style="width:100%;height:100%;object-fit:cover;border-radius:inherit">' +
          '<span class="portfolio-zoom" aria-hidden="true"><i class="fa-solid fa-expand"></i></span>' +
        '</button>'
      : '<div class="portfolio-placeholder">' +
          '<i class="fa-regular fa-image" aria-hidden="true"></i>' +
          '<p>Foto komt binnenkort</p>' +
          '<small>' + esc(p.label) + '</small>' +
        '</div>';
    return '<div class="portfolio-item">' + inner + '</div>';
  }
  /* De foto's die vergroot kunnen worden, in de volgorde waarin ze staan. */
  var fotos = [];

  function renderPortfolio(containerId) {
    var el = document.getElementById(containerId);
    if (!el) return;
    var list = window.MKB_PORTFOLIO || [];

    fotos = list.filter(function (p) { return !!p.afbeelding; });

    el.innerHTML = list.length
      ? list.map(function (p) {
          var idx = p.afbeelding ? fotos.indexOf(p) : -1;
          return portfolioCard(p, idx);
        }).join('')
      : '<p class="reviews-leeg">Nog geen portfolio-items.</p>';

    koppelLightbox(el);
  }

  /* ---------- FOTO VERGROTEN (lightbox) ---------- */
  var lb, lbImg, lbBijschrift, lbTeller, lbVorige, lbVolgende, huidige = 0, vorigeFocus = null;

  function maakLightbox() {
    if (lb) return;

    lb = document.createElement('div');
    lb.className = 'lightbox';
    lb.hidden = true;
    lb.setAttribute('role', 'dialog');
    lb.setAttribute('aria-modal', 'true');
    lb.setAttribute('aria-label', 'Vergrote foto');
    lb.innerHTML =
      '<button type="button" class="lightbox-vorige" aria-label="Vorige foto"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>' +
      '<figure class="lightbox-figuur"><img alt=""><figcaption></figcaption></figure>' +
      '<button type="button" class="lightbox-volgende" aria-label="Volgende foto"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>' +
      '<button type="button" class="lightbox-sluit" aria-label="Sluiten"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>' +
      '<p class="lightbox-teller"></p>';
    document.body.appendChild(lb);

    lbImg        = lb.querySelector('img');
    lbBijschrift = lb.querySelector('figcaption');
    lbTeller     = lb.querySelector('.lightbox-teller');
    lbVorige     = lb.querySelector('.lightbox-vorige');
    lbVolgende   = lb.querySelector('.lightbox-volgende');

    lb.querySelector('.lightbox-sluit').addEventListener('click', sluit);
    lbVorige.addEventListener('click', function () { spring(-1); });
    lbVolgende.addEventListener('click', function () { spring(1); });

    // Klik naast de foto sluit de lightbox
    lb.addEventListener('click', function (e) {
      if (e.target === lb || e.target.classList.contains('lightbox-figuur')) sluit();
    });

    document.addEventListener('keydown', function (e) {
      if (lb.hidden) return;
      if (e.key === 'Escape')     sluit();
      if (e.key === 'ArrowLeft')  spring(-1);
      if (e.key === 'ArrowRight') spring(1);
    });
  }

  function toon(i) {
    if (!fotos.length) return;
    huidige = (i + fotos.length) % fotos.length;
    var f = fotos[huidige];
    lbImg.src = f.afbeelding;
    lbImg.alt = f.label || '';
    lbBijschrift.textContent = f.label || '';
    lbTeller.textContent = (huidige + 1) + ' van ' + fotos.length;
    var meer = fotos.length > 1;
    lbVorige.hidden = !meer;
    lbVolgende.hidden = !meer;
  }

  function spring(stap) { toon(huidige + stap); }

  function open(i, knop) {
    maakLightbox();
    vorigeFocus = knop || null;
    toon(i);
    lb.hidden = false;
    document.body.style.overflow = 'hidden';
    lb.querySelector('.lightbox-sluit').focus();
  }

  function sluit() {
    if (!lb || lb.hidden) return;
    lb.hidden = true;
    lbImg.src = '';
    document.body.style.overflow = '';
    if (vorigeFocus) vorigeFocus.focus();
  }

  function koppelLightbox(el) {
    el.querySelectorAll('.portfolio-knop').forEach(function (knop) {
      knop.addEventListener('click', function () {
        var i = parseInt(knop.getAttribute('data-lightbox'), 10);
        if (!isNaN(i) && i >= 0) open(i, knop);
      });
    });
  }

  /* ---------- BLOG ---------- */
  function blogCard(b) {
    return '<article class="blog-card reveal">' +
      '<div class="blog-card-body">' +
        '<span class="blog-tag">' + esc(b.tag) + '</span>' +
        '<h3><a href="' + esc(b.href) + '">' + esc(b.titel) + '</a></h3>' +
        '<p>' + esc(b.samenvatting) + '</p>' +
        '<div class="blog-meta">' +
          '<span><i class="fa-regular fa-calendar" aria-hidden="true"></i> ' + esc(b.datum) + '</span>' +
          '<span><i class="fa-regular fa-clock" aria-hidden="true"></i> ' + esc(b.leestijd) + '</span>' +
        '</div>' +
        '<a href="' + esc(b.href) + '" class="btn btn-secondary btn-small" style="margin-top:14px">Lees artikel</a>' +
      '</div>' +
    '</article>';
  }
  function renderBlog(containerId) {
    var el = document.getElementById(containerId);
    if (!el) return;
    var list = window.MKB_BLOG || [];
    el.innerHTML = list.length
      ? list.map(blogCard).join('')
      : '<p class="reviews-leeg">Nog geen artikelen.</p>';
  }

  function init() {
    renderReviews('reviewsHomepage', 3);
    renderReviews('reviewsOverOns', null);
    renderReviews('reviewsPortfolio', null);
    renderPortfolio('portfolioGrid');
    renderBlog('blogGrid');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  window.MKBContent = { renderReviews: renderReviews, renderPortfolio: renderPortfolio, renderBlog: renderBlog };
})();
