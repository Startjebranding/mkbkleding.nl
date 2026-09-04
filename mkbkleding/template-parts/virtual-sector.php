<?php
/**
 * template-parts/virtual-sector.php
 * Rendert een virtuele sectorpagina uit $GLOBALS['mkb_virtual_page'].
 * Hergebruikt bestaande huisstijl-classes (page-hero, section, seam, faq-item, btn).
 */
if (!defined('ABSPATH')) exit;
$vp = isset($GLOBALS['mkb_virtual_page']) ? $GLOBALS['mkb_virtual_page'] : null;
if (!$vp) return;
get_header();
?>
<header class="page-hero">
  <div class="container">
    <h1><?php echo wp_kses_post($vp['h1']); ?></h1>
    <?php if (!empty($vp['intro'])) : ?><p><?php echo wp_kses_post($vp['intro']); ?></p><?php endif; ?>
    <div class="page-hero-chips">
      <span class="chip-licht"><i class="fa-solid fa-box-open" aria-hidden="true"></i> Geen minimale afname</span>
      <span class="chip-licht"><i class="fa-solid fa-bolt" aria-hidden="true"></i> Reactie binnen 1 werkdag</span>
      <span class="chip-licht"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> Ontwerp eerst ter goedkeuring</span>
    </div>
  </div>
</header>

<section class="section">
  <div class="container container-narrow">
    <div class="seam"></div>
    <?php echo wp_kses_post($vp['body']); ?>
  </div>
</section>

<?php if (!empty($vp['faqs'])) : ?>
<section class="section section-soft">
  <div class="container">
    <div class="seam"></div>
    <h2 class="section-title">Veelgestelde vragen</h2>
    <div class="faq-list" style="margin:36px 0 0;max-width:none">
      <?php foreach ($vp['faqs'] as $faq) : ?>
      <details class="faq-item">
        <summary><?php echo esc_html($faq['v']); ?></summary>
        <p><?php echo wp_kses_post($faq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section section-cta" id="cta">
  <div class="container cta-container">
    <h2>Klaar om jouw team te kleden?</h2>
    <p>Vraag een vrijblijvende offerte aan. Geen minimale afname, geen verborgen kosten. We reageren binnen 1 werkdag.</p>
    <a href="/offerte/" class="btn btn-primary">Offerte aanvragen</a>
  </div>
</section>
<?php
get_footer();
