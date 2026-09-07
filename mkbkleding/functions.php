<?php
if (!defined('ABSPATH')) exit;

/* Files-only data */
require_once get_template_directory() . '/data/articles.php';
require_once get_template_directory() . '/data/sectors.php';
require_once get_template_directory() . '/data/producten.php';
/* Centrale SEO-head-laag (title, meta, canonical, OG/Twitter, JSON-LD) */
require_once get_template_directory() . '/inc/seo.php';
/* Virtuele pagina's (sectorpagina's + blog-permalinks) + sitemap + redirects */
require_once get_template_directory() . '/inc/virtual-pages.php';
require_once get_template_directory() . '/inc/offerte-handler.php';
/* Statiegeld: verwerkt de retouraanmeldingen */
require_once get_template_directory() . '/inc/retour-handler.php';

/* Theme setup */
function mkb_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    register_nav_menus(array('primary' => 'Hoofdmenu'));
}
add_action('after_setup_theme', 'mkb_setup');

/* Styles & scripts */
function mkb_assets() {
    $dir = get_template_directory_uri();
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('mkb-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap', array(), null);
    wp_enqueue_style('mkb-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2');
    wp_enqueue_style('mkb-app', $dir . '/assets/app.css', array(), $ver);
    wp_enqueue_style('mkb-style', get_stylesheet_uri(), array('mkb-app'), $ver);
    // Data + renderer for reviews/portfolio/blog cards (same as static site)
    wp_enqueue_script('mkb-reviews-data', $dir . '/data/reviews-data.js', array(), $ver, true);
    wp_enqueue_script('mkb-portfolio-data', $dir . '/data/portfolio-data.js', array(), $ver, true);
    wp_enqueue_script('mkb-blog-data', $dir . '/data/blog-data.js', array(), $ver, true);
    wp_enqueue_script('mkb-main', $dir . '/js/main.js', array(), $ver, true);
    // Adres + beveiligingssleutel voor het offerteformulier
    wp_localize_script('mkb-main', 'mkbOfferte', array(
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('mkb_offerte'),
    ));
    wp_enqueue_script('mkb-content', $dir . '/js/content.js', array('mkb-reviews-data','mkb-portfolio-data','mkb-blog-data'), $ver, true);

    // Rekenhulp + retourformulier: alleen op de statiegeldpagina laden
    if (is_page_template('template-statiegeld.php')) {
        wp_enqueue_script('mkb-statiegeld', $dir . '/js/statiegeld.js', array(), $ver, true);
        wp_localize_script('mkb-statiegeld', 'mkbRetour', array(
            'url'   => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mkb_retour'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'mkb_assets');

/* Auto-create pages + set front/blog page on activation */
function mkb_setup_pages() {
    $templates = array(
        'diensten'  => array('Diensten', 'template-diensten.php'),
        'portfolio' => array('Portfolio', 'template-portfolio.php'),
        'over-ons'  => array('Over ons', 'template-over-ons.php'),
        'contact'   => array('Contact', 'template-contact.php'),
        'offerte'   => array('Offerte aanvragen', 'template-offerte.php'),
        'statiegeld'=> array('Statiegeld', 'template-statiegeld.php'),
    );
    foreach ($templates as $slug => $info) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            $id = wp_insert_post(array(
                'post_title'  => $info[0],
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_type'   => 'page',
                'post_content'=> '',
            ));
            if ($id && !is_wp_error($id)) {
                update_post_meta($id, '_wp_page_template', $info[1]);
            }
        }
    }
    // Home page (front page; layout comes from front-page.php)
    $home = get_page_by_path('home');
    if (!$home) {
        $home_id = wp_insert_post(array('post_title'=>'Home','post_name'=>'home','post_status'=>'publish','post_type'=>'page','post_content'=>''));
    } else { $home_id = $home->ID; }
    // Blog page (posts list)
    $blog = get_page_by_path('blog');
    if (!$blog) {
        $blog_id = wp_insert_post(array('post_title'=>'Blog','post_name'=>'blog','post_status'=>'publish','post_type'=>'page','post_content'=>''));
    } else { $blog_id = $blog->ID; }
    if (!empty($home_id)) { update_option('show_on_front','page'); update_option('page_on_front',$home_id); }
    if (!empty($blog_id)) { update_option('page_for_posts',$blog_id); }
}
add_action('after_switch_theme', 'mkb_setup_pages');

/* ------------------------------------------------------------------ *
 *  Statiegeldpagina eenmalig aanmaken en in het menu zetten.
 *
 *  mkb_setup_pages() hierboven draait alleen als je van thema wisselt,
 *  niet als je het thema bijwerkt. Daarom regelt dit blok de nieuwe
 *  pagina bij de eerstvolgende keer dat je in WordPress inlogt.
 *  Het draait precies één keer; daarna doet het niets meer.
 * ------------------------------------------------------------------ */
function mkb_statiegeld_installeren() {
    if (get_option('mkb_statiegeld_geinstalleerd')) return;
    if (!current_user_can('edit_pages')) return;

    // 1. De pagina zelf
    $pagina = get_page_by_path('statiegeld');
    if (!$pagina) {
        $id = wp_insert_post(array(
            'post_title'   => 'Statiegeld',
            'post_name'    => 'statiegeld',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ));
    } else {
        $id = $pagina->ID;
    }
    if (!$id || is_wp_error($id)) return;
    update_post_meta($id, '_wp_page_template', 'template-statiegeld.php');

    // 2. In het hoofdmenu zetten, direct achter Diensten
    $locaties = get_nav_menu_locations();
    if (!empty($locaties['primary'])) {
        $menu_id = (int) $locaties['primary'];
        $items   = wp_get_nav_menu_items($menu_id);
        $bestaat = false;
        $na_diensten = 0;

        if ($items) {
            foreach ($items as $item) {
                if ((int) $item->object_id === (int) $id && $item->object === 'page') {
                    $bestaat = true;
                }
                if (strcasecmp(trim($item->title), 'Diensten') === 0) {
                    $na_diensten = (int) $item->menu_order;
                }
            }
        }

        if (!$bestaat) {
            // Ruimte maken achter Diensten zodat Statiegeld daar netjes invalt
            if ($na_diensten && $items) {
                foreach ($items as $item) {
                    if ((int) $item->menu_order > $na_diensten) {
                        wp_update_nav_menu_item($menu_id, $item->db_id, array(
                            'menu-item-position' => (int) $item->menu_order + 1,
                        ));
                    }
                }
            }
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'Statiegeld',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $id,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $na_diensten ? $na_diensten + 1 : 0,
            ));
        }
    }

    update_option('mkb_statiegeld_geinstalleerd', 1);
}
add_action('admin_init', 'mkb_statiegeld_installeren');

/* Fallback menu if no menu assigned */
function mkb_fallback_menu() {
    $items = array(
        '/' => 'Home',
        '/diensten/' => 'Diensten',
        '/statiegeld/' => 'Statiegeld',
        '/portfolio/' => 'Portfolio',
        '/blog/' => 'Blog',
        '/over-ons/' => 'Over ons',
        '/contact/' => 'Contact',
    );
    echo '<ul class="nav-links" id="navLinks">';
    foreach ($items as $path => $label) {
        echo '<li><a href="' . esc_url(home_url($path)) . '">' . esc_html($label) . '</a></li>';
    }
    echo '<li><a href="' . esc_url(home_url('/offerte/')) . '" class="btn btn-primary btn-small">Offerte aanvragen</a></li>';
    echo '</ul>';
}
