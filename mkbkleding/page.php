<?php if(!defined('ABSPATH'))exit; get_header(); ?>
<header class="page-hero">
  <div class="container">
    <h1><?php the_title(); ?></h1>
  </div>
</header>
<section class="section">
  <div class="container">
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
  </div>
</section>
<?php get_footer(); ?>
