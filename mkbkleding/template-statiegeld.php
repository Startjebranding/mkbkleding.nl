<?php if(!defined('ABSPATH'))exit; /* Template Name: Statiegeld */ get_header(); ?>

<section class="page-hero">
  <div class="container">
    <span class="statiegeld-badge statiegeld-badge-donker"><i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i> Nieuw bij MKBkleding</span>
    <h1>Statiegeld op je bedrijfskleding</h1>
    <p>Je betaalt een klein bedrag per kledingstuk en krijgt dat volledig terug zodra je de kleding bij ons inlevert. Wij zorgen daarna dat elk stuk de meest milieuvriendelijke route krijgt: hergebruik waar het kan, recycling waar het moet.</p>
    <div class="page-hero-chips">
      <span class="chip-licht"><i class="fa-solid fa-euro-sign" aria-hidden="true"></i> Statiegeld volledig retour</span>
      <span class="chip-licht"><i class="fa-solid fa-truck" aria-hidden="true"></i> Wij halen het op</span>
      <span class="chip-licht"><i class="fa-solid fa-recycle" aria-hidden="true"></i> Geen kledingstuk bij het restafval</span>
    </div>
  </div>
</section>

<section id="wat">
  <div class="container">
    <div class="section-head">
      <div class="seam"></div>
      <h2>Bedrijfskleding hoort niet in de container</h2>
      <p>Gemiddeld hangt werkkleding er na een paar jaar uit. Dan verdwijnt hij meestal in het restafval, terwijl de stof nog prima bruikbaar is. Daar hebben we iets op bedacht.</p>
    </div>

    <div class="container-narrow" style="padding-left:0;padding-right:0;max-width:720px">
      <p>Bij elke bestelling zetten wij een klein statiegeldbedrag per kledingstuk apart. Dat bedrag staat gewoon zichtbaar op je offerte en je factuur, zodat je precies weet waar je aan toe bent. Lever je de kleding later bij ons in, dan krijg je dat statiegeld <strong>volledig</strong> terug.</p>
      <p>Wat wij ervoor terugkrijgen, is de kleding zelf. Wij bekijken elk stuk apart en kiezen de route die op dat moment het minste kost aan het milieu. Draagbaar? Dan krijgt het een tweede leven. Versleten maar heel materiaal? Dan gaat het naar vezelrecycling. Pas als er echt niets anders in zit, gaat het naar een lagere toepassing zoals poetsdoek of isolatiemateriaal.</p>
      <p>Voor jou als ondernemer betekent het vooral: je hoeft nooit meer te bedenken wat je met oude bedrijfskleding aan moet.</p>
    </div>

    <div class="usps-grid" style="margin-top:44px">
      <div class="usp-card">
        <div class="usp-icon"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i></div>
        <h3>Je geld terug</h3>
        <p>Het statiegeld is geen bijdrage en geen toeslag. Je krijgt het tot de laatste cent terug bij inlevering.</p>
      </div>
      <div class="usp-card">
        <div class="usp-icon"><i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i></div>
        <h3>Wij doen het werk</h3>
        <p>Sorteren, logo's verwijderen, de juiste verwerker zoeken. Jij zet de dozen klaar, wij regelen de rest.</p>
      </div>
      <div class="usp-card">
        <div class="usp-icon"><i class="fa-solid fa-file-lines" aria-hidden="true"></i></div>
        <h3>Zwart op wit</h3>
        <p>Je ontvangt een overzicht van wat je hebt ingeleverd en hoe het is verwerkt. Handig voor je eigen verhaal.</p>
      </div>
      <div class="usp-card">
        <div class="usp-icon"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></div>
        <h3>Jouw logo blijft van jou</h3>
        <p>Voordat kleding een tweede leven krijgt, halen wij bedrijfslogo's eraf. Niemand loopt rond in jouw naam.</p>
      </div>
    </div>
  </div>
</section>

