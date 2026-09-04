<?php if(!defined('ABSPATH'))exit; get_header(); ?>
<?php
/* Fallback-template. Blog komt uit data/articles.php (files-only),
   net als in home.php — zo werkt /blog/ ook zonder posts in de database. */
mkb_render_blog();
?>
<?php get_footer(); ?>
