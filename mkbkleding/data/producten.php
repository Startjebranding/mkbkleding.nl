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
 * ---------------------------------------------------------------------------
 * 'let_op' — eerlijk zijn over waar iets NIET voor is
 * ---------------------------------------------------------------------------
 * Eén korte zin die vertelt wanneer dit product juist geen goede keuze is.
 * Dat voorkomt teleurstelling achteraf en scheelt jullie retouren en gedoe.
 * Leeg laten mag; dan valt de regel gewoon weg.
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
                array('label' => 'Kleine teams vanaf 1 stuk', 'url' => '/blog/kleine-teams-geen-minimale-afname/'),
                array('label' => 'Horeca en bezorging',       'url' => '/bedrijfskleding-horeca/'),
                array('label' => 'Sportclubs en verenigingen','url' => '/clubkleding-verenigingen/'),
                array('label' => 'Merchandise en eigen merk', 'url' => '/eigen-kledingmerk-laten-maken/'),
                array('label' => 'Grotere aantallen',         'url' => '/blog/prijs-bedrukte-bedrijfskleding/'),
            ),
            'let_op'   => 'Een T-shirt is dun en rekt uit bij zwaar of vies werk. Voor de bouw, techniek en buitendienst adviseren we een polo, werkbroek of jas.',
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
                array('label' => 'Horeca en gastvrijheid',      'url' => '/bedrijfskleding-horeca/'),
                array('label' => 'Kantoor en MKB',              'url' => '/bedrijfskleding-kantoor/'),
                array('label' => 'Retail, showroom en buitendienst', 'url' => '/bedrijfskleding-bedrijven/'),
                array('label' => 'Een logo dat de was overleeft', 'url' => '/blog/opdruktechniek-kiezen/'),
                array('label' => 'Later losse stuks bijbestellen', 'url' => '/blog/kleine-teams-geen-minimale-afname/'),
            ),
            'let_op'   => 'Puur katoen krimpt licht bij hoge wastemperaturen. Gaat de kleding vaak en heet door de was, kies dan een katoen-polyestermix.',
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
                array('label' => 'Teambeleving in het MKB',       'url' => '/bedrijfskleding-kantoor/'),
                array('label' => 'Merchandise en eigen merk',     'url' => '/eigen-kledingmerk-laten-maken/'),
                array('label' => 'Clubs, jubilea en supporters',  'url' => '/blog/clubkleding-jubileumkleding/'),
                array('label' => 'Wat kost een bedrukte hoodie',  'url' => '/blog/prijs-bedrukte-bedrijfskleding/'),
                array('label' => 'Statiegeld terug bij inleveren','url' => '/statiegeld/'),
            ),
            'let_op'   => 'Een hoodie is warm en de capuchon zit in de weg bij machines. Werk je binnen of met apparatuur, dan is een crewneck-sweater praktischer.',
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
                array('label' => 'Een merk starten',              'url' => '/blog/eigen-kledingmerk-starten/'),
                array('label' => 'Private label en cut-and-sew',  'url' => '/eigen-kledingmerk-laten-maken/'),
                array('label' => 'Streetwear en fashion',         'url' => '/portfolio/'),
                array('label' => 'Eerst één sample laten maken',  'url' => '/blog/kleine-teams-geen-minimale-afname/'),
                array('label' => 'Kostenopbouw per stuk',         'url' => '/blog/prijs-bedrukte-bedrijfskleding/'),
            ),
            'let_op'   => 'Vanaf de stof produceren kost meer tijd dan bedrukken van bestaande kleding, en loont pas vanaf grotere aantallen. Wil je snel een klein aantal? Kies dan bedrukte basics.',
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
                array('label' => 'Sportclubs en verenigingen',   'url' => '/clubkleding-verenigingen/'),
                array('label' => 'Jubilea en mijlpalen',         'url' => '/blog/clubkleding-jubileumkleding/'),
                array('label' => 'Bedrijfsfeesten en personeel', 'url' => '/bedrijfskleding-bedrijven/'),
                array('label' => 'Namen en nummers per stuk',    'url' => '/blog/opdruktechniek-kiezen/'),
                array('label' => 'Eerder gemaakt werk bekijken', 'url' => '/portfolio/'),
            ),
            'let_op'   => 'Een jubileumontwerp kost extra tijd aan afstemming. Reken vanaf de eerste schets op zes tot acht weken, dus begin op tijd.',
            'opdruk_label' => 'Opdruk',
            'opdruk'   => 'zeefdruk, borduurwerk, sublimatie',
        ),

    );

    return $producten;
}