<section class="werkwijze" id="hoe-werkt-het">
  <div class="container">
    <div class="section-head section-head-center">
      <div class="seam seam-center"></div>
      <h2>Zo werkt het</h2>
      <p>Vier stappen, verder geen administratie. Je hoeft niets bij te houden, dat doen wij.</p>
    </div>
    <div class="stappen stappen-4">
      <div class="stap">
        <div class="stap-nummer">1</div>
        <h3>Statiegeld op de offerte</h3>
        <p>Bij je bestelling zie je het statiegeld als aparte regel staan. Je weet meteen wat je later terugkrijgt.</p>
      </div>
      <div class="stap">
        <div class="stap-nummer">2</div>
        <h3>Gewoon dragen</h3>
        <p>Je team draagt de kleding zolang die meegaat. Er zit geen haast achter en je hoeft niets bij te houden.</p>
      </div>
      <div class="stap">
        <div class="stap-nummer">3</div>
        <h3>Retour aanmelden</h3>
        <p>Klaar met een set? Meld je retour aan via het formulier. Wij halen het op of sturen je een verzendlabel.</p>
      </div>
      <div class="stap">
        <div class="stap-nummer">4</div>
        <h3>Statiegeld terug</h3>
        <p>Wij tellen na en storten het bedrag terug, of zetten het als tegoed op je volgende bestelling.</p>
      </div>
    </div>
  </div>
</section>

<section id="tarieven">
  <div class="container">
    <div class="section-head">
      <div class="seam"></div>
      <h2>Wat krijg je per kledingstuk terug?</h2>
      <p>Het statiegeld verschilt per soort kleding. Zwaardere kleding levert meer bruikbaar materiaal op en heeft daarom een hoger bedrag.</p>
    </div>

    <div class="tabel-wrap">
      <table class="tarieven-tabel" id="tarievenTabel">
        <thead>
          <tr>
            <th scope="col">Soort kleding</th>
            <th scope="col">Statiegeld per stuk</th>
            <th scope="col">Waarom dit bedrag</th>
          </tr>
        </thead>
        <tbody>
          <?php
          /* ------------------------------------------------------------------ *
           *  DE STATIEGELDBEDRAGEN — dit is de enige plek waar ze staan.
           *  De rekenhulp hieronder leest deze tabel uit, dus je hoeft een
           *  bedrag maar op één plek te wijzigen. Gebruik een punt als
           *  decimaalteken in 'tarief' (2.50, niet 2,50).
           * ------------------------------------------------------------------ */
          $mkb_tarieven = array(
              array('naam' => 'T-shirt',                          'icoon' => 'fa-solid fa-shirt',         'tarief' => 2.50, 'waarom' => 'Lichte katoenen stof, goed te vervezelen tot nieuw garen.'),
              array('naam' => 'Polo of overhemd',                 'icoon' => 'fa-solid fa-user-tie',      'tarief' => 3.50, 'waarom' => 'Gaat lang mee en is vaak nog prima draagbaar bij inlevering.'),
              array('naam' => 'Hoodie of sweater',                'icoon' => 'fa-solid fa-vest-patches',  'tarief' => 5.00, 'waarom' => 'Meer stof per stuk, dus meer bruikbaar materiaal terug.'),
              array('naam' => 'Werkbroek',                        'icoon' => 'fa-solid fa-person',        'tarief' => 5.00, 'waarom' => 'Stevig weefsel dat zich goed leent voor een tweede toepassing.'),
              array('naam' => 'Sportshirt of trainingsset',       'icoon' => 'fa-solid fa-futbol',        'tarief' => 3.50, 'waarom' => 'Polyester dat via een aparte stroom gerecycled wordt.'),
              array('naam' => 'Werkjas, softshell of bodywarmer', 'icoon' => 'fa-solid fa-vest',          'tarief' => 7.50, 'waarom' => 'Het meeste materiaal per stuk en de hoogste restwaarde.'),
          );
          foreach ($mkb_tarieven as $t) :
          ?>
          <tr data-naam="<?php echo esc_attr($t['naam']); ?>" data-icoon="<?php echo esc_attr($t['icoon']); ?>" data-tarief="<?php echo esc_attr(number_format($t['tarief'], 2, '.', '')); ?>">
            <td><?php echo esc_html($t['naam']); ?></td>
            <td class="bedrag">&euro;&nbsp;<?php echo esc_html(number_format($t['tarief'], 2, ',', '.')); ?></td>
            <td><?php echo esc_html($t['waarom']); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <p class="tabel-note">
      Bedragen zijn per stuk en exclusief btw. Het statiegeld staat als aparte regel op je offerte en factuur, zodat het niet met de kledingprijs verward wordt.
      Twijfel je in welke categorie jouw product valt? <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color:var(--rose-deep)">Vraag het ons even</a>.
    </p>
  </div>
</section>

