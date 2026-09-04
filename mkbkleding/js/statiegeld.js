/* =========================================================
   STATIEGELD — rekenhulp + retouraanmelding
   ---------------------------------------------------------
   De bedragen staan NIET in dit bestand. Ze staan één keer in
   template-statiegeld.php, in de tarieventabel (#tarievenTabel),
   als data-tarief op elke <tr>. De rekenhulp leest ze daar uit.
   ========================================================= */
(function () {
  'use strict';

  function euro(bedrag) {
    return '€ ' + bedrag.toFixed(2).replace('.', ',');
  }

  /* =========================================================
     1. TARIEVEN INLEZEN UIT DE TABEL
     ========================================================= */
  function leesTarieven() {
    var rijen = document.querySelectorAll('#tarievenTabel tbody tr[data-tarief]');
    var lijst = [];

    Array.prototype.forEach.call(rijen, function (tr, i) {
      var tarief = parseFloat(tr.getAttribute('data-tarief'));
      if (isNaN(tarief)) return;

      lijst.push({
        id: 'calc-' + i,
        naam: tr.getAttribute('data-naam') || (tr.cells[0] ? tr.cells[0].textContent.trim() : 'Product'),
        icoon: tr.getAttribute('data-icoon') || 'fa-solid fa-shirt',
        tarief: tarief
      });
    });

    return lijst;
  }

  /* =========================================================
     2. REKENHULP
     ========================================================= */
  (function () {
    var rijenHouder = document.getElementById('calcRijen');
    var bedragEl    = document.getElementById('calcBedrag');
    var subEl       = document.getElementById('calcSub');
    var regelsEl    = document.getElementById('calcRegels');

    if (!rijenHouder || !bedragEl) return;

    var tarieven = leesTarieven();
    if (!tarieven.length) return;

    /* Terugvalmelding weghalen nu de rekenhulp echt werkt */
    rijenHouder.innerHTML = '';

    tarieven.forEach(function (t) {
      var rij = document.createElement('div');
      rij.className = 'calc-rij';

      var naam = document.createElement('div');
      naam.className = 'calc-naam';
      var icoon = document.createElement('i');
      icoon.className = t.icoon;
      icoon.setAttribute('aria-hidden', 'true');
      var naamTekst = document.createElement('span');
      naamTekst.textContent = t.naam;
      naam.appendChild(icoon);
      naam.appendChild(naamTekst);

      var tarief = document.createElement('div');
      tarief.className = 'calc-tarief';
      tarief.textContent = euro(t.tarief);

      var veld = document.createElement('div');
      var input = document.createElement('input');
      input.type = 'number';
      input.min = '0';
      input.max = '10000';
      input.step = '1';
      input.value = '';
      input.placeholder = '0';
      input.inputMode = 'numeric';
      input.id = t.id;
      input.setAttribute('aria-label', 'Aantal ' + t.naam);
      veld.appendChild(input);

      rij.appendChild(naam);
      rij.appendChild(tarief);
      rij.appendChild(veld);
      rijenHouder.appendChild(rij);

      t.input = input;
      input.addEventListener('input', bereken);
      input.addEventListener('change', bereken);
    });

    function bereken() {
      var totaalBedrag = 0;
      var totaalStuks = 0;
      var regels = [];

      tarieven.forEach(function (t) {
        var aantal = parseInt(t.input.value, 10);
        if (isNaN(aantal) || aantal < 0) aantal = 0;
        if (aantal > 10000) {
          aantal = 10000;
          t.input.value = '10000';
        }
        if (aantal === 0) return;

        var sub = aantal * t.tarief;
        totaalBedrag += sub;
        totaalStuks += aantal;
        regels.push({ naam: t.naam, aantal: aantal, sub: sub });
      });

      bedragEl.textContent = euro(totaalBedrag);

      if (subEl) {
        subEl.textContent = totaalStuks === 0
          ? 'Vul hiernaast in hoeveel stuks je afneemt.'
          : totaalStuks + (totaalStuks === 1 ? ' stuk' : ' stuks')
            + ' die je later kunt inleveren in plaats van weggooien.';
      }

      if (regelsEl) {
        regelsEl.innerHTML = '';
        regels.forEach(function (r) {
          var li = document.createElement('li');
          var links = document.createElement('span');
          links.textContent = r.aantal + '× ' + r.naam;
          var rechts = document.createElement('span');
          rechts.textContent = euro(r.sub);
          li.appendChild(links);
          li.appendChild(rechts);
          regelsEl.appendChild(li);
        });
        regelsEl.hidden = regels.length === 0;
      }
    }

    bereken();
  }());

  /* =========================================================
     3. RETOURAANMELDING — validatie + versturen naar WordPress
     ========================================================= */
  (function () {
    var form = document.getElementById('retourForm');
    if (!form) return;

    var succes = document.getElementById('retourSucces');
    var knop = form.querySelector('button[type="submit"]');
    var knopHTML = knop ? knop.innerHTML : '';

    var emailRe    = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var telefoonRe = /^[\d\s\+\-\(\)]{7,20}$/;

    function veld(naam) {
      return form.querySelector('[name="' + naam + '"]');
    }

    function waarde(naam) {
      var el = veld(naam);
      return el ? el.value.trim() : '';
    }

    function markeer(naam, fout) {
      var el = veld(naam);
      if (!el) return;
      var wrap = el.closest('.form-groep, .form-field');
      if (!wrap) return;
      if (fout) {
        wrap.classList.add('invalid');
      } else {
        wrap.classList.remove('invalid');
      }
    }

    function toonFout(tekst) {
      if (knop) { knop.disabled = false; knop.innerHTML = knopHTML; }
      var box = document.getElementById('retourFout');
      if (!box) {
        box = document.createElement('div');
        box.id = 'retourFout';
        box.setAttribute('role', 'alert');
        box.style.cssText = 'margin:1rem 0;padding:1rem 1.25rem;border-radius:8px;' +
          'background:#fdecec;border:1px solid #f5b5b5;color:#8f1f1f;line-height:1.5';
        form.parentNode.insertBefore(box, form);
      }
      box.innerHTML = tekst +
        ' Je kunt ons ook direct bereiken op <a href="tel:+31687515929" style="color:inherit;font-weight:600">06 87 51 59 29</a>' +
        ' of <a href="mailto:info@mkbkleding.nl" style="color:inherit;font-weight:600">info@mkbkleding.nl</a>.';
      box.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    /* Foutmelding weghalen zodra iemand iets aanpast */
    Array.prototype.forEach.call(form.querySelectorAll('input, select, textarea'), function (el) {
      ['input', 'change'].forEach(function (evt) {
        el.addEventListener(evt, function () {
          var wrap = el.closest('.form-groep, .form-field');
          if (wrap) wrap.classList.remove('invalid');
        });
      });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      /* Honeypot: stil afbreken bij bots */
      var hp = form.querySelector('#retourWebsite');
      if (hp && hp.value !== '') return;

      var geldig = true;

      function eis(naam, ok) {
        markeer(naam, !ok);
        if (!ok) geldig = false;
      }

      eis('naam', waarde('naam').length >= 2);
      eis('bedrijfsnaam', waarde('bedrijfsnaam').length >= 2);
      eis('email', emailRe.test(waarde('email')));
      eis('aantal', waarde('aantal') !== '' && parseInt(waarde('aantal'), 10) > 0);
      eis('producttype', waarde('producttype') !== '');
      eis('staat', waarde('staat') !== '');

      var tel = waarde('telefoon');
      eis('telefoon', tel === '' || telefoonRe.test(tel));

      if (!geldig) {
        var eersteFout = form.querySelector('.invalid input, .invalid select, .invalid textarea');
        if (eersteFout) eersteFout.focus();
        return;
      }

      if (typeof mkbRetour === 'undefined') {
        toonFout('De aanmelding kon niet worden verstuurd.');
        return;
      }

      if (knop) { knop.disabled = true; knop.textContent = 'Bezig met versturen…'; }

      var data = new FormData(form);
      data.append('action', 'mkb_retour');
      data.append('mkb_nonce', mkbRetour.nonce);

      fetch(mkbRetour.url, { method: 'POST', body: data, credentials: 'same-origin' })
        .then(function (r) { return r.json().catch(function () { return null; }); })
        .then(function (res) {
          if (!res || !res.success) {
            var m = (res && res.data && res.data.bericht) ? res.data.bericht : 'Er ging iets mis bij het versturen.';
            toonFout(m);
            return;
          }
          var oudeFout = document.getElementById('retourFout');
          if (oudeFout) oudeFout.remove();
          form.style.display = 'none';
          if (succes) {
            succes.hidden = false;
            succes.removeAttribute('hidden');
            succes.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        })
        .catch(function () {
          toonFout('We konden geen verbinding maken met de server.');
        });
    });
  }());

}());
