<?php
/**
 * seo.php — centrale SEO-head-laag voor mkbkleding.nl
 *
 * Levert per pagina één bron van waarheid voor:
 *   - <title> (via pre_get_document_title)
 *   - meta description
 *   - canonical (absoluut, https, non-www — afgeleid van home_url())
 *   - Open Graph + Twitter Card
 *   - JSON-LD schema (LocalBusiness altijd; Breadcrumb op subpagina's;
 *     Service op /diensten/ + sectorpagina's; Review op /portfolio/;
 *     Article + FAQPage op blogartikelen; FAQPage op de homepage)
 *
 * De WordPress-siteurl moet op productie op https://mkbkleding.nl (non-www)
 * staan; daar leunt home_url() op zodat canonical/sitemap/redirect één variant
 * gebruiken.
 */
if (!defined('ABSPATH')) exit;

/* Eén canonical per pagina: WP-core canonical eruit, wij regelen het zelf. */
remove_action('wp_head', 'rel_canonical');

/* ------------------------------------------------------------------ *
 *  Helpers
 * ------------------------------------------------------------------ */

/** Tags strippen + HTML-entiteiten terug naar echte tekens (meta/JSON-LD). */
function mkb_plain_text($s) {
    return trim(html_entity_decode(wp_strip_all_tags($s), ENT_QUOTES, 'UTF-8'));
}

/** Forceer https + non-www op een absolute URL. */
function mkb_canonicalize($url) {
    $url = set_url_scheme($url, 'https');
    return preg_replace('#^(https://)www\.#i', '$1', $url);
}

/** @id van het bedrijf, hergebruikt door alle schema-nodes. */
function mkb_business_id() {
    return mkb_canonicalize(home_url('/#business'));
}

/** Absoluut logo (SVG). */
function mkb_logo_url() {
    return mkb_canonicalize(get_template_directory_uri() . '/assets/logo.svg');
}

/** Absolute, echte rasterafbeelding op de site (voor og:image + schema image). */
function mkb_image_url() {
    return mkb_canonicalize(get_template_directory_uri() . '/assets/portfolio/geerlings-benard-1.jpg');
}

/* ------------------------------------------------------------------ *
 *  Welke pagina is dit?
 * ------------------------------------------------------------------ */

/**
 * Interne pagina-id voor de SEO-registry.
 * Virtuele pagina's zetten $GLOBALS['mkb_virtual_page'] (zie virtual-pages.php).
 */
function mkb_current_page_id() {
    if (!empty($GLOBALS['mkb_virtual_page'])) return 'virtual';
    if (mkb_current_article())                return 'article';
    if (is_front_page())                      return 'home';
    if (is_home())                            return 'blog';
    if (is_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
        return $slug ? $slug : 'page';
    }
    return '';
}

/**
 * Title + description + og_type voor de huidige pagina.
 */
function mkb_seo_meta() {
    // Blogartikel
    if ($a = mkb_current_article()) {
        return array(
            'title'   => mkb_plain_text($a['titel']) . ' | MKBkleding',
            'desc'    => mkb_plain_text($a['meta']),
            'og_type' => 'article',
        );
    }
    // Virtuele (sector)pagina levert eigen title/desc
    if (!empty($GLOBALS['mkb_virtual_page'])) {
        $vp = $GLOBALS['mkb_virtual_page'];
        return array(
            'title'   => $vp['title'],
            'desc'    => $vp['desc'],
            'og_type' => 'website',
        );
    }
    $reg = mkb_seo_registry();
    $id  = mkb_current_page_id();
    if (isset($reg[$id])) {
        return array(
            'title'   => $reg[$id]['title'],
            'desc'    => $reg[$id]['desc'],
            'og_type' => 'website',
        );
    }
    return array('title' => '', 'desc' => '', 'og_type' => 'website');
}