<section class="sectoren" id="rekenen">
  <div class="container">
    <div class="section-head">
      <div class="seam"></div>
      <h2>Reken uit wat je terugkrijgt</h2>
      <p>Vul in hoeveel stuks je afneemt en zie meteen welk bedrag je later kunt terughalen.</p>
    </div>

    <div class="calc-wrap">
      <div class="calc-card">
        <div class="calc-kop">
          <span>Soort kleding</span>
          <span>Per stuk</span>
          <span>Aantal</span>
        </div>
        <div id="calcRijen">
          <p class="tabel-note" style="margin:16px 0 0">
            De rekenhulp heeft JavaScript nodig. Bekijk anders de tarieven in de tabel hierboven.
          </p>
        </div>
      </div>

      <aside class="calc-uitkomst" aria-live="polite">
        <span class="calc-uitkomst-label">Dit krijg je terug</span>
        <div class="calc-bedrag" id="calcBedrag">&euro; 0,00</div>
        <p class="calc-sub" id="calcSub">Vul hiernaast in hoeveel stuks je afneemt.</p>
        <ul class="calc-regels" id="calcRegels" hidden></ul>
        <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary">Offerte aanvragen</a>
        <p class="calc-note">
          Een indicatie op basis van onze standaardbedragen. Het exacte statiegeld staat op je offerte.
        </p>
      </aside>
    </div>
  </div>
</section>

<section id="verwerking">
  <div class="container">
    <div class="section-head">
      <div class="seam"></div>
      <h2>Wat er met je ingeleverde kleding gebeurt</h2>
      <p>Wij beoordelen elk kledingstuk apart. Niet alles kan hetzelfde traject in, en dat is precies het punt: de staat van de kleding bepaalt welke route het minste kost aan het milieu.</p>
    </div>

    <div class="route-grid">
      <div class="route-card">
        <span class="route-staat route-staat-goed"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> Nog draagbaar</span>
        <div class="route-icon"><i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i></div>
        <h3>Tweede leven</h3>
        <p>Kleding die nog goed is, verdient geen versnipperaar. Wij halen je logo eraf, knappen op waar nodig en geven het stuk opnieuw uit.</p>
        <ul class="route-lijst">
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Logo verwijderd of onherkenbaar gemaakt</li>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Gewassen en nagekeken op gebreken</li>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Naar sociale werkplaatsen en kringloop</li>
        </ul>
      </div>

      <div class="route-card">
        <span class="route-staat route-staat-versleten"><i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i> Versleten</span>
        <div class="route-icon"><i class="fa-solid fa-recycle" aria-hidden="true"></i></div>
        <h3>Terug naar garen</h3>
        <p>Uitgelubberd of verkleurd, maar de stof zelf is nog gezond. Dan gaat het naar vezelrecycling en wordt het weer grondstof voor nieuw textiel.</p>
        <ul class="route-lijst">
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Gesorteerd op vezelsoort en kleur</li>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Mechanisch vervezeld tot nieuw garen</li>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Scheelt nieuwe katoen en polyester</li>
        </ul>
      </div>

      <div class="route-card">
        <span class="route-staat route-staat-kapot"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i> Kapot</span>
        <div class="route-icon"><i class="fa-solid fa-screwdriver-wrench" aria-hidden="true"></i></div>
        <h3>Nieuwe toepassing</h3>
        <p>Gescheurd, doorgesleten of vol verf. Ook dan blijft het materiaal in gebruik, alleen in een andere vorm dan kleding.</p>
        <ul class="route-lijst">
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Poetsdoeken voor werkplaats en garage</li>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Isolatie- en vulmateriaal</li>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i> Verbranding pas als er echt niets anders in zit</li>
        </ul>
      </div>
    </div>

    <p class="tabel-note">
      Eén uitzondering: kleding die doorweekt is van olie, chemie of medisch afval kunnen wij niet aannemen. Die hoort bij een gespecialiseerde verwerker thuis. Meld het even bij je aanmelding, dan denken we mee.
    </p>
  </div>
</section>

