<?php
/**
 * virtual-pages.php — files-only "virtuele pagina's" + sitemap + redirects.
 *
 * WordPress op productie ontvangt alleen files, geen database. Daarom bestaan de
 * sectorpagina's en de blog-permalinks niet als database-record, maar worden ze
 * hier op request onderschept en met een echte HTTP 200 geserveerd (geen soft-404).
 *
 * - Sectorpagina's:   /<slug>/            (data uit data/sectors.php)
 * - Blogartikelen:    /blog/<slug>/       (data uit data/articles.php)
 * - Oude blog-URL:    /blog/?artikel=<slug>  -> 301 naar /blog/<slug>/
 * - Sitemap:          eigen provider voegt bovenstaande toe aan wp-sitemap.xml
 * - Opschoning:       sample-page + dubbele privacy 301'd; ruis uit de sitemap
 */
if (!defined('ABSPATH')) exit;

/* ------------------------------------------------------------------ *
 *  Router — vangt virtuele URL's af en serveert ze als 200
 * ------------------------------------------------------------------ */
add_action('template_redirect', 'mkb_virtual_router', 1);
function mkb_virtual_router() {
    $path = trim((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    /* --- 301-redirects (files-only opschoning) --- */
    $redirects = array(
        'sample-page'    => '/',
        'privacy-2'      => '/privacy/',
        'privacy-policy' => '/privacy/',
    );
    if (isset($redirects[$path])) {
        wp_safe_redirect(home_url($redirects[$path]), 301);
        exit;
    }

    /* --- Oude blog-query -> nieuwe permalink (301) --- */
    if (!empty($_GET['artikel'])) {
        $slug = sanitize_title(wp_unslash($_GET['artikel']));
        if (isset(mkb_get_articles()[$slug])) {
            wp_safe_redirect(home_url('/blog/' . $slug . '/'), 301);
            exit;
        }
    }

    /* --- Sectorpagina: /<slug>/ --- */
    $sectors = mkb_sector_pages();
    if (isset($sectors[$path])) {
        $GLOBALS['mkb_virtual_page'] = array('slug' => $path) + $sectors[$path];
        mkb_virtual_force_200();
        include get_template_directory() . '/template-parts/virtual-sector.php';
        exit;
    }

    /* --- Blogartikel op nette permalink: /blog/<slug>/ --- */
    if (preg_match('#^blog/([a-z0-9-]+)/?$#', $path, $m) && isset(mkb_get_articles()[$m[1]])) {
        $GLOBALS['mkb_force_article'] = $m[1];
        mkb_virtual_force_200();
        get_header();
        mkb_render_blog();
        get_footer();
        exit;
    }
}

/** Zorg dat een virtuele pagina een echte 200 is, geen soft-404. */
function mkb_virtual_force_200() {
    status_header(200);
    if (isset($GLOBALS['wp_query'])) {
        $GLOBALS['wp_query']->is_404      = false;
        $GLOBALS['wp_query']->is_page     = true;
        $GLOBALS['wp_query']->is_singular = true;
    }
}

/* ------------------------------------------------------------------ *
 *  Sitemap — eigen provider voor de virtuele pagina's
 * ------------------------------------------------------------------ */
add_action('wp_sitemaps_init', 'mkb_register_sitemap_provider');
function mkb_register_sitemap_provider($sitemaps) {
    if (!class_exists('WP_Sitemaps_Provider')) return;

    if (!class_exists('MKB_Virtual_Sitemap_Provider')) {
        class MKB_Virtual_Sitemap_Provider extends WP_Sitemaps_Provider {
            public function __construct() {
                $this->name        = 'mkblanding';
                $this->object_type = 'mkblanding';
            }
            public function get_url_list($page_num, $object_subtype = '') {
                $urls = array();
                foreach (array_keys(mkb_sector_pages()) as $slug) {
                    $urls[] = array('loc' => home_url('/' . $slug . '/'));
                }
                foreach (array_keys(mkb_get_articles()) as $slug) {
                    $urls[] = array('loc' => home_url('/blog/' . $slug . '/'));
                }
                return $urls;
            }
            public function get_max_num_pages($object_subtype = '') {
                return 1;
            }
        }
    }
    $sitemaps->registry->add_provider('mkblanding', new MKB_Virtual_Sitemap_Provider());
}

/* Ruis uit de sitemap: users (author) en taxonomies (category) hebben geen SEO-waarde. */
add_filter('wp_sitemaps_add_provider', 'mkb_sitemap_drop_noise_providers', 10, 2);
function mkb_sitemap_drop_noise_providers($provider, $name) {
    if (in_array($name, array('users', 'taxonomies'), true)) return false;
    return $provider;
}

/* Sluit specifieke pagina's/posts uit de sitemap uit (op slug -> ID, werkt op productie). */
add_filter('wp_sitemaps_posts_query_args', 'mkb_sitemap_exclude_junk', 10, 2);
function mkb_sitemap_exclude_junk($args, $post_type) {
    $exclude_slugs = array();
    if ($post_type === 'page') {
        $exclude_slugs = array('sample-page', 'privacy-2', 'privacy-policy');
    } elseif ($post_type === 'post') {
        $exclude_slugs = array('hello-world');
    }
    if (empty($exclude_slugs)) return $args;

    if (empty($args['post__not_in']) || !is_array($args['post__not_in'])) {
        $args['post__not_in'] = array();
    }
    foreach ($exclude_slugs as $slug) {
        $obj = get_page_by_path($slug, OBJECT, $post_type);
        if ($obj) $args['post__not_in'][] = $obj->ID;
    }
    return $args;
}

/* noindex voor de default "Hello world!"-post zolang die nog bestaat. */
add_filter('wp_robots', 'mkb_noindex_junk');
function mkb_noindex_junk($robots) {
    if (is_singular('post') && get_post_field('post_name', get_queried_object_id()) === 'hello-world') {
        $robots['noindex'] = true;
        unset($robots['index']);
    }
    return $robots;
}
