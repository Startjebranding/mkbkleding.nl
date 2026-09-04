<?php
/**
 * retour-handler.php — verwerkt aanmeldingen voor statiegeldretour.
 *
 * Werkt precies zoals offerte-handler.php:
 *   1. Elke aanmelding wordt ALTIJD eerst opgeslagen in WordPress als
 *      'Retouraanmelding' (zichtbaar in het menu links), zodat een aanmelding
 *      nooit verloren gaat — ook niet als het mailen mislukt.
 *   2. Daarna wordt hij gemaild naar de beheerder.
 *
 * Het formulier post via fetch() naar admin-ajax; de succesmelding verschijnt
 * pas als de server bevestigt dat de aanmelding is opgeslagen.
 */
if (!defined('ABSPATH')) exit;

/* ------------------------------------------------------------------ *
 *  INSTELLING — waar komen de aanmeldingen binnen?
 *  Standaard hetzelfde adres als de offerteaanvragen.
 * ------------------------------------------------------------------ */
if (!defined('MKB_RETOUR_ONTVANGER')) {
    define('MKB_RETOUR_ONTVANGER', defined('MKB_OFFERTE_ONTVANGER') ? MKB_OFFERTE_ONTVANGER : 'info@mkbkleding.nl');
}

/* ------------------------------------------------------------------ *
 *  1. Opslagtype registreren
 * ------------------------------------------------------------------ */
function mkb_register_retour_type() {
    register_post_type('mkb_retour', array(
        'labels' => array(
            'name'          => 'Retouraanmeldingen',
            'singular_name' => 'Retouraanmelding',
            'menu_name'     => 'Retouraanmeldingen',
            'all_items'     => 'Alle aanmeldingen',
            'search_items'  => 'Aanmeldingen zoeken',
            'not_found'     => 'Nog geen retouraanmeldingen binnengekomen.',
        ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-image-rotate',
        'menu_position' => 27,
        'supports'      => array('title', 'editor'),
        'capabilities'  => array('create_posts' => 'do_not_allow'),
        'map_meta_cap'  => true,
    ));
}
add_action('init', 'mkb_register_retour_type');

/* ------------------------------------------------------------------ *
 *  2. Het formulier verwerken
 * ------------------------------------------------------------------ */
function mkb_verwerk_retour() {

    // Honeypot: bots vullen dit onzichtbare veld in. Stilletjes negeren.
    if (!empty($_POST['website'])) {
        wp_send_json_success(array('bericht' => 'ok'));
    }

    if (!isset($_POST['mkb_nonce']) || !wp_verify_nonce($_POST['mkb_nonce'], 'mkb_retour')) {
        wp_send_json_error(array('bericht' => 'De pagina was verlopen. Ververs de pagina en probeer het opnieuw.'), 403);
    }

    $velden = array('naam', 'bedrijfsnaam', 'email', 'telefoon', 'ordernummer', 'aantal', 'producttype', 'staat', 'methode');
    $d = array();
    foreach ($velden as $v) {
        $d[$v] = isset($_POST[$v]) ? sanitize_text_field(wp_unslash($_POST[$v])) : '';
    }
    $d['toelichting'] = isset($_POST['toelichting']) ? sanitize_textarea_field(wp_unslash($_POST['toelichting'])) : '';

    // Serverkant valideren — nooit alleen op JavaScript vertrouwen.
    $fouten = array();
    if (mb_strlen($d['naam']) < 2)              $fouten[] = 'naam';
    if (mb_strlen($d['bedrijfsnaam']) < 2)      $fouten[] = 'bedrijfsnaam';
    if (!is_email($d['email']))                 $fouten[] = 'email';
    if ((int) $d['aantal'] < 1)                 $fouten[] = 'aantal';
    if ($d['producttype'] === '')               $fouten[] = 'producttype';
    if ($d['staat'] === '')                     $fouten[] = 'staat';
    if ($fouten) {
        wp_send_json_error(array('bericht' => 'Controleer de gemarkeerde velden.', 'velden' => $fouten), 422);
    }

    /* --- STAP 1: opslaan (gebeurt vóór het mailen) --- */
    $regels = array(
        'Naam'             => $d['naam'],
        'Bedrijf'          => $d['bedrijfsnaam'],
        'E-mail'           => $d['email'],
        'Telefoon'         => $d['telefoon'] !== '' ? $d['telefoon'] : '(niet opgegeven)',
        'Ordernummer'      => $d['ordernummer'] !== '' ? $d['ordernummer'] : '(niet opgegeven)',
        'Aantal stuks'     => $d['aantal'],
        'Soort kleding'    => $d['producttype'],
        'Staat'            => $d['staat'],
        'Ophalen/opsturen' => $d['methode'] !== '' ? $d['methode'] : '(geen voorkeur)',
        'Toelichting'      => "\n" . ($d['toelichting'] !== '' ? $d['toelichting'] : '(geen)'),
        'Ontvangen op'     => wp_date('j F Y \o\m H:i'),
    );
    $tekst = '';
    foreach ($regels as $label => $waarde) {
        $tekst .= $label . ': ' . $waarde . "\n";
    }

    $post_id = wp_insert_post(array(
        'post_type'    => 'mkb_retour',
        'post_status'  => 'publish',
        'post_title'   => $d['bedrijfsnaam'] . ' — ' . $d['aantal'] . ' stuks',
        'post_content' => $tekst,
    ), true);

    if (!is_wp_error($post_id)) {
        foreach ($d as $k => $v) {
            update_post_meta($post_id, '_mkb_' . $k, $v);
        }
    }

    /* --- STAP 2: mailen (mislukt dit, dan staat de aanmelding er nog steeds) --- */
    $onderwerp = 'Statiegeldretour aangemeld — ' . $d['bedrijfsnaam'];
    $body  = "Er is een nieuwe statiegeldretour aangemeld via mkbkleding.nl.\n\n" . $tekst;
    $body .= "\nJe kunt rechtstreeks antwoorden op deze mail om de klant te bereiken.\n";
    if (!is_wp_error($post_id)) {
        $body .= "\nTerugkijken in WordPress: " . admin_url('post.php?post=' . $post_id . '&action=edit') . "\n";
    }
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: MKBkleding <wordpress@' . wp_parse_url(home_url(), PHP_URL_HOST) . '>',
        'Reply-To: ' . $d['naam'] . ' <' . $d['email'] . '>',
    );
    $verzonden = wp_mail(MKB_RETOUR_ONTVANGER, $onderwerp, $body, $headers);

    if (!is_wp_error($post_id)) {
        update_post_meta($post_id, '_mkb_mail_verzonden', $verzonden ? 'ja' : 'nee');
    }

    // De aanmelding staat opgeslagen: voor de klant is dit geslaagd.
    wp_send_json_success(array('bericht' => 'ok'));
}
add_action('wp_ajax_mkb_retour',        'mkb_verwerk_retour');
add_action('wp_ajax_nopriv_mkb_retour', 'mkb_verwerk_retour');

