<?php
/**
 * producten.php — de producten op /diensten/, als één bewerkbare lijst.
 *
 * ---------------------------------------------------------------------------
 * EEN FOTO TOEVOEGEN
 * ---------------------------------------------------------------------------
 * Zet de foto in de map  assets/producten/  en vul de bestandsnaam in bij 'foto'.
 * Bijvoorbeeld:  'foto' => 'bedrijfs-t-shirts.jpg'
 * Zolang 'foto' leeg is, toont de kaart netjes het icoon; er breekt niets.
 * Vul bij 'foto_alt' kort in wat er op de foto staat (voor Google en voor
 * mensen die de site voorgelezen krijgen).
 *
 * ---------------------------------------------------------------------------
 * "GESCHIKT VOOR" — DIT ZIJN KNOPPEN
 * ---------------------------------------------------------------------------
 * Elk item onder 'geschikt' wordt een klikbare knop. Iedere knop MOET een
 * bestaande pagina als bestemming hebben, anders klikt een bezoeker zich stuk.
 * Bestemmingen die nu bestaan:
 *
 *   /blog/kleine-teams-geen-minimale-afname/   kleine aantallen, vanaf 1 stuk
 *   /blog/opdruktechniek-kiezen/               zeefdruk, borduren, transfer
 *   /blog/prijs-bedrukte-bedrijfskleding/      wat bepaalt de prijs
 *   /blog/eigen-kledingmerk-starten/           eigen merk starten
 *   /blog/clubkleding-jubileumkleding/         clubs en jubilea
 *   /bedrijfskleding-horeca/                   sectorpagina horeca
 *   /bedrijfskleding-kantoor/                  sectorpagina kantoor & MKB
 *   /bedrijfskleding-bedrijven/                sectorpagina bedrijven
 *   /clubkleding-verenigingen/                 sectorpagina clubs
 *   /eigen-kledingmerk-laten-maken/            sectorpagina private label
 *   /statiegeld/                               statiegeldsysteem
 *   /portfolio/                                ons werk
 *
 * Komt er een nieuw blogartikel bij? Zet de URL hier neer en de knop werkt.
 *
 */
if (!defined('ABSPATH')) exit;

