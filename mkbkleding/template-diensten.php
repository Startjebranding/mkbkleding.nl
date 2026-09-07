<?php if(!defined('ABSPATH'))exit; /* Template Name: Diensten */ get_header(); ?>
<header class="page-hero">
  <div class="container">
    <h1>Kleding met jouw logo &amp; je eigen kledingmerk</h1>
    <p>Van bedrukte basics tot een compleet kledingmerk vanaf de stof. Wij regelen het ontwerp, de productie en de levering.</p>
    <div class="page-hero-chips">
      <span class="chip-licht"><i class="fa-solid fa-box-open" aria-hidden="true"></i> Geen minimale afname</span>
      <span class="chip-licht"><i class="fa-solid fa-bolt" aria-hidden="true"></i> Reactie binnen 1 werkdag</span>
      <span class="chip-licht"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> Ontwerp eerst ter goedkeuring</span>
    </div>
  </div>
</header>

<section class="section" id="diensten">
  <div class="container">
    <div class="seam"></div>
    <h2 class="section-title">Ons volledige aanbod</h2>
    <p class="section-intro">Kies het product dat bij jouw bedrijf past. Twijfel je? Vraag een vrijblijvende offerte aan en wij denken mee.</p>
    <div class="diensten-grid diensten-grid-groot">
      <?php foreach (mkb_producten() as $prod) : ?>
      <div class="dienst-card" id="<?php echo esc_attr($prod['slug']); ?>">

        <?php if (!empty($prod['foto'])) : ?>
          <div class="dienst-foto">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/producten/' . $prod['foto']); ?>"
                 alt="<?php echo esc_attr($prod['foto_alt']); ?>" loading="lazy" width="600" height="400">
          </div>
        <?php else : ?>
          <div class="dienst-icon">
            <i class="<?php echo esc_attr($prod['icoon']); ?>" aria-hidden="true"></i>
          </div>
        <?php endif; ?>

        <h3><?php echo wp_kses_post($prod['naam']); ?></h3>
        <p><?php echo wp_kses_post($prod['tekst']); ?></p>

        <p class="dienst-label" id="geschikt-<?php echo esc_attr($prod['slug']); ?>">Geschikt voor:</p>
        <ul class="dienst-tags" aria-labelledby="geschikt-<?php echo esc_attr($prod['slug']); ?>">
          <?php foreach ($prod['geschikt'] as $g) : ?>
            <li><a href="<?php echo esc_url(home_url($g['url'])); ?>"><?php echo esc_html($g['label']); ?></a></li>
          <?php endforeach; ?>
        </ul>

        <?php if (!empty($prod['let_op'])) : ?>
          <p class="dienst-letop">
            <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
            <span><strong>Let op:</strong> <?php echo esc_html($prod['let_op']); ?></span>
          </p>
        <?php endif; ?>

        <p class="dienst-opdruk"><strong><?php echo esc_html($prod['opdruk_label']); ?>:</strong> <?php echo esc_html($prod['opdruk']); ?></p>

        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="tel:+31687515929" class="dienst-bel"><i class="fa-solid fa-phone" aria-hidden="true"></i> Of bel 06 87 51 59 29</a>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<section class="section section-dark" id="opdruk-methoden">
  <div class="container">
    <div class="seam seam-light"></div>
    <h2 class="section-title section-title-light">Drie manieren om jouw logo op kleding te zetten</h2>
    <p class="section-intro section-intro-light">Elke opdrukstechniek heeft zijn eigen sterke punten. Wij adviseren je welke het beste past bij jouw kleding, logo en aantallen.</p>
    <div class="methoden-grid">

      <div class="methode-card">
        <div class="methode-icon">
          <i class="fa-solid fa-print" aria-hidden="true"></i>
        </div>
        <h3>Zeefdruk</h3>
        <p>Geschikt voor grote aantallen. Scherpe kleuren, lage stukprijs bij grotere orders. Ideaal voor eenvoudige logo's met weinig kleuren.</p>
      </div>

      <div class="methode-card">
        <div class="methode-icon">
          <i class="fa-solid fa-scissors" aria-hidden="true"></i>
        </div>
        <h3>Borduurwerk</h3>
        <p>Premium uitstraling voor polo's en caps. Duurzaam en professioneel. Het logo wordt direct in het textiel geborduurd voor een strak eindresultaat.</p>
      </div>

      <div class="methode-card">
        <div class="methode-icon">
          <i class="fa-solid fa-spray-can" aria-hidden="true"></i>
        </div>
        <h3>Transferprint</h3>
        <p>Flexibel voor kleine aantallen en kleurrijke ontwerpen met foto's of gradients. Geschikt wanneer het logo veel details of kleurverloop bevat.</p>
      </div>

    </div>
  </div>
