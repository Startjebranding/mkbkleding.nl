<?php if(!defined('ABSPATH'))exit; get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
<header class="artikel-hero">
  <div class="container">
    <div class="artikel-meta">
      <?php $cats = get_the_category(); if (!empty($cats)) : ?>
        <span class="blog-tag"><?php echo esc_html($cats[0]->name); ?></span>
      <?php endif; ?>
      <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html(get_the_date('j F Y')); ?></span>
    </div>
    <h1><?php the_title(); ?></h1>
  </div>
</header>
<main class="artikel-body">
  <div class="container artikel-container">
    <?php the_content(); ?>
    <p style="margin-top:32px"><a href="/offerte/" class="btn btn-primary">Offerte aanvragen</a></p>
  </div>
</main>
<?php endwhile; ?>
<?php get_footer(); ?>
