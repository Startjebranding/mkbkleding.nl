/* reviews.js — Reviews systeem voor MKB-kleding.nl (localStorage) */

(function () {
  'use strict';

  /* =========================================================
     SEED DATA
     ========================================================= */
  var SEED_REVIEWS = [
    {
      id: '1',
      naam: 'Roel van Vliet',
      functie: 'Directeur',
      bedrijf: 'Van Vliet Containers',
      sector: 'Transport',
      sterren: 5,
      tekst: 'Snel geregeld en precies zoals afgesproken. De polo\'s met ons logo zien er prachtig uit. Zeker voor herhaling vatbaar.',
      datum: '2025-11-12',
      goedgekeurd: true
    },
    {
      id: '2',
      naam: 'Sandra Geerling',
      functie: 'HR-manager',
      bedrijf: 'Geerling & Benard',
      sector: 'Zorg',
      sterren: 5,
      tekst: 'Eindelijk een leverancier die ook kleine aantallen levert. Perfect voor onze thuiszorgmedewerkers. Persoonlijk contact, snelle levering.',
      datum: '2026-01-08',
      goedgekeurd: true
    },
    {
      id: '3',
      naam: 'Arjan de Boer',
      functie: 'Voorzitter',
      bedrijf: 'Padelclub De Hofstede',
      sector: 'Sport',
      sterren: 5,
      tekst: 'Onze teamshirts en trainingssets zijn van topkwaliteit. Het ontwerpproces was heel prettig: we konden alles eerst goedkeuren.',
      datum: '2026-03-22',
      goedgekeurd: true
    }
  ];

  var STORAGE_KEY = 'mkb_reviews';

  /* =========================================================
     CORE CRUD
     ========================================================= */

  function getReviews() {
    try {
      var raw = localStorage.getItem(STORAGE_KEY);
      if (raw) {
        var parsed = JSON.parse(raw);
        if (Array.isArray(parsed) && parsed.length > 0) {
          return parsed;
        }
      }
    } catch (_) {
      // JSON parse error or localStorage unavailable — fall through to seed
    }
    // Return seed and persist it
    saveReviews(SEED_REVIEWS);
    return SEED_REVIEWS.slice();
  }

  function saveReviews(reviews) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(reviews));
    } catch (_) {
      // localStorage unavailable or quota exceeded — silently ignore
    }
  }

  function addReview(reviewObj) {
    var reviews = getReviews();
    reviewObj.id = Date.now().toString();
    reviews.push(reviewObj);
    saveReviews(reviews);
  }

  function deleteReview(id) {
    var reviews = getReviews().filter(function (r) { return r.id !== id; });
    saveReviews(reviews);
  }

  function toggleGoedkeuring(id) {
    var reviews = getReviews().map(function (r) {
      if (r.id === id) {
        return Object.assign({}, r, { goedgekeurd: !r.goedgekeurd });
      }
      return r;
    });
    saveReviews(reviews);
  }

  function updateReview(id, data) {
    var reviews = getReviews().map(function (r) {
      if (r.id === id) {
        return Object.assign({}, r, data);
      }
      return r;
    });
    saveReviews(reviews);
  }

  /* =========================================================
     RENDER HELPERS
     ========================================================= */

  function renderStars(n) {
    var html = '';
    for (var i = 1; i <= 5; i++) {
      if (i <= n) {
        html += '<i class="fas fa-star" aria-hidden="true"></i>';
      } else {
        html += '<i class="far fa-star" aria-hidden="true"></i>';
      }
    }
    return html;
  }

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function reviewCardHtml(review) {
    return (
      '<article class="review-card">' +
        '<div class="review-stars" aria-label="' + review.sterren + ' van 5 sterren">' +
          renderStars(review.sterren) +
        '</div>' +
        '<p class="review-tekst"><em>&ldquo;' + escapeHtml(review.tekst) + '&rdquo;</em></p>' +
        '<p class="review-auteur">' + escapeHtml(review.naam) + '</p>' +
        '<p class="review-bedrijf">' + escapeHtml(review.functie) + ' bij ' + escapeHtml(review.bedrijf) + '</p>' +
        '<span class="review-sector">' + escapeHtml(review.sector) + '</span>' +
      '</article>'
    );
  }

  /* =========================================================
     PUBLIC RENDER — GRID
     ========================================================= */

  function renderReviewsGrid(containerId, maxItems, onlyGoedgekeurd) {
    if (typeof maxItems === 'undefined') maxItems = null;
    if (typeof onlyGoedgekeurd === 'undefined') onlyGoedgekeurd = true;

    var container = document.getElementById(containerId);
    if (!container) return;

    var reviews = getReviews();

    if (onlyGoedgekeurd) {
      reviews = reviews.filter(function (r) { return r.goedgekeurd; });
    }

    // Sort by datum descending
    reviews.sort(function (a, b) {
      return b.datum.localeCompare(a.datum);
    });

    if (maxItems !== null && maxItems > 0) {
      reviews = reviews.slice(0, maxItems);
    }

    if (reviews.length === 0) {
      container.innerHTML =
        '<p class="reviews-leeg">Er zijn nog geen beoordelingen beschikbaar.</p>';
      return;
    }

    container.innerHTML = reviews.map(reviewCardHtml).join('');
  }

  /* =========================================================
     ADMIN RENDER
     ========================================================= */

  function renderAdminList(containerId) {
    var container = document.getElementById(containerId);
    if (!container) return;

    var reviews = getReviews();

    // Sort newest first
    reviews.sort(function (a, b) {
      return b.datum.localeCompare(a.datum);
    });

    if (reviews.length === 0) {
      container.innerHTML = '<p class="reviews-leeg">Geen reviews gevonden.</p>';
      return;
    }

    var html = reviews.map(function (review) {
      var goedgekeurdLabel = review.goedgekeurd ? 'Goedgekeurd' : 'Niet goedgekeurd';
      var goedgekeurdClass = review.goedgekeurd ? 'badge--goedgekeurd' : 'badge--afgekeurd';
      var toggleLabel      = review.goedgekeurd ? 'Afkeuren' : 'Goedkeuren';
      var tekstPreview     = escapeHtml(review.tekst.slice(0, 80)) + (review.tekst.length > 80 ? '&hellip;' : '');

      return (
        '<div class="admin-review-item" data-id="' + escapeHtml(review.id) + '">' +
          '<div class="admin-review-header">' +
            '<strong>' + escapeHtml(review.naam) + '</strong>' +
            ' &mdash; ' + escapeHtml(review.bedrijf) +
            ' <span class="review-sector">' + escapeHtml(review.sector) + '</span>' +
            ' <span class="badge ' + goedgekeurdClass + '">' + goedgekeurdLabel + '</span>' +
          '</div>' +
          '<div class="review-stars" aria-label="' + review.sterren + ' van 5 sterren">' +
            renderStars(review.sterren) +
          '</div>' +
          '<p class="admin-review-preview">' + tekstPreview + '</p>' +
          '<p class="admin-review-meta">' +
            escapeHtml(review.functie) + ' &bull; ' + escapeHtml(review.datum) +
          '</p>' +
          '<div class="admin-review-actions">' +
            '<button class="btn btn--toggle-goedkeuring" data-id="' + escapeHtml(review.id) + '">' +
              toggleLabel +
            '</button>' +
            '<button class="btn btn--bewerken" data-id="' + escapeHtml(review.id) + '">' +
              'Bewerken' +
            '</button>' +
            '<button class="btn btn--verwijderen" data-id="' + escapeHtml(review.id) + '">' +
              'Verwijderen' +
            '</button>' +
          '</div>' +
        '</div>'
      );
    }).join('');

    container.innerHTML = html;

    // Bind action buttons
    container.querySelectorAll('.btn--toggle-goedkeuring').forEach(function (btn) {
      btn.addEventListener('click', function () {
        toggleGoedkeuring(btn.dataset.id);
        renderAdminList(containerId);
      });
    });

    container.querySelectorAll('.btn--verwijderen').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var confirmed = window.confirm(
          'Weet je zeker dat je deze review wilt verwijderen? Dit kan niet ongedaan worden gemaakt.'
        );
        if (!confirmed) return;
        deleteReview(btn.dataset.id);
        renderAdminList(containerId);
      });
    });

    container.querySelectorAll('.btn--bewerken').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = btn.dataset.id;
        var reviews = getReviews();
        var review  = reviews.find(function (r) { return r.id === id; });
        if (!review) return;

        // Fill edit form fields if they exist on the page
        var fields = ['naam', 'functie', 'bedrijf', 'sector', 'sterren', 'tekst', 'datum'];
        fields.forEach(function (field) {
          var el = document.querySelector('#editForm [name="' + field + '"]') ||
                   document.querySelector('[name="edit_' + field + '"]');
          if (el) el.value = review[field];
        });

        // Store the id being edited
        var editForm = document.getElementById('editForm');
        if (editForm) {
          editForm.dataset.editId = id;
          editForm.hidden = false;
          editForm.removeAttribute('hidden');
          editForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  }

  /* =========================================================
     IMPORT / EXPORT
     ========================================================= */

  function exportReviews() {
    var reviews = getReviews();
    var json    = JSON.stringify(reviews, null, 2);
    var blob    = new Blob([json], { type: 'application/json' });
    var url     = URL.createObjectURL(blob);
    var a       = document.createElement('a');
    a.href      = url;
    a.download  = 'mkb-reviews-export.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  }

  function importReviews(jsonString) {
    var parsed;
    try {
      parsed = JSON.parse(jsonString);
    } catch (_) {
      throw new Error('Ongeldig JSON-bestand.');
    }
    if (!Array.isArray(parsed)) {
      throw new Error('Het JSON-bestand moet een array van reviews bevatten.');
    }
    saveReviews(parsed);
    return parsed.length;
  }

  /* =========================================================
     PUBLIC API
     ========================================================= */

  window.Reviews = {
    getReviews:        getReviews,
    saveReviews:       saveReviews,
    addReview:         addReview,
    deleteReview:      deleteReview,
    toggleGoedkeuring: toggleGoedkeuring,
    updateReview:      updateReview,
    renderReviewsGrid: renderReviewsGrid,
    renderStars:       renderStars,
    renderAdminList:   renderAdminList,
    exportReviews:     exportReviews,
    importReviews:     importReviews
  };

}());