<section class="werkwijze" id="voordelen">
  <div class="container">
    <div class="section-head">
      <div class="seam seam-light"></div>
      <h2>Wat het jou oplevert</h2>
      <p>Behalve je statiegeld terug.</p>
    </div>
    <div class="methoden-grid">
      <div class="methode-card">
        <div class="methode-icon"><i class="fa-solid fa-clipboard-check" aria-hidden="true"></i></div>
        <h3>Aantoonbaar circulair</h3>
        <p>Sinds 1 juli 2023 geldt in Nederland uitgebreide producentenverantwoordelijkheid voor textiel. Steeds meer opdrachtgevers en aanbestedingen vragen daarom hoe jij je bedrijfskleding afvoert. Met ons overzicht heb je een concreet antwoord in plaats van goede bedoelingen.</p>
      </div>
      <div class="methode-card">
        <div class="methode-icon"><i class="fa-solid fa-box-open" aria-hidden="true"></i></div>
        <h3>Eén zorg minder</h3>
        <p>Geen dozen oude werkkleding meer op zolder, geen gedoe met de milieustraat en geen discussie over wie het regelt. Je meldt het aan en het wordt opgehaald.</p>
      </div>
      <div class="methode-card">
        <div class="methode-icon"><i class="fa-solid fa-comments" aria-hidden="true"></i></div>
        <h3>Een verhaal dat klopt</h3>
        <p>Duurzaamheid roepen is makkelijk. Laten zien dat je oude bedrijfskleding terugbrengt en er statiegeld voor terugkrijgt, is iets waar je klanten en je team wél iets bij voelen.</p>
      </div>
    </div>
  </div>
</section>