/** Vaste titels + meta descriptions per bestaande pagina. */
function mkb_seo_registry() {
    return array(
        'home' => array(
            'title' => 'Gepersonaliseerde bedrijfskleding met logo | MKBkleding',
            'desc'  => 'Bedrijfskleding met logo voor het MKB: bedrukte werkkleding, clubkleding en je eigen kledingmerk. Geen minimale afname. Vraag vrijblijvend een offerte aan.',
        ),
        'diensten' => array(
            'title' => 'Bedrukte werkkleding & clubkleding op maat | MKBkleding',
            'desc'  => 'Bedrukte werkkleding, polo\'s, hoodies, clubkleding en private label kledingmerken met jouw logo. Geen minimale afname. Vraag een vrijblijvende offerte aan.',
        ),
        'portfolio' => array(
            'title' => 'Portfolio bedrijfskleding & klantervaring | MKBkleding',
            'desc'  => 'Bekijk het werk van MKBkleding en lees de ervaring van een klant met onze bedrukte bedrijfskleding. Benieuwd wat we voor jou maken? Vraag een offerte aan.',
        ),
        'blog' => array(
            'title' => 'Blog: bedrijfskleding met logo & eigen merk | MKBkleding',
            'desc'  => 'Tips en advies over bedrijfskleding met logo, opdruktechnieken, prijzen en je eigen kledingmerk starten. Direct kleding nodig? Vraag een offerte aan.',
        ),
        'over-ons' => array(
            'title' => 'Bedrijfskleding voor het MKB uit Rotterdam | MKBkleding',
            'desc'  => 'Maak kennis met MKBkleding uit Rotterdam: bedrijfskleding met logo voor het MKB, persoonlijk advies en korte lijnen. Vraag vrijblijvend een offerte aan.',
        ),
        'contact' => array(
            'title' => 'Contact bedrijfskleding met logo | MKBkleding',
            'desc'  => 'Vragen over bedrijfskleding met logo of een lopende order? Bel 06 87 51 59 29 of mail ons — we reageren binnen 1 werkdag. Of vraag direct een offerte aan.',
        ),
        'statiegeld' => array(
            'title' => 'Statiegeld op bedrijfskleding — geld terug | MKBkleding',
            'desc'  => 'Statiegeld op je bedrijfskleding: je krijgt het bedrag volledig terug zodra je de kleding inlevert. Wij regelen per kledingstuk hergebruik of recycling.',
        ),
        'offerte' => array(
            'title' => 'Offerte bedrijfskleding met logo aanvragen | MKBkleding',
            'desc'  => 'Vraag een gratis, vrijblijvende offerte aan voor bedrijfskleding met logo. Vertel wat je zoekt; we reageren binnen 1 werkdag met een voorstel op maat.',
        ),
        'privacy' => array(
            'title' => 'Privacyverklaring | MKBkleding',
            'desc'  => 'Lees hoe MKBkleding omgaat met je persoonsgegevens bij een offerteaanvraag of contact. Vragen over je privacy? Neem gerust contact met ons op.',
        ),
        'voorwaarden' => array(
            'title' => 'Algemene voorwaarden | MKBkleding',
            'desc'  => 'Algemene voorwaarden van MKBkleding voor bedrijfskleding, bedrukte werkkleding en private label kledingmerken met logo. Lees ze rustig door.',
        ),
    );
}

/**
 * Canonical-URL van de huidige pagina (absoluut, https, non-www).
 */
function mkb_seo_canonical() {
    if ($a = mkb_current_article()) {
        $url = home_url('/blog/' . $a['slug'] . '/');
    } elseif (!empty($GLOBALS['mkb_virtual_page'])) {
        $url = home_url('/' . $GLOBALS['mkb_virtual_page']['slug'] . '/');
    } elseif (is_front_page()) {
        $url = home_url('/');
    } elseif (is_home()) {
        $pid = get_option('page_for_posts');
        $url = $pid ? get_permalink($pid) : home_url('/blog/');
    } elseif (is_page() || is_singular()) {
        $url = get_permalink();
    } else {
        $req = isset($GLOBALS['wp']->request) ? $GLOBALS['wp']->request : '';
        $url = home_url($req ? '/' . $req . '/' : '/');
    }
    return mkb_canonicalize($url);
}

/* ------------------------------------------------------------------ *
 *  <title>
 * ------------------------------------------------------------------ */
