<?php if(!defined('ABSPATH'))exit; get_header(); ?>
<?php
/* Blogoverzicht + losse artikelen komen uit data/articles.php (files-only).
   ?artikel=<slug> toont een los artikel, anders het overzicht. */
mkb_render_blog();
?>
<?php get_footer(); ?>
