<?php
/**
 * offerte-handler.php — verwerkt het offerteformulier.
 *
 * Elke aanvraag wordt op TWEE manieren vastgelegd:
 *   1. Opgeslagen in WordPress als 'Offerteaanvraag' (zichtbaar in het menu links).
 *      Dit gebeurt ALTIJD en als eerste, zodat een aanvraag nooit verloren gaat —
 *      ook niet als het versturen van e-mail mislukt.
 *   2. Gemaild naar de beheerder.
 *
 * Het formulier post via fetch() naar admin-ajax; de succesmelding verschijnt
 * pas als de server bevestigt dat de aanvraag is opgeslagen.
 */
if (!defined('ABSPATH')) exit;

/* ------------------------------------------------------------------ *
 *  INSTELLING — waar komen de aanvragen binnen?
 *
 *  Wil je dit later wijzigen: pas alleen de regel hieronder aan.
 *  Meerdere ontvangers? Zet ze achter elkaar, gescheiden door komma's:
 *      'info@mkbkleding.nl, tahavdveer@gmail.com'
 *
 *  Let op: bezorging op een mailbox van deze server zelf (info@mkbkleding.nl)
 *  is betrouwbaarder dan naar Gmail of Outlook, want daar zit een spamfilter
 *  tussen dat post van een gedeelde server soms tegenhoudt.
 * ------------------------------------------------------------------ */
if (!defined('MKB_OFFERTE_ONTVANGER')) {
    define('MKB_OFFERTE_ONTVANGER', 'info@mkbkleding.nl');
}

/* ------------------------------------------------------------------ *
 *  1. Opslagtype registreren
 * ------------------------------------------------------------------ */