add_filter('pre_get_document_title', 'mkb_seo_document_title', 20);
function mkb_seo_document_title($title) {
    $m = mkb_seo_meta();
    return !empty($m['title']) ? $m['title'] : $title;
}

/* ------------------------------------------------------------------ *
 *  Meta description + canonical + Open Graph + Twitter
 * ------------------------------------------------------------------ */
add_action('wp_head', 'mkb_seo_head_meta', 1);
function mkb_seo_head_meta() {
    $m     = mkb_seo_meta();
    $canon = mkb_seo_canonical();
    $title = !empty($m['title']) ? $m['title'] : wp_get_document_title();
    $img   = mkb_image_url();

    echo '<link rel="canonical" href="' . esc_url($canon) . '">' . "\n";
    if (!empty($m['desc'])) {
        echo '<meta name="description" content="' . esc_attr($m['desc']) . '">' . "\n";
    }

    // Open Graph
    echo '<meta property="og:type" content="' . esc_attr($m['og_type']) . '">' . "\n";
    echo '<meta property="og:site_name" content="MKBkleding">' . "\n";
    echo '<meta property="og:locale" content="nl_NL">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    if (!empty($m['desc'])) {
        echo '<meta property="og:description" content="' . esc_attr($m['desc']) . '">' . "\n";
    }
    echo '<meta property="og:url" content="' . esc_url($canon) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    if (!empty($m['desc'])) {
        echo '<meta name="twitter:description" content="' . esc_attr($m['desc']) . '">' . "\n";
    }
    echo '<meta name="twitter:image" content="' . esc_url($img) . '">' . "\n";
}

/* ------------------------------------------------------------------ *
 *  JSON-LD schema (gebundeld in één @graph)
 * ------------------------------------------------------------------ */
add_action('wp_head', 'mkb_seo_schema', 5);
function mkb_seo_schema() {
    $graph = array();

    $graph[] = mkb_schema_localbusiness();

    if (!is_front_page()) {
        $bc = mkb_schema_breadcrumb();
        if ($bc) $graph[] = $bc;
    }

    // Blogartikel: Article (+ FAQ als aanwezig)
    if ($a = mkb_current_article()) {
        $graph[] = mkb_schema_article($a);
        if (!empty($a['faqs'])) $graph[] = mkb_schema_faq($a['faqs']);
    }

    // Homepage: FAQPage op basis van de zichtbare FAQ
    if (is_front_page() && function_exists('mkb_home_faqs')) {
        $graph[] = mkb_schema_faq(mkb_home_faqs());
    }

    // Diensten + sectorpagina's: Service
    $id = mkb_current_page_id();
    if ($id === 'diensten' || !empty($GLOBALS['mkb_virtual_page'])) {
        $graph[] = mkb_schema_service();
    }

    // Statiegeldpagina: eigen Service + FAQPage
    if ($id === 'statiegeld') {
        $graph[] = mkb_schema_statiegeld_service();
        $graph[] = mkb_schema_faq(mkb_statiegeld_faqs());
    }

    // Sectorpagina met eigen FAQ: FAQPage
    if (!empty($GLOBALS['mkb_virtual_page']['faqs'])) {
        $graph[] = mkb_schema_faq($GLOBALS['mkb_virtual_page']['faqs']);
    }

    // Portfolio: de ene echte review
    if ($id === 'portfolio') {
        $graph[] = mkb_schema_review();
    }

    echo '<script type="application/ld+json">'
        . wp_json_encode(array('@context' => 'https://schema.org', '@graph' => $graph), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>' . "\n";
}

function mkb_schema_localbusiness() {
    return array(
        '@type'      => 'LocalBusiness',
        '@id'        => mkb_business_id(),
        'name'       => 'MKBkleding',
        'url'        => mkb_canonicalize(home_url('/')),
        'logo'       => mkb_logo_url(),
        'image'      => mkb_image_url(),
        'telephone'  => '+31687515929',
        'email'      => 'info@mkbkleding.nl',
        'address'    => array(
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Rotterdam',
            'addressCountry'  => 'NL',
        ),
        'areaServed' => array('@type' => 'Country', 'name' => 'Netherlands'),
        'identifier' => array('@type' => 'PropertyValue', 'name' => 'KVK', 'value' => '95798137'),
    );
}

function mkb_schema_breadcrumb() {
    $items = array(array('name' => 'Home', 'url' => mkb_canonicalize(home_url('/'))));

    if ($a = mkb_current_article()) {
        $items[] = array('name' => 'Blog', 'url' => mkb_canonicalize(home_url('/blog/')));
        $items[] = array('name' => mkb_plain_text($a['titel']), 'url' => mkb_seo_canonical());
    } elseif (!empty($GLOBALS['mkb_virtual_page'])) {
        $vp = $GLOBALS['mkb_virtual_page'];
        $items[] = array('name' => 'Diensten', 'url' => mkb_canonicalize(home_url('/diensten/')));
        $items[] = array('name' => $vp['crumb'], 'url' => mkb_seo_canonical());
    } elseif (is_home()) {
        $items[] = array('name' => 'Blog', 'url' => mkb_seo_canonical());
    } elseif (is_page()) {
        $items[] = array('name' => get_the_title(get_queried_object_id()), 'url' => mkb_seo_canonical());
    } else {
        return null;
    }

    $elements = array();
    foreach ($items as $i => $it) {
        $elements[] = array(
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $it['name'],
            'item'     => $it['url'],
        );
    }
    return array('@type' => 'BreadcrumbList', 'itemListElement' => $elements);
}

function mkb_schema_article($a) {
    return array(
        '@type'            => 'Article',
        'headline'         => mkb_plain_text($a['titel']),
        'description'      => mkb_plain_text($a['meta']),
        'datePublished'    => $a['datum_iso'],
        'dateModified'     => $a['datum_iso'],
        'inLanguage'       => 'nl-NL',
        'author'           => array('@type' => 'Organization', 'name' => 'MKBkleding', '@id' => mkb_business_id()),
        'publisher'        => array('@id' => mkb_business_id()),
        'mainEntityOfPage' => mkb_seo_canonical(),
        'image'            => mkb_image_url(),
    );
}

function mkb_schema_faq($faqs) {
    $entities = array();
    foreach ($faqs as $f) {
        $entities[] = array(
            '@type'          => 'Question',
            'name'           => mkb_plain_text($f['v']),
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => mkb_plain_text($f['a'])),
        );
    }
    return array('@type' => 'FAQPage', 'mainEntity' => $entities);
}

