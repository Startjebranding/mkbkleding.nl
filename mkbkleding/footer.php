<?php if (!defined('ABSPATH')) exit; ?>
<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo-wit.svg" alt="mkbkleding.nl" class="logo-img" width="142" height="32"></a>
        <p class="footer-omschrijving">Bedrijfskleding, eigen kledingmerk en jubileumkleding met jouw logo, speciaal voor het Nederlandse MKB. Persoonlijk advies, geen minimale afname.</p>
      </div>
      <div class="footer-kolom">
        <h4>Snel naar</h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/diensten/')); ?>">Diensten</a></li>
          <li><a href="<?php echo esc_url(home_url('/statiegeld/')); ?>">Statiegeld</a></li>
          <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>">Portfolio</a></li>
          <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
          <li><a href="<?php echo esc_url(home_url('/over-ons/')); ?>">Over ons</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
          <li><a href="<?php echo esc_url(home_url('/offerte/')); ?>">Offerte aanvragen</a></li>
        </ul>
      </div>
      <div class="footer-kolom">
        <h4>Contact</h4>
        <ul>
          <li><i class="fa-solid fa-phone" aria-hidden="true"></i><a href="tel:+31687515929">06 87 51 59 29</a></li>
          <li><i class="fa-solid fa-location-dot" aria-hidden="true"></i>Rotterdam</li>
          <li><i class="fa-solid fa-building" aria-hidden="true"></i>KVK: 95798137</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; <?php echo esc_html(date('Y')); ?> MKBkleding. Alle rechten voorbehouden.</span>
      <span><a href="<?php echo esc_url(home_url('/privacy/')); ?>">Privacyverklaring</a> &middot; <a href="<?php echo esc_url(home_url('/voorwaarden/')); ?>">Algemene voorwaarden</a></span>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
