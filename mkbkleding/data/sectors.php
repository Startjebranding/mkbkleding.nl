<?php
/**
 * sectors.php — sectorpagina's als thema-data (files-only, geen database-record).
 *
 * Deze pagina's worden als "virtuele pagina's" geserveerd via inc/virtual-pages.php
 * (echte HTTP 200) op eigen permalinks: /<slug>/. Ze staan in wp-sitemap.xml via de
 * eigen sitemap-provider in inc/virtual-pages.php.
 *
 * Elke sector: SEO-title, meta description, breadcrumb-label, H1, intro (hero),
 * body (HTML) en een sector-FAQ (voor de zichtbare <details> én FAQPage-schema).
 */
if (!defined('ABSPATH')) exit;

function mkb_sector_pages() {
    static $pages = null;
    if ($pages !== null) return $pages;

    $pages = array(

    /* ------------------------------------------------------------------ */
    'bedrijfskleding-horeca' => array(
        'title' => 'Bedrijfskleding voor de horeca met logo | MKBkleding',
        'desc'  => 'Representatieve horecakleding met jouw logo: polo\'s, overhemden en schorten. Geen minimale afname, ook voor kleine teams. Vraag een vrijblijvende offerte aan.',
        'crumb' => 'Horeca',
        'h1'    => 'Bedrijfskleding voor de horeca met jouw logo',
        'intro' => 'Representatieve, comfortabele kleding voor je horecateam — met je logo erop, ook in kleine aantallen.',
        'body'  => <<<'HTML'
<p>In de horeca is je team het gezicht van je zaak. Nette, herkenbare kleding met je logo zorgt voor een verzorgde uitstraling en maakt in één oogopslag duidelijk wie er werkt. Of je nu een café, restaurant, hotel of foodtruck runt: wij maken bedrijfskleding die past bij de sfeer van je zaak en tegen dagelijks, intensief gebruik kan.</p>

<h2>Wat we voor de horeca maken</h2>
<ul>
  <li><strong>Polo's en T-shirts</strong> voor bediening en keuken — comfortabel en makkelijk wasbaar.</li>
  <li><strong>Overhemden en blouses</strong> voor een net, gastvrij voorkomen.</li>
  <li><strong>Schorten</strong> met logo, van sloof tot halterschort.</li>
  <li><strong>Hoodies en sweaters</strong> voor bezorgers, terras en koelere uren.</li>
</ul>

<h2>Waar we op letten</h2>
<p>Horecakleding gaat vaak en heet door de was. Daarom adviseren we bij logo's meestal borduurwerk: dat is duurzaam en laat niet los. We stemmen de kleuren af op je huisstijl, zodat je team er als één geheel uitziet. Welke opdruktechniek per stuk het beste werkt leggen we je uit — lees ook ons artikel over <a href="/blog/opdruktechniek-kiezen/">welke opdruktechniek je kiest</a>.</p>

<h2>Ook voor kleine teams</h2>
<p>Veel leveranciers vragen grote minimale aantallen. Bij ons niet: je bestelt al vanaf 1 stuk, ideaal voor een klein team of een net gestarte zaak. Meer weten? Lees onze tips over <a href="/blog/kleine-teams-geen-minimale-afname/">bedrijfskleding voor kleine teams</a>, of bekijk ons volledige <a href="/diensten/">aanbod aan diensten</a>.</p>

<p><a href="/offerte/" class="btn btn-primary">Offerte aanvragen voor je horecateam</a></p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik horecakleding in kleine aantallen bestellen?',
                  'a' => 'Ja. Er is geen minimale afname, dus ook een paar polo\'s of schorten voor een klein team kan.'),
            array('v' => 'Welke opdruktechniek is het beste voor horecakleding?',
                  'a' => 'Omdat horecakleding vaak en heet wordt gewassen, adviseren we voor logo\'s meestal borduurwerk: dat is duurzaam en laat niet los. Voor kleurrijke ontwerpen kan transferprint.'),
            array('v' => 'Kunnen jullie kleding leveren in mijn huisstijlkleuren?',
                  'a' => 'Ja. We stemmen de kleding en de logoplaatsing af op je huisstijl, zodat je team er verzorgd en herkenbaar uitziet.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'bedrijfskleding-kantoor' => array(
        'title' => 'Bedrijfskleding voor kantoor & MKB met logo | MKBkleding',
        'desc'  => 'Verzorgde bedrijfskleding met logo voor kantoor en MKB: polo\'s, overhemden en bodywarmers. Ook voor zzp\'ers en kleine teams. Vraag een vrijblijvende offerte aan.',
        'crumb' => 'Kantoor & MKB',
        'h1'    => 'Bedrijfskleding voor kantoor en MKB met jouw logo',
        'intro' => 'Professioneel voor de dag komen bij klanten, op kantoor of op een beurs — met je logo, al vanaf 1 stuk.',
        'body'  => <<<'HTML'
<p>Een verzorgde uitstraling wekt vertrouwen. Voor kantoren, dienstverleners en het bredere MKB maken we bedrijfskleding die er professioneel uitziet en comfortabel zit — met je logo netjes geborduurd of gedrukt. Handig bij klantbezoek, op een beurs of gewoon op kantoor, zodat je bedrijf er als één team bij staat.</p>

<h2>Populair bij kantoor &amp; MKB</h2>
<ul>
  <li><strong>Overhemden en blouses</strong> met discreet geborduurd logo.</li>
  <li><strong>Polo's</strong> voor een nette maar toegankelijke look.</li>
  <li><strong>Sweaters en bodywarmers</strong> voor buitendienst en beursstand.</li>
  <li><strong>Softshells en jassen</strong> voor wie veel onderweg is.</li>
</ul>

<h2>Ook voor zzp'ers en kleine teams</h2>
<p>Je hoeft geen groot bedrijf te zijn om er representatief uit te zien. Omdat we geen minimale afname hanteren, bestel je precies wat je nodig hebt — of dat nu één overhemd is of een set voor het hele kantoor. Twijfel je over aantallen of budget? Lees hoe de <a href="/blog/prijs-bedrukte-bedrijfskleding/">prijs van bedrukte bedrijfskleding</a> is opgebouwd.</p>

<h2>Persoonlijk advies</h2>
<p>We denken met je mee over pasvorm, materiaal en de plek van je logo, en je ontvangt altijd eerst een digitaal ontwerp ter goedkeuring. Bekijk ons volledige <a href="/diensten/">aanbod</a> of vraag direct een voorstel op maat aan.</p>

<p><a href="/offerte/" class="btn btn-primary">Vraag een offerte aan voor je kantoor</a></p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik als zzp\'er ook bedrijfskleding bestellen?',
                  'a' => 'Zeker. Er is geen minimale afname, dus ook één of een paar stuks met je logo is geen probleem.'),
            array('v' => 'Welke kleding straalt professioneel uit op kantoor?',
                  'a' => 'Overhemden en polo\'s met een discreet geborduurd logo geven een verzorgde, representatieve uitstraling. Voor buitendienst zijn sweaters en bodywarmers populair.'),
            array('v' => 'Zie ik het ontwerp voordat jullie produceren?',
                  'a' => 'Ja, altijd. Je krijgt eerst een digitaal ontwerp ter goedkeuring en we produceren pas als je akkoord bent.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'eigen-kledingmerk-laten-maken' => array(
        'title' => 'Eigen kledingmerk laten maken (private label) | MKBkleding',
        'desc'  => 'Je eigen kledingmerk laten maken via private label: van stofkeuze en pasvorm tot je eigen labels. Klein beginnen kan. Vraag een vrijblijvende offerte aan.',
        'crumb' => 'Eigen kledingmerk',
        'h1'    => 'Je eigen kledingmerk laten maken (private label)',
        'intro' => 'Van eerste sample tot complete collectie — jouw merk, onze productie. Klein beginnen kan, zonder grote minimale afname.',
        'body'  => <<<'HTML'
<p>Wil je niet alleen kleding mét een logo, maar een echt eigen kledingmerk? Met private label maken we kleding vanaf de stof: wij snijden, naaien, bedrukken en werken af met je eigen was- en merklabels. Zo krijg je een product dat je met een gerust hart verkoopt — jouw pasvorm, jouw stof, jouw label in de nek.</p>

<h2>Wat private label bij ons inhoudt</h2>
<ul>
  <li><strong>Stof- en kwaliteitskeuze</strong> die past bij je merk en prijspunt.</li>
  <li><strong>Eigen pasvorm</strong> — oversized, regular of getailleerd.</li>
  <li><strong>Eigen merk- en wasinstructielabels</strong>, hangtags en afwerkingsdetails.</li>
  <li><strong>Alle opdruktechnieken</strong>: zeefdruk, borduren, transfer en meer.</li>
</ul>

<h2>Klein beginnen, rustig opschalen</h2>
<p>Je hoeft niet meteen honderden stuks te laten maken. Begin met een sample van je heldenproduct, test het bij echte klanten en schaal daarna op. Omdat we zelf produceren met korte lijnen, kunnen we snel schakelen tussen die stappen. In ons artikel <a href="/blog/eigen-kledingmerk-starten/">je eigen kledingmerk starten</a> lopen we alle stappen langs, van stof tot label.</p>

<h2>Voor wie</h2>
<p>Voor startende merken, streetwear-labels en fashion-startups die kwaliteit en korte lijnen belangrijk vinden. Bekijk ook onze andere <a href="/diensten/">diensten</a> of vraag vrijblijvend een voorstel aan.</p>

<p><a href="/offerte/" class="btn btn-primary">Bespreek je kledingmerk — vraag een offerte aan</a></p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik een eigen kledingmerk starten zonder grote minimale afname?',
                  'a' => 'Ja. Je kunt met een kleine eerste oplage beginnen en later opschalen. De exacte aantallen en prijzen leggen we vast in je offerte.'),
            array('v' => 'Kan ik mijn eigen merk- en waslabels laten toevoegen?',
                  'a' => 'Ja. Bij private label voorzien we je kleding van je eigen geweven of geprinte merklabel en een wasinstructielabel. Ook hangtags en afwerkingsdetails zijn mogelijk.'),
            array('v' => 'Beginnen jullie met een sample?',
                  'a' => 'Meestal wel. Je start met een sample van je belangrijkste product ter goedkeuring, daarna volgt een kleine eerste productie die je kunt opschalen.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'clubkleding-verenigingen' => array(
        'title' => 'Clubkleding voor sportclubs & verenigingen | MKBkleding',
        'desc'  => 'Clubkleding en jubileumkleding voor sportclubs en verenigingen: teamkleding in clubkleuren met sponsorlogo\'s, ook in kleine aantallen. Vraag een offerte aan.',
        'crumb' => 'Clubkleding & verenigingen',
        'h1'    => 'Clubkleding voor sportclubs en verenigingen',
        'intro' => 'Teamkleding in de clubkleuren, kleding voor bestuur en vrijwilligers en limited-edition jubileumkleding — ook in kleine aantallen.',
        'body'  => <<<'HTML'
<p>Kleding maakt een club zichtbaar en versterkt het clubgevoel. Wij maken clubkleding in jouw clubkleuren, met clublogo en ruimte voor meerdere sponsoren — voor het team, het bestuur, de vrijwilligers en de supporters. Ook voor een speciale gelegenheid, zoals een jubileum, maken we er iets unieks van.</p>

<h2>Wat we voor clubs en verenigingen maken</h2>
<ul>
  <li><strong>Teamkleding</strong> — trainingskleding en teamhoodies in de clubkleuren.</li>
  <li><strong>Bestuurs- en vrijwilligerskleding</strong> — polo's en sweaters, herkenbaar op elke clubdag.</li>
  <li><strong>Supporters- en merchandisekleding</strong>.</li>
  <li><strong>Jubileumkleding</strong> — limited-edition hoodies of shirts met jaartal en clublogo.</li>
</ul>

<h2>Sponsorlogo's en maten netjes geregeld</h2>
<p>Werk je met sponsoren? Lever de logo's het liefst als vectorbestand aan en geef per logo de plek door. We adviseren welke opdruktechniek per logo het beste werkt. Voor het inventariseren van maten werken we met een duidelijke maattabel; bij twijfel maken we vooraf een enkel exemplaar ter referentie. Meer tips lees je in ons artikel over <a href="/blog/clubkleding-jubileumkleding/">clubkleding en jubileumkleding</a>.</p>

<h2>Ook voor kleine aantallen</h2>
<p>Niet elke club is groot, en niet elke bestelling telt honderden stuks. Er is geen minimale afname, dus ook een kleine serie teamhoodies of een handvol bestuurspolo's kan. Bekijk ook onze bredere <a href="/diensten/">diensten</a>.</p>

<p><a href="/offerte/" class="btn btn-primary">Vraag een offerte aan voor je club</a></p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik clubkleding ook in kleine aantallen bestellen?',
                  'a' => 'Ja. Er is geen minimale afname, dus ook een kleine serie teamkleding of een handvol bestuurspolo\'s is mogelijk.'),
            array('v' => 'Kunnen er meerdere sponsorlogo\'s op de kleding?',
                  'a' => 'Ja. Lever de logo\'s het liefst als vectorbestand aan en geef per logo de gewenste plek door. We adviseren welke opdruktechniek per logo het beste werkt.'),
            array('v' => 'Maken jullie ook jubileumkleding?',
                  'a' => 'Ja. Voor een jubileum maken we limited-edition hoodies of shirts met het jaartal, de clubkleuren en het logo.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'bedrijfskleding-bedrijven' => array(
        'title' => 'Bedrijfskleding voor bedrijven met logo | MKBkleding',
        'desc'  => 'Bedrijfskleding met logo voor bedrijven in het MKB: retail, fitness, dienstverlening en meer. Geen minimale afname. Vraag een vrijblijvende offerte aan.',
        'crumb' => 'Bedrijven',
        'h1'    => 'Bedrijfskleding voor bedrijven met jouw logo',
        'intro' => 'Herkenbare kleding met je logo voor je hele team — van retail en fitness tot dienstverlening. Ook voor kleine teams.',
        'body'  => <<<'HTML'
<p>Eén team, één gezicht. Herkenbare bedrijfskleding met je logo zorgt voor een professionele uitstraling en maakt je team direct zichtbaar — op de winkelvloer, in de sportschool, bij de klant of op locatie. Wij maken kleding die past bij je bedrijf en je huisstijl, voor vrijwel elke branche in het MKB.</p>

<h2>Voor uiteenlopende branches</h2>
<ul>
  <li><strong>Retail</strong> — herkenbare kleding zodat klanten meteen zien wie er werkt.</li>
  <li><strong>Fitness &amp; gyms</strong> — een sportieve look voor je team en merchandise voor je leden.</li>
  <li><strong>Dienstverlening &amp; buitendienst</strong> — polo's, sweaters en jassen met logo.</li>
  <li><strong>Overige MKB-bedrijven</strong> — van bouw tot transport.</li>
</ul>

<h2>Wat je van ons kunt verwachten</h2>
<p>Geen minimale afname, persoonlijk advies en één vast aanspreekpunt. We denken mee over materiaal, pasvorm en opdruktechniek, en je krijgt altijd eerst een ontwerp ter goedkeuring. Benieuwd wat het kost? Lees hoe de <a href="/blog/prijs-bedrukte-bedrijfskleding/">prijs van bedrukte bedrijfskleding</a> tot stand komt, of bekijk ons volledige <a href="/diensten/">aanbod</a>.</p>

<h2>Werk je in de horeca, op kantoor of bij een club?</h2>
<p>Daar hebben we aparte pagina's voor: <a href="/bedrijfskleding-horeca/">horeca</a>, <a href="/bedrijfskleding-kantoor/">kantoor &amp; MKB</a> en <a href="/clubkleding-verenigingen/">sportclubs &amp; verenigingen</a>.</p>

<p><a href="/offerte/" class="btn btn-primary">Vraag een offerte aan voor je bedrijf</a></p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Voor welke branches maken jullie bedrijfskleding?',
                  'a' => 'Voor vrijwel elke branche in het MKB — retail, fitness, dienstverlening, bouw, transport en meer. Voor horeca, kantoor en sportclubs hebben we aparte pagina\'s.'),
            array('v' => 'Is er een minimale afname voor bedrijven?',
                  'a' => 'Nee. Of je nu 1 stuk of een grote serie nodig hebt, je bestelt precies wat je nodig hebt.'),
            array('v' => 'Kunnen jullie de kleding in mijn huisstijl leveren?',
                  'a' => 'Ja. We stemmen kleur, materiaal en logoplaatsing af op je huisstijl en leveren pas na goedkeuring van het ontwerp.'),
        ),
    ),

    );

    return $pages;
}
