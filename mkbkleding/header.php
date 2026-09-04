<?php if (!defined('ABSPATH')) exit; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav class="nav" aria-label="Hoofdnavigatie">
  <div class="container nav-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo.svg" alt="mkbkleding.nl" class="logo-img" width="142" height="32"></a>
    <button class="nav-toggle" aria-label="Menu openen" aria-expanded="false" aria-controls="navLinks">
      <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>
    <?php
      wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'nav-links',
        'items_wrap'     => '<ul id="navLinks" class="%2$s">%3$s</ul>',
        'fallback_cb'    => 'mkb_fallback_menu',
      ));
    ?>
  </div>
</nav>