function mkb_schema_service() {
    $diensten = array(
        'Bedrijfskleding met logo laten bedrukken',
        'Bedrukte werkkleding, polo\'s en hoodies',
        'Borduren en opdruk van bedrijfskleding',
        'Eigen kledingmerk laten maken (private label)',
        'Clubkleding en teamkleding op maat',
        'Jubileumkleding voor clubs en bedrijven',
    );
    $offers = array();
    foreach ($diensten as $d) {
        $offers[] = array('@type' => 'Offer', 'itemOffered' => array('@type' => 'Service', 'name' => $d));
    }
    return array(
        '@type'          => 'Service',
        'serviceType'    => 'Bedrijfskleding en textielbedrukking',
        'provider'       => array('@id' => mkb_business_id()),
        'areaServed'     => array('@type' => 'Country', 'name' => 'Netherlands'),
        'hasOfferCatalog'=> array(
            '@type'           => 'OfferCatalog',
            'name'            => 'Diensten MKBkleding',
            'itemListElement' => $offers,
        ),
    );
}

/**
 * De zichtbare homepage-FAQ (één bron voor de <details>-lijst én de FAQPage
 * JSON-LD). Antwoorden mogen HTML (links) bevatten; voor JSON-LD wordt gestript.
 */
function mkb_home_faqs() {
    return array(
        array(
            'v' => 'Is er een minimale afname?',
            'a' => 'Nee, helemaal niet. Je kunt al vanaf 1 stuk bestellen. Daarmee zijn we ook geschikt voor kleine teams, verenigingen en startende ondernemers.',
        ),
        array(
            'v' => 'Hoe snel krijg ik antwoord op mijn aanvraag?',
            'a' => 'We reageren binnen 1 werkdag op je aanvraag. Liever direct contact? Bel ons gerust op <a href="tel:+31687515929" style="color:var(--rose-deep)">06 87 51 59 29</a>.',
        ),
        array(
            'v' => 'Wat is dat statiegeld op bedrijfskleding?',
            'a' => 'Je betaalt per kledingstuk een klein bedrag bovenop de prijs en krijgt dat volledig terug zodra je de kleding bij ons inlevert. Wij zorgen dan voor hergebruik of recycling, afhankelijk van de staat van de kleding. Lees er alles over op onze <a href="/statiegeld/" style="color:var(--rose-deep)">statiegeldpagina</a>.',
        ),
        array(
            'v' => 'Hoe snel wordt mijn bestelling geleverd?',
            'a' => 'De levertijd hangt af van het product, de aantallen en de gekozen opdruktechniek. Na goedkeuring van het ontwerp gaan we direct voor je aan de slag; de exacte levertijd vermelden we altijd in je offerte.',
        ),
        array(
            'v' => 'Welke opdruktechnieken gebruiken jullie?',
            'a' => 'Zeefdruk, borduurwerk en transferprint. Voor full-colour ontwerpen ook sublimatie. Wij adviseren welke techniek het beste past bij jouw logo, kleding en aantallen. Lees ons <a href="/blog/opdruktechniek-kiezen/" style="color:var(--rose-deep)">artikel over opdruktechnieken</a>.',
        ),
        array(
            'v' => 'Kan ik het ontwerp eerst zien voordat jullie produceren?',
            'a' => 'Ja, altijd. Je ontvangt eerst een digitaal ontwerp ter goedkeuring. We gaan pas in productie als jij volledig akkoord bent.',
        ),
        array(
            'v' => 'Wat kost bedrijfskleding met logo?',
            'a' => 'Dat hangt af van het product, de aantallen en de opdruktechniek. Vraag een vrijblijvende offerte aan; we reageren binnen 1 werkdag. Lees ook ons <a href="/blog/prijs-bedrukte-bedrijfskleding/" style="color:var(--rose-deep)">artikel over de prijs van bedrukte kleding</a>.',
        ),
        array(
            'v' => 'Kan ik ook mijn eigen kledingmerk laten maken?',
            'a' => 'Ja. Naast bedrukte kleding maken we private label vanaf de stof: snijden, naaien en afwerken met je eigen was- en merklabels. Lees meer over <a href="/blog/eigen-kledingmerk-starten/" style="color:var(--rose-deep)">je eigen kledingmerk starten</a>.',
        ),
        array(
            'v' => 'Leveren jullie ook clubkleding en jubileumkleding?',
            'a' => 'Ja. We maken teamkleding, supporterskleding en limited-edition jubileumhoodies voor sportclubs en verenigingen — ook in kleine aantallen. Bekijk de <a href="/clubkleding-verenigingen/" style="color:var(--rose-deep)">mogelijkheden voor sportclubs en verenigingen</a>.',
        ),
        array(
            'v' => 'Hoe weet ik welke maten ik nodig heb?',
            'a' => 'We helpen je met maatadvies en een maattabel. Omdat er geen minimale afname is, kun je vooraf een enkel exemplaar laten maken om de pasvorm te beoordelen voordat je de hele bestelling plaatst.',
        ),
        array(
            'v' => 'Kan ik bedrukte kleding ruilen of retourneren?',
            'a' => 'Kleding met jouw logo wordt op maat voor je gemaakt en valt daarom onder maatwerk; dat kunnen we niet zomaar terugnemen. Juist daarom werken we met een ontwerp ter goedkeuring en maatadvies vooraf. Gaat er onverhoopt iets mis aan onze kant, dan lossen we dat uiteraard netjes voor je op.',
        ),
    );
}

