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
  function portfolioCard(p) {
    var inner = p.afbeelding
      ? '<img src="' + esc(p.afbeelding) + '" alt="' + esc(p.label) + '" loading="lazy" style="width:100%;height:100%;object-fit:cover;border-radius:inherit">'
      : '<div class="portfolio-placeholder">' +
          '<i class="fa-regular fa-image" aria-hidden="true"></i>' +
          '<p>Foto komt binnenkort</p>' +
          '<small>' + esc(p.label) + '</small>' +
        '</div>';
    return '<div class="portfolio-item">' + inner + '</div>';
  }
  function renderPortfolio(containerId) {
    var el = document.getElementById(containerId);
    if (!el) return;
    var list = window.MKB_PORTFOLIO || [];
    el.innerHTML = list.length
      ? list.map(portfolioCard).join('')
      : '<p class="reviews-leeg">Nog geen portfolio-items.</p>';
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
