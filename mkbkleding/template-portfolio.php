<?php if(!defined('ABSPATH'))exit; /* Template Name: Portfolio */ get_header(); ?>
<header class="page-hero">
  <div class="container">
    <h1>Portfolio &amp; reviews</h1>
    <p>Bekijk ons werk en lees ervaringen van tevreden klanten.</p>
  </div>
</header>

<!-- Portfolio -->
<section id="portfolio">
  <div class="container">
    <div class="section-head reveal">
      <div class="seam"></div>
      <h2>Ons werk</h2>
      <p>Foto's en projecten worden hier toegevoegd zodra ze beschikbaar zijn. Neem gerust contact op voor een kijkje in ons portfolio.</p>
    </div>

    <div class="portfolio-grid reveal" id="portfolioGrid"></div>

    <div class="reveal" style="margin-top:32px;background:var(--rose-soft);border:2px dashed var(--rose);border-radius:var(--radius);padding:20px 28px;max-width:600px">
      <p style="font-weight:600;color:var(--slate)">
        <i class="fa-solid fa-camera" aria-hidden="true" style="color:var(--rose-deep);margin-right:8px"></i>
        Heb je een project dat we mogen toevoegen? Stuur een e-mail naar <a href="mailto:info@mkbkleding.nl" style="color:var(--rose-deep);text-decoration:underline">info@mkbkleding.nl</a> met foto's en je toestemming.
      </p>
    </div>
  </div>
</section>

<!-- Reviews -->
<section id="reviews" style="background:var(--bg-soft)">
  <div class="container">
    <div class="section-head reveal">
      <div class="seam"></div>
      <h2>Wat onze klanten zeggen</h2>
      <p>Eerlijke ervaringen van ondernemers die ons al kennen.</p>
    </div>
    <div id="reviewsPortfolio" class="reveal"></div>
    <p style="margin-top:28px;font-size:0.85rem;color:var(--slate-400);text-align:center">
      Wil je een review achterlaten? Stuur een e-mail naar <a href="mailto:info@mkbkleding.nl" style="color:var(--rose)">info@mkbkleding.nl</a>.
    </p>
  </div>
</section>

<!-- CTA -->
<section class="werkwijze">
  <div class="container" style="text-align:center">
    <div class="seam" style="margin-left:auto;margin-right:auto"></div>
    <h2 style="color:#fff;font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;margin-bottom:14px">Jouw project de volgende?</h2>
    <p style="color:#94A3B8;margin-bottom:28px;max-width:48ch;margin-left:auto;margin-right:auto">Vraag vandaag nog een offerte aan; we reageren binnen 1 werkdag.</p>
    <a href="/offerte/" class="btn btn-primary">Offerte aanvragen <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
  </div>
</section>
<?php get_footer(); ?>