<section class="offerte-sectie" id="inleveren">
  <div class="container">
    <div class="offerte-inner">
      <div class="offerte-pitch">
        <div class="seam"></div>
        <h2>Kleding inleveren</h2>
        <p style="color:var(--slate-600);font-size:1.05rem">Klaar met een set bedrijfskleding? Meld je retour hier aan. Je hoeft niets voor te sorteren of schoon te maken, wij doen de rest.</p>
        <ul class="offerte-punten">
          <li><i class="fa-solid fa-truck" aria-hidden="true"></i> Vanaf 10 stuks halen wij het gratis bij je op</li>
          <li><i class="fa-solid fa-tag" aria-hidden="true"></i> Kleinere aantallen? Je krijgt een verzendlabel van ons</li>
          <li><i class="fa-solid fa-scissors" aria-hidden="true"></i> Logo's verwijderen doen wij, dat hoef jij niet te doen</li>
          <li><i class="fa-solid fa-receipt" aria-hidden="true"></i> Je ontvangt een creditnota en een verwerkingsoverzicht</li>
          <li><i class="fa-solid fa-clock" aria-hidden="true"></i> Statiegeld terug binnen 10 werkdagen na ontvangst</li>
        </ul>
        <p style="color:var(--slate-600);font-size:0.95rem">Liever even bellen? Dat kan op <a href="tel:+31687515929" style="color:var(--rose-deep)">06 87 51 59 29</a>.</p>
      </div>

      <div class="form-card">
        <form id="retourForm" novalidate>
          <div class="form-grid">

            <div class="form-field">
              <label for="retourNaam">Naam <span class="verplicht" aria-hidden="true">*</span></label>
              <input type="text" id="retourNaam" name="naam" placeholder="Jouw volledige naam" required autocomplete="name">
              <span class="veldfout">Vul je naam in.</span>
            </div>

            <div class="form-field">
              <label for="retourBedrijf">Bedrijfsnaam <span class="verplicht" aria-hidden="true">*</span></label>
              <input type="text" id="retourBedrijf" name="bedrijfsnaam" placeholder="Naam van je bedrijf" required autocomplete="organization">
              <span class="veldfout">Vul je bedrijfsnaam in.</span>
            </div>

            <div class="form-field">
              <label for="retourEmail">E-mailadres <span class="verplicht" aria-hidden="true">*</span></label>
              <input type="email" id="retourEmail" name="email" placeholder="jouw@emailadres.nl" required autocomplete="email">
              <span class="veldfout">Vul een geldig e-mailadres in.</span>
            </div>

            <div class="form-field">
              <label for="retourTelefoon">Telefoonnummer <span class="optioneel">(optioneel)</span></label>
              <input type="tel" id="retourTelefoon" name="telefoon" placeholder="06 12 34 56 78" autocomplete="tel">
              <span class="veldfout">Controleer je telefoonnummer.</span>
            </div>

            <div class="form-field">
              <label for="retourOrder">Ordernummer <span class="optioneel">(optioneel)</span></label>
              <input type="text" id="retourOrder" name="ordernummer" placeholder="Staat op je factuur">
            </div>

            <div class="form-field">
              <label for="retourAantal">Aantal stuks <span class="verplicht" aria-hidden="true">*</span></label>
              <input type="number" id="retourAantal" name="aantal" min="1" max="10000" step="1" inputmode="numeric" placeholder="Bijvoorbeeld 24" required>
              <span class="veldfout">Vul in hoeveel stuks je inlevert.</span>
            </div>

            <div class="form-field full">
              <label for="retourType">Wat lever je in? <span class="verplicht" aria-hidden="true">*</span></label>
              <select id="retourType" name="producttype" required>
                <option value="">Kies een soort</option>
                <option value="T-shirts">T-shirts</option>
                <option value="Polo's of overhemden">Polo's of overhemden</option>
                <option value="Hoodies of sweaters">Hoodies of sweaters</option>
                <option value="Werkbroeken">Werkbroeken</option>
                <option value="Sportkleding">Sportkleding</option>
                <option value="Werkjassen of bodywarmers">Werkjassen of bodywarmers</option>
                <option value="Gemengd">Gemengd, meerdere soorten</option>
              </select>
              <span class="veldfout">Kies wat je inlevert.</span>
            </div>

            <div class="form-field full">
              <label for="retourStaat">In welke staat is de kleding ongeveer? <span class="verplicht" aria-hidden="true">*</span></label>
              <select id="retourStaat" name="staat" required>
                <option value="">Kies een omschrijving</option>
                <option value="Grotendeels nog draagbaar">Grotendeels nog draagbaar</option>
                <option value="Versleten maar heel">Versleten maar heel</option>
                <option value="Kapot of zwaar vervuild">Kapot of zwaar vervuild</option>
                <option value="Door elkaar">Door elkaar, alles zit ertussen</option>
              </select>
              <span class="veldfout">Kies een omschrijving.</span>
            </div>

            <div class="form-field full">
              <label for="retourMethode">Ophalen of opsturen? <span class="optioneel">(optioneel)</span></label>
              <select id="retourMethode" name="methode">
                <option value="">Laat MKBkleding kiezen</option>
                <option value="Graag laten ophalen">Graag laten ophalen</option>
                <option value="Ik stuur het zelf op">Ik stuur het zelf op</option>
              </select>
            </div>

            <div class="form-field full">
              <label for="retourToelichting">Toelichting <span class="optioneel">(optioneel)</span></label>
              <textarea id="retourToelichting" name="toelichting" rows="4" placeholder="Bijvoorbeeld: wanneer het klaarstaat, op welk adres, of er iets tussen zit met olie of chemie." maxlength="500"></textarea>
            </div>

            <div class="honeypot" aria-hidden="true">
              <label for="retourWebsite">Laat dit veld leeg</label>
              <input type="text" id="retourWebsite" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-submit">
              <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-box-open" aria-hidden="true"></i>
                Retour aanmelden
              </button>
              <p class="form-privacy">
                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                Je gegevens worden vertrouwelijk behandeld. Lees onze <a href="<?php echo esc_url(home_url('/privacy/')); ?>" style="color:var(--rose-deep)">privacyverklaring</a>.
              </p>
            </div>

          </div>
        </form>

        <div class="retour-succes" id="retourSucces" hidden>
          <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
          <h3>Aanmelding ontvangen</h3>
          <p>Bedankt. We nemen binnen 1 werkdag contact met je op om het ophalen of opsturen te regelen.</p>
          <p>Iets vergeten door te geven? Mail gerust naar <a href="mailto:info@mkbkleding.nl">info@mkbkleding.nl</a>.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sectoren" id="faq">
  <div class="container">
    <div class="section-head">
      <div class="seam"></div>
      <h2>Veelgestelde vragen over statiegeld</h2>
      <p>Staat jouw vraag er niet bij? <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color:var(--rose-deep)">Neem contact op</a>, we leggen het graag even uit.</p>
    </div>
    <div class="faq-list" style="max-width:none">
      <?php foreach (mkb_statiegeld_faqs() as $faq) : ?>
      <details class="faq-item">
        <summary><?php echo esc_html($faq['v']); ?></summary>
        <p><?php echo wp_kses_post($faq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section-cta">
  <div class="container">
    <div class="cta-container" style="margin:0 auto">
      <h2>Bedrijfskleding die je terug kunt brengen</h2>
      <p>Vraag een offerte aan en je ziet het statiegeld meteen als aparte regel staan. Geen verplichtingen, wel duidelijkheid.</p>
      <div class="hero-ctas" style="justify-content:center">
        <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary">Offerte aanvragen</a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-secondary" style="color:#fff">Stel een vraag</a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