function mkb_producten() {
    static $producten = null;
    if ($producten !== null) return $producten;

    $producten = array(

        /* ------------------------------------------------------------------ */
        array(
            'slug'     => 'bedrijfs-t-shirts',
            'naam'     => 'Bedrijfs-T-shirts',
            'icoon'    => 'fa-solid fa-shirt',
            'foto'     => '',
            'foto_alt' => 'Bedrijfs-T-shirts met bedrukt logo',
            'tekst'    => 'De klassieker. Verkrijgbaar in alle kleuren en maten, van eenvoudige basics tot premium kwaliteit. Snel te produceren en betaalbaar, ook voor kleinere aantallen.',
            'geschikt' => array(
                array('label' => 'Kleine teams', 'url' => '/blog/kleine-teams-geen-minimale-afname/'),
                array('label' => 'Bedrijven',    'url' => '/bedrijfskleding-bedrijven/'),
                array('label' => 'Horeca',       'url' => '/bedrijfskleding-horeca/'),
                array('label' => 'Sportclubs',   'url' => '/clubkleding-verenigingen/'),
                array('label' => 'Merchandise',  'url' => '/eigen-kledingmerk-laten-maken/'),
            ),
            'opdruk_label' => 'Opdruk',
            'opdruk'   => 'zeefdruk, borduurwerk, transferprint',
        ),

        /* ------------------------------------------------------------------ */
        array(
            'slug'     => 'polos-overhemden',
            'naam'     => 'Polo\'s &amp; overhemden',
            'icoon'    => 'fa-solid fa-user-tie',
            'foto'     => '',
            'foto_alt' => 'Bedrijfspolo\'s en overhemden met geborduurd logo',
            'tekst'    => 'Voor een professionele, representatieve uitstraling. Veelzijdig inzetbaar, van horeca en retail tot kantoor en buitendienst.',
            'geschikt' => array(
                array('label' => 'Horeca',            'url' => '/bedrijfskleding-horeca/'),
                array('label' => 'Kantoor & MKB', 'url' => '/bedrijfskleding-kantoor/'),
                array('label' => 'Retail',            'url' => '/bedrijfskleding-bedrijven/'),
                array('label' => 'Kleine teams',      'url' => '/blog/kleine-teams-geen-minimale-afname/'),
                array('label' => 'Clubbestuur',       'url' => '/clubkleding-verenigingen/'),
            ),
            'opdruk_label' => 'Opdruk',
            'opdruk'   => 'borduurwerk, zeefdruk',
        ),

        /* ------------------------------------------------------------------ */
        array(
            'slug'     => 'hoodies-sweaters',
            'naam'     => 'Hoodies &amp; sweaters',
            'icoon'    => 'fa-solid fa-vest-patches',
            'foto'     => '',
            'foto_alt' => 'Hoodies en sweaters met bedrijfslogo',
            'tekst'    => 'Van basic modellen tot premium hoodies en crewnecks. Ideaal voor teamkleding, merchandise of als geschenk voor medewerkers en klanten.',
            'geschikt' => array(
                array('label' => 'Teamkleding',       'url' => '/bedrijfskleding-kantoor/'),
                array('label' => 'Merchandise',       'url' => '/eigen-kledingmerk-laten-maken/'),
                array('label' => 'Sportclubs',        'url' => '/clubkleding-verenigingen/'),
                array('label' => 'Jubilea',           'url' => '/blog/clubkleding-jubileumkleding/'),
                array('label' => 'Eigen kledingmerk', 'url' => '/blog/eigen-kledingmerk-starten/'),
            ),
            'opdruk_label' => 'Opdruk',
            'opdruk'   => 'zeefdruk, transferprint, borduurwerk',
        ),

        /* ------------------------------------------------------------------ */
        array(
            'slug'     => 'eigen-kledingmerk',
            'naam'     => 'Je eigen kledingmerk',
            'icoon'    => 'fa-solid fa-tags',
            'foto'     => '',
            'foto_alt' => 'Eigen kledingmerk met eigen was- en merklabels',
            'tekst'    => 'Private label vanaf de stof: wij snijden, naaien, bedrukken en werken af met je eigen labels. Van eerste sample tot een complete collectie &mdash; jouw merk, onze productie.',
            'geschikt' => array(
                array('label' => 'Startende merken',     'url' => '/blog/eigen-kledingmerk-starten/'),
                array('label' => 'Private label',        'url' => '/eigen-kledingmerk-laten-maken/'),
                array('label' => 'Streetwear',           'url' => '/portfolio/'),
                array('label' => 'Clubs met eigen lijn', 'url' => '/clubkleding-verenigingen/'),
                array('label' => 'Bedrijfsmerchandise',  'url' => '/bedrijfskleding-bedrijven/'),
            ),
            'opdruk_label' => 'Techniek',
            'opdruk'   => 'cut-and-sew, eigen was- en merklabels, alle opdruktechnieken',
        ),

        /* ------------------------------------------------------------------ */
        array(
            'slug'     => 'jubileumkleding',
            'naam'     => 'Jubileumkleding',
            'icoon'    => 'fa-solid fa-medal',
            'foto'     => '',
            'foto_alt' => 'Jubileumkleding met clubkleuren, jaartal en logo',
            'tekst'    => 'Limited-edition hoodies en shirts voor jubilea. 25, 50 of 100 jaar: wij maken er iets unieks van met clubkleuren, jaartal en logo. Voor sportclubs, verenigingen en bedrijven.',
            'geschikt' => array(
                array('label' => 'Sportclubs',            'url' => '/clubkleding-verenigingen/'),
                array('label' => 'Verenigingen',          'url' => '/blog/clubkleding-jubileumkleding/'),
                array('label' => 'Bedrijfsjubilea',       'url' => '/bedrijfskleding-bedrijven/'),
                array('label' => 'Personeel & teams', 'url' => '/bedrijfskleding-kantoor/'),
            ),
            'opdruk_label' => 'Opdruk',
            'opdruk'   => 'zeefdruk, borduurwerk, sublimatie',
        ),

    );

    return $producten;
}