</section>

<section class="section" id="sectoren">
  <div class="container">
    <div class="seam"></div>
    <h2 class="section-title">Voor elke sector in het MKB</h2>
    <p class="section-intro">Elke branche heeft eigen wensen. Hieronder lees je per sector wat we maken en waar we op letten. Twijfel je? <a href="/offerte/">Vraag vrijblijvend een offerte aan</a>.</p>
    <div class="diensten-grid diensten-grid-groot">

      <div class="dienst-card" id="sector-sportclubs">
        <div class="dienst-icon"><i class="fa-solid fa-trophy" aria-hidden="true"></i></div>
        <h3>Sportclubs &amp; verenigingen</h3>
        <p>Teamkleding in de clubkleuren, kleding voor bestuur en vrijwilligers en limited-edition jubileumhoodies. Ook in kleine aantallen, met ruimte voor meerdere sponsorlogo&rsquo;s.</p>
        <p class="dienst-opdruk"><strong>Populair:</strong> teamhoodies, trainingskleding, jubileumshirts</p>
        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="<?php echo esc_url(home_url('/clubkleding-verenigingen/')); ?>" class="dienst-meer">Meer over clubkleding <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="dienst-card" id="sector-kledingmerken">
        <div class="dienst-icon"><i class="fa-solid fa-tags" aria-hidden="true"></i></div>
        <h3>Eigen kledingmerken</h3>
        <p>Private label vanaf de stof: snijden, naaien en afwerken met je eigen was- en merklabels. Van eerste sample tot complete collectie — klein beginnen kan, zonder grote minimale afname.</p>
        <p class="dienst-opdruk"><strong>Populair:</strong> heavyweight hoodies, streetwear-tees, eigen labels</p>
        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="<?php echo esc_url(home_url('/eigen-kledingmerk-laten-maken/')); ?>" class="dienst-meer">Meer over eigen merk <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="dienst-card" id="sector-fitness">
        <div class="dienst-icon"><i class="fa-solid fa-dumbbell" aria-hidden="true"></i></div>
        <h3>Fitness &amp; gyms</h3>
        <p>Een sportieve, herkenbare look voor je team en je leden. Van trainerskleding tot merchandise die je leden met trots dragen, met je logo strak op de borst of rug.</p>
        <p class="dienst-opdruk"><strong>Populair:</strong> sportshirts, hoodies, tanktops</p>
        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="<?php echo esc_url(home_url('/bedrijfskleding-bedrijven/')); ?>" class="dienst-meer">Meer over bedrijfskleding <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="dienst-card" id="sector-horeca">
        <div class="dienst-icon"><i class="fa-solid fa-utensils" aria-hidden="true"></i></div>
        <h3>Horeca</h3>
        <p>Kleding die past bij de uitstraling van je zaak en tegen een stootje kan. Van strakke polo&rsquo;s en overhemden tot t-shirts, met je logo netjes geborduurd of gedrukt.</p>
        <p class="dienst-opdruk"><strong>Populair:</strong> polo&rsquo;s, overhemden, schorten met logo</p>
        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="<?php echo esc_url(home_url('/bedrijfskleding-horeca/')); ?>" class="dienst-meer">Meer over horecakleding <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="dienst-card" id="sector-retail">
        <div class="dienst-icon"><i class="fa-solid fa-store" aria-hidden="true"></i></div>
        <h3>Retail</h3>
        <p>Eén team, één gezicht op de winkelvloer. Herkenbare kleding waardoor klanten direct zien wie er werkt — representatief en in lijn met je huisstijl.</p>
        <p class="dienst-opdruk"><strong>Populair:</strong> polo&rsquo;s, t-shirts, sweaters</p>
        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="<?php echo esc_url(home_url('/bedrijfskleding-bedrijven/')); ?>" class="dienst-meer">Meer over bedrijfskleding <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="dienst-card" id="sector-kantoor">
        <div class="dienst-icon"><i class="fa-solid fa-briefcase" aria-hidden="true"></i></div>
        <h3>MKB &amp; kantoor</h3>
        <p>Professioneel voor de dag komen bij klantbezoek, een beurs of op kantoor. Verzorgde kleding met je logo, ook voor kleine teams en zzp&rsquo;ers — al vanaf 1 stuk.</p>
        <p class="dienst-opdruk"><strong>Populair:</strong> overhemden, polo&rsquo;s, bodywarmers</p>
        <div class="dienst-acties">
          <a href="<?php echo esc_url(home_url('/offerte/')); ?>" class="btn btn-primary btn-small">Vraag offerte aan</a>
          <a href="<?php echo esc_url(home_url('/bedrijfskleding-kantoor/')); ?>" class="dienst-meer">Meer over kantoorkleding <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="section section-soft" id="statiegeld">
  <div class="container">
    <div class="statiegeld-home">
      <div>
        <span class="statiegeld-badge"><i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i> Op al onze kleding</span>
        <h2>Op alles hierboven zit statiegeld</h2>
        <p>Welk product je ook kiest, er komt een klein statiegeldbedrag per stuk bij. Dat bedrag krijg je volledig terug zodra je de kleding bij ons inlevert.</p>
        <p>Wij bekijken dan per kledingstuk wat er nog in zit: een tweede leven, terug naar garen, of een nieuwe toepassing als poetsdoek of isolatie. Zo hoef jij nooit meer te bedenken wat je met oude bedrijfskleding aan moet.</p>
        <div class="hero-ctas">
          <a href="<?php echo esc_url(home_url('/statiegeld/')); ?>" class="btn btn-primary">Zo werkt statiegeld</a>
          <a href="<?php echo esc_url(home_url('/statiegeld/#tarieven')); ?>" class="btn btn-secondary">Bekijk de bedragen</a>
        </div>
      </div>

      <div class="kringloop-kaart">
        <p class="hangtag-label">Wat er met je kleding gebeurt</p>
        <ul class="kringloop-lijst">
          <li>
            <span class="kring-bol"><i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i></span>
            <span class="kring-tekst">
              <strong>Nog draagbaar</strong>
              <span>Logo eraf, opgeknapt en een tweede leven.</span>
            </span>
          </li>
          <li>
            <span class="kring-bol"><i class="fa-solid fa-recycle" aria-hidden="true"></i></span>
            <span class="kring-tekst">
              <strong>Versleten</strong>
              <span>Vervezeld tot nieuw garen voor nieuw textiel.</span>
            </span>
          </li>
          <li>
            <span class="kring-bol"><i class="fa-solid fa-screwdriver-wrench" aria-hidden="true"></i></span>
            <span class="kring-tekst">
              <strong>Kapot</strong>
              <span>Poetsdoek, isolatie of vulmateriaal.</span>
            </span>
          </li>
        </ul>
        <p class="hangtag-footer">Hergebruik waar het kan, recycling waar het moet</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-cta" id="cta">
  <div class="container cta-container">
    <h2>Klaar om jouw logo op kleding te zetten?</h2>
    <p>Vraag een vrijblijvende offerte aan. Geen minimale afname, geen verborgen kosten. Wij reageren binnen één werkdag.</p>
    <a href="/offerte/" class="btn btn-primary">Offerte aanvragen</a>
  </div>
</section>
<?php get_footer(); ?>