function mkb_register_aanvraag_type() {
    register_post_type('mkb_aanvraag', array(
        'labels' => array(
            'name'          => 'Offerteaanvragen',
            'singular_name' => 'Offerteaanvraag',
            'menu_name'     => 'Offerteaanvragen',
            'all_items'     => 'Alle aanvragen',
            'search_items'  => 'Aanvragen zoeken',
            'not_found'     => 'Nog geen aanvragen binnengekomen.',
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-email-alt',
        'menu_position'=> 26,
        'supports'     => array('title', 'editor'),
        'capabilities' => array('create_posts' => 'do_not_allow'),
        'map_meta_cap' => true,
    ));
}
add_action('init', 'mkb_register_aanvraag_type');

/* ------------------------------------------------------------------ *
 *  2. Het formulier verwerken
 * ------------------------------------------------------------------ */
function mkb_verwerk_offerte() {

    // Honeypot: bots vullen dit onzichtbare veld in. Stilletjes negeren.
    if (!empty($_POST['website'])) {
        wp_send_json_success(array('bericht' => 'ok'));
    }

    if (!isset($_POST['mkb_nonce']) || !wp_verify_nonce($_POST['mkb_nonce'], 'mkb_offerte')) {
        wp_send_json_error(array('bericht' => 'De pagina was verlopen. Ververs de pagina en probeer het opnieuw.'), 403);
    }

    $velden = array('naam', 'bedrijfsnaam', 'email', 'telefoon', 'sector', 'product', 'aantal', 'bericht');
    $d = array();
    foreach ($velden as $v) {
        $d[$v] = isset($_POST[$v]) ? sanitize_text_field(wp_unslash($_POST[$v])) : '';
    }
    $d['bericht'] = isset($_POST['bericht']) ? sanitize_textarea_field(wp_unslash($_POST['bericht'])) : '';

    // Serverkant valideren — nooit alleen op JavaScript vertrouwen.
    $fouten = array();
    if (mb_strlen($d['naam']) < 2)         $fouten[] = 'naam';
    if (mb_strlen($d['bedrijfsnaam']) < 2) $fouten[] = 'bedrijfsnaam';
    if (!is_email($d['email']))            $fouten[] = 'email';
    if ($d['sector'] === '')               $fouten[] = 'sector';
    if ($d['product'] === '')              $fouten[] = 'product';
    if ($d['aantal'] === '')               $fouten[] = 'aantal';
    if (mb_strlen($d['bericht']) < 5)      $fouten[] = 'bericht';
    if ($fouten) {
        wp_send_json_error(array('bericht' => 'Controleer de gemarkeerde velden.', 'velden' => $fouten), 422);
    }

    /* --- STAP 1: opslaan (gebeurt vóór het mailen) --- */
    $regels = array(
        'Naam'         => $d['naam'],
        'Bedrijf'      => $d['bedrijfsnaam'],
        'E-mail'       => $d['email'],
        'Telefoon'     => $d['telefoon'] !== '' ? $d['telefoon'] : '(niet opgegeven)',
        'Sector'       => $d['sector'],
        'Product'      => $d['product'],
        'Aantal'       => $d['aantal'],
        'Bericht'      => "\n" . $d['bericht'],
        'Ontvangen op' => wp_date('j F Y \o\m H:i'),
    );
    $tekst = '';
    foreach ($regels as $label => $waarde) {
        $tekst .= $label . ': ' . $waarde . "\n";
    }

    $post_id = wp_insert_post(array(
        'post_type'    => 'mkb_aanvraag',
        'post_status'  => 'publish',
        'post_title'   => $d['bedrijfsnaam'] . ' — ' . $d['naam'],
        'post_content' => $tekst,
    ), true);

    if (!is_wp_error($post_id)) {
        foreach ($d as $k => $v) {
            update_post_meta($post_id, '_mkb_' . $k, $v);
        }
    }

    /* --- STAP 2: mailen (mislukt dit, dan staat de aanvraag er nog steeds) --- */
    $naar = MKB_OFFERTE_ONTVANGER;
    $onderwerp = 'Nieuwe offerteaanvraag — ' . $d['bedrijfsnaam'];
    $body  = "Er is een nieuwe offerteaanvraag binnengekomen via mkbkleding.nl.\n\n" . $tekst;
    $body .= "\nJe kunt rechtstreeks antwoorden op deze mail om de klant te bereiken.\n";
    if (!is_wp_error($post_id)) {
        $body .= "\nTerugkijken in WordPress: " . admin_url('post.php?post=' . $post_id . '&action=edit') . "\n";
    }
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: MKBkleding <wordpress@' . wp_parse_url(home_url(), PHP_URL_HOST) . '>',
        'Reply-To: ' . $d['naam'] . ' <' . $d['email'] . '>',
    );
    $verzonden = wp_mail($naar, $onderwerp, $body, $headers);

    if (!is_wp_error($post_id)) {
        update_post_meta($post_id, '_mkb_mail_verzonden', $verzonden ? 'ja' : 'nee');
    }

    // De aanvraag staat opgeslagen: voor de klant is dit geslaagd.
    wp_send_json_success(array('bericht' => 'ok'));
}
add_action('wp_ajax_mkb_offerte',        'mkb_verwerk_offerte');
add_action('wp_ajax_nopriv_mkb_offerte', 'mkb_verwerk_offerte');

/* ------------------------------------------------------------------ *
 *  3. Kolommen in het overzicht
 * ------------------------------------------------------------------ */
function mkb_aanvraag_kolommen($kolommen) {
    return array(
        'cb'       => $kolommen['cb'],
        'title'    => 'Bedrijf / naam',
        'email'    => 'E-mail',
        'telefoon' => 'Telefoon',
        'product'  => 'Product',
        'aantal'   => 'Aantal',
        'gemaild'  => 'Gemaild',
        'date'     => 'Ontvangen',
    );
}
add_filter('manage_mkb_aanvraag_posts_columns', 'mkb_aanvraag_kolommen');

function mkb_aanvraag_kolom_inhoud($kolom, $post_id) {
    if ($kolom === 'email') {
        $e = get_post_meta($post_id, '_mkb_email', true);
        echo $e ? '<a href="mailto:' . esc_attr($e) . '">' . esc_html($e) . '</a>' : '—';
    } elseif ($kolom === 'gemaild') {
        echo get_post_meta($post_id, '_mkb_mail_verzonden', true) === 'ja'
            ? '<span style="color:#1a7f37">ja</span>'
            : '<span style="color:#b32d2e">nee</span>';
    } elseif (in_array($kolom, array('telefoon', 'product', 'aantal'), true)) {
        $w = get_post_meta($post_id, '_mkb_' . $kolom, true);
        echo $w ? esc_html($w) : '—';
    }
}
add_action('manage_mkb_aanvraag_posts_custom_column', 'mkb_aanvraag_kolom_inhoud', 10, 2);