/* ------------------------------------------------------------------ *
 *  3. Kolommen in het overzicht
 * ------------------------------------------------------------------ */
function mkb_retour_kolommen($kolommen) {
    return array(
        'cb'          => $kolommen['cb'],
        'title'       => 'Bedrijf / aantal',
        'email'       => 'E-mail',
        'telefoon'    => 'Telefoon',
        'producttype' => 'Soort kleding',
        'staat'       => 'Staat',
        'methode'     => 'Ophalen',
        'gemaild'     => 'Gemaild',
        'date'        => 'Ontvangen',
    );
}
add_filter('manage_mkb_retour_posts_columns', 'mkb_retour_kolommen');

function mkb_retour_kolom_inhoud($kolom, $post_id) {
    if ($kolom === 'email') {
        $e = get_post_meta($post_id, '_mkb_email', true);
        echo $e ? '<a href="mailto:' . esc_attr($e) . '">' . esc_html($e) . '</a>' : '—';
    } elseif ($kolom === 'gemaild') {
        echo get_post_meta($post_id, '_mkb_mail_verzonden', true) === 'ja'
            ? '<span style="color:#1a7f37">ja</span>'
            : '<span style="color:#b32d2e">nee</span>';
    } elseif (in_array($kolom, array('telefoon', 'producttype', 'staat', 'methode'), true)) {
        $w = get_post_meta($post_id, '_mkb_' . $kolom, true);
        echo $w ? esc_html($w) : '—';
    }
}
add_action('manage_mkb_retour_posts_custom_column', 'mkb_retour_kolom_inhoud', 10, 2);