/**
 * Statiegeld als eigen dienst in schema.
 */
function mkb_schema_statiegeld_service() {
    return array(
        '@type'       => 'Service',
        'name'        => 'Statiegeld op bedrijfskleding',
        'serviceType' => 'Retour- en recyclingsysteem voor bedrijfskleding',
        'provider'    => array('@id' => mkb_business_id()),
        'areaServed'  => array('@type' => 'Country', 'name' => 'Netherlands'),
        'description' => 'Klanten betalen een statiegeldbedrag per kledingstuk en krijgen dat volledig terug wanneer zij de kleding inleveren. MKBkleding zorgt per kledingstuk voor hergebruik, vezelrecycling of downcycling, afhankelijk van de staat van de kleding.',
    );
}

/**
 * De zichtbare FAQ op de statiegeldpagina (één bron voor de <details>-lijst
 * én de FAQPage JSON-LD). Antwoorden mogen HTML (links) bevatten.
 */
function mkb_statiegeld_faqs() {
    return array(
        array(
            'v' => 'Wat is statiegeld op bedrijfskleding precies?',
            'a' => 'Je betaalt per kledingstuk een klein bedrag bovenop de prijs. Lever je de kleding later bij ons in, dan krijg je dat bedrag volledig terug. Zo blijft de kleding in de kringloop in plaats van bij het restafval.',
        ),
        array(
            'v' => 'Krijg ik het statiegeld ook terug als de kleding versleten is?',
            'a' => 'Ja. Het statiegeld is een vergoeding voor het inleveren, niet voor de staat van de kleding. Versleten kleding is voor ons juist waardevol als grondstof. Alleen kleding die doorweekt is van chemie, olie of medisch afval kunnen wij niet aannemen.',
        ),
        array(
            'v' => 'Moet ik de kleding zelf opsturen?',
            'a' => 'Nee. Vanaf 10 stuks halen wij de kleding gratis bij je op. Bij kleinere aantallen ontvang je van ons een verzendlabel, zodat je het gewoon bij een pakketpunt kunt afgeven.',
        ),
        array(
            'v' => 'Hoe krijg ik het statiegeld uitbetaald?',
            'a' => 'Je kiest zelf: als tegoed op je volgende bestelling, of als uitbetaling op je rekening. Je ontvangt altijd een creditnota, zodat het netjes in je administratie past.',
        ),
        array(
            'v' => 'Moet het logo eraf voordat ik inlever?',
            'a' => 'Nee, dat hoef je niet te doen. Wij verwijderen bedrijfslogo\'s of maken ze onherkenbaar voordat kleding een tweede leven krijgt. Zo loopt niemand anders rond met jouw bedrijfsnaam erop.',
        ),
        array(
            'v' => 'Moet ik de kleding wassen voordat ik hem inlevert?',
            'a' => 'Schoon en droog is prettig, maar geen eis. Belangrijk is alleen dat er geen natte of chemisch verzadigde kleding tussen zit, omdat de rest van de partij daaronder lijdt.',
        ),
        array(
            'v' => 'Zit er een termijn op het inleveren?',
            'a' => 'Nee, je hoeft je niet te haasten. Draag de kleding zolang die meegaat. Bewaar wel je factuur of ordernummer, dan gaat het terugbetalen het snelst.',
        ),
        array(
            'v' => 'Geldt het statiegeld ook op kleding die ik eerder bij jullie kocht?',
            'a' => 'Op eerdere bestellingen is geen statiegeld betaald, dus daar kunnen wij het niet over uitkeren. Je mag die kleding wel gratis bij ons inleveren, zodat wij ook daarvoor de juiste verwerking regelen.',
        ),
    );
}

/**
 * De ene echte, goedgekeurde klantreview (spiegelt data/reviews-data.js).
 * Géén aggregateRating — dat is er niet en zou misleidend zijn.
 */
function mkb_schema_review() {
    return array(
        '@type'         => 'Review',
        'itemReviewed'  => array('@id' => mkb_business_id()),
        'author'        => array('@type' => 'Person', 'name' => 'Pieter Benard'),
        'datePublished' => '2026-06-16',
        'reviewRating'  => array('@type' => 'Rating', 'ratingValue' => '5', 'bestRating' => '5', 'worstRating' => '1'),
        'reviewBody'    => 'Zeer tevreden over de levering van de shirts, goede klantgerichte communicatie en service! Ook de kwaliteit van de shirts is erg goed. De "feel" is zeer degelijk.',
    );
}
