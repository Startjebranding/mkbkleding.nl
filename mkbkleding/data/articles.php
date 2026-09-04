<?php
/**
 * articles.php — blogartikelen als thema-data (files-only).
 *
 * De WordPress-installatie op productie ontvangt alleen "Files and folders",
 * geen database. Daarom staan de blogartikelen hier in het thema in plaats van
 * als losse posts in de database. home.php/index.php renderen het overzicht en
 * de losse artikelen op de bestaande /blog/-pagina via ?artikel=<slug>.
 *
 * Volgorde = weergavevolgorde op /blog/ (nieuwste eerst).
 */
if (!defined('ABSPATH')) exit;

/**
 * Alle artikelen, gekeyd op slug.
 */
function mkb_get_articles() {
    static $articles = null;
    if ($articles !== null) return $articles;

    $articles = array(

    /* ------------------------------------------------------------------ */
    'eigen-kledingmerk-starten' => array(
        'titel'       => 'Je eigen kledingmerk starten: van stof tot label',
        'tag'         => 'Eigen merk',
        'datum_iso'   => '2026-04-10',
        'datum'       => '10 april 2026',
        'leestijd'    => '7 min',
        'samenvatting'=> 'Een eigen kledingmerk beginnen voelt groot, maar je kunt klein starten. Dit zijn de stappen van stofkeuze tot eigen waslabel — zonder grote minimale afname.',
        'meta'        => 'Je eigen kledingmerk starten? Lees de stappen van stofkeuze en pasvorm tot eigen labels en private label-productie — klein beginnen kan, ook zonder grote minimale afname.',
        'body'        => <<<'HTML'
<p>Steeds meer ondernemers willen niet alleen kleding mét een logo, maar een echt eigen kledingmerk: een eigen pasvorm, eigen stof en een eigen wasinstructielabel in de nek. Dat klinkt als een groot project, en dat kán het zijn — maar je kunt ook klein en gecontroleerd beginnen. In dit artikel lopen we de belangrijkste stappen langs, van het eerste idee tot een collectie die je echt kunt verkopen.</p>

<h2>1. Bepaal eerst je concept, niet je collectie</h2>
<p>De meeste merken die vastlopen, beginnen met te veel modellen tegelijk. Begin daarom met één duidelijk concept: voor wie is het merk, welk gevoel moet de kleding oproepen en welk kledingstuk is je "held"? Vaak is dat één hoodie of één zwaar t-shirt waar je alles omheen bouwt. Een scherp concept maakt elke volgende keuze — stof, kleur, pasvorm — een stuk makkelijker.</p>

<h2>2. Kies je stof en kwaliteit</h2>
<p>De stof bepaalt voor een groot deel hoe je merk voelt en oogt. Een paar dingen om op te letten:</p>
<ul>
  <li><strong>Gewicht.</strong> Bij sweats en hoodies wordt het stofgewicht in gram per vierkante meter (gsm) uitgedrukt. Lichtere stoffen (rond 250&ndash;280 gsm) zijn toegankelijk; zwaardere stoffen (320&ndash;400+ gsm) voelen premium en zijn populair in streetwear.</li>
  <li><strong>Samenstelling.</strong> 100% katoen, een katoen-polyestermix of biologisch katoen — elk heeft eigen voor- en nadelen op het gebied van krimp, prijs en uitstraling.</li>
  <li><strong>Kleurvastheid.</strong> Vraag altijd om een voorbeeld voordat je een hele oplage laat maken, zeker bij diepe of felle kleuren.</li>
</ul>
<p>Twijfel je tussen opties? Dat is precies waarvoor een voorbeeld of sample bedoeld is. We denken graag met je mee over welke stof past bij het prijspunt en het gevoel dat je voor ogen hebt.</p>

<h2>3. Pasvorm en maatverloop</h2>
<p>Een herkenbare pasvorm is wat een merk onderscheidt van een willekeurig bedrukt shirt. Wil je oversized, regular of getailleerd? En hoe loopt het maatverloop van XS tot XXL? Bij private label leg je dit vast in een patroon, zodat elke productie er hetzelfde uitziet. Begin met één goed uitgewerkte pasvorm; die kun je later doortrekken naar andere modellen.</p>

<h2>4. Je eigen labels en afwerking</h2>
<p>De details maken het merk. Denk aan:</p>
<ul>
  <li>Een geweven of geprint <strong>merklabel</strong> in de nek.</li>
  <li>Een <strong>wasinstructielabel</strong> in de zijnaad (vaak ook wettelijk handig met samenstelling en wasvoorschrift).</li>
  <li>Eventuele <strong>hangtags</strong>, een eigen kleur stiksel of een speciaal koordje in de hoodie.</li>
</ul>
<p>Dit zijn de elementen die van "een shirt met een opdruk" een echt product maken dat je met een gerust hart verkoopt.</p>

<h2>5. Klein produceren en bijsturen</h2>
<p>Je hoeft niet meteen honderden stuks te laten maken. Door klein te beginnen, houd je je risico laag en kun je je eerste serie testen bij echte klanten. Verkoopt een model goed? Dan schaal je op. Bij ons geldt geen grote minimale afname, dus je kunt met een beperkte eerste oplage starten en daarna rustig groeien. De exacte aantallen en prijzen leggen we vast in een offerte op maat.</p>

<h2>6. Van sample naar collectie</h2>
<p>Een gebruikelijke route ziet er zo uit: eerst een sample van je heldenproduct ter goedkeuring, dan een kleine eerste productie, en daarna uitbreiden met varianten (kleuren) of nieuwe modellen die bij hetzelfde concept passen. Doordat we zelf produceren en met korte lijnen werken, kunnen we snel schakelen tussen die stappen.</p>

<h2>Klaar om te beginnen?</h2>
<p>Een eigen kledingmerk start met één goed gesprek over wat je voor ogen hebt. Bekijk wat er mogelijk is op onze <a href="/diensten/">dienstenpagina</a>, of <a href="/offerte/">vraag vrijblijvend een offerte aan</a>. We reageren binnen 1 werkdag en denken met je mee — van stofkeuze tot het label in de nek.</p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik een eigen kledingmerk starten zonder grote minimale afname?',
                  'a' => 'Ja. We hanteren geen grote minimale afname, dus je kunt met een kleine eerste oplage beginnen en later opschalen. De exacte aantallen en prijzen leggen we vast in je offerte.'),
            array('v' => 'Kan ik mijn eigen waslabel en merklabel laten toevoegen?',
                  'a' => 'Ja, bij private label voorzien we je kleding van je eigen geweven of geprinte merklabel en een wasinstructielabel. Ook hangtags en afwerkingsdetails zijn mogelijk.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'clubkleding-jubileumkleding' => array(
        'titel'       => 'Clubkleding &amp; jubileumkleding voor sportclubs en verenigingen',
        'tag'         => 'Sport &amp; clubs',
        'datum_iso'   => '2026-03-22',
        'datum'       => '22 maart 2026',
        'leestijd'    => '6 min',
        'samenvatting'=> 'Teamkleding of een limited-edition jubileumhoodie bestellen voor je club? Dit moet je weten over maten, clubkleuren, sponsorlogo&rsquo;s en levering.',
        'meta'        => 'Clubkleding en jubileumkleding bestellen voor je sportclub of vereniging: lees hoe je clubkleuren, sponsorlogo&rsquo;s, maten en levering goed regelt — ook voor kleine aantallen.',
        'body'        => <<<'HTML'
<p>Of het nu gaat om nieuwe teamkleding voor het komende seizoen of een speciale hoodie voor het 50-jarig jubileum: kleding maakt een club zichtbaar en versterkt het clubgevoel. Tegelijk is het bestellen voor een vereniging net even anders dan voor een bedrijf — je hebt te maken met veel verschillende maten, meerdere sponsoren en vaak een vrijwilliger die het "erbij" doet. In dit artikel zetten we op een rij hoe je het soepel regelt.</p>

<h2>Clubkleding: herkenbaar op en naast het veld</h2>
<p>Goede clubkleding zorgt ervoor dat je team er als één geheel uitziet. Denk aan:</p>
<ul>
  <li><strong>Trainingskleding en teamhoodies</strong> in de clubkleuren, met clublogo en eventueel een rugnummer of naam.</li>
  <li><strong>Polo&rsquo;s en sweaters</strong> voor bestuur, trainers en vrijwilligers, zodat iedereen herkenbaar is op een toernooi of clubdag.</li>
  <li><strong>Supporters- en merchandisekleding</strong> waarmee leden de club ook buiten het veld uitdragen.</li>
</ul>

<h2>Jubileumkleding: maak er iets blijvends van</h2>
<p>Een jubileum &mdash; 25, 50 of 100 jaar &mdash; vraagt om iets unieks. Een limited-edition hoodie of shirt met het jaartal, de clubkleuren en een speciaal ontwerp wordt vaak een blijvende herinnering die leden jaren later nog dragen. Omdat het om een afgebakende oplage gaat, is dit het uitgelezen moment voor een net iets bijzonderder ontwerp of afwerking.</p>

<h2>Sponsorlogo&rsquo;s netjes verwerken</h2>
<p>Veel clubs werken met sponsoren, en die willen herkenbaar in beeld. Een paar tips:</p>
<ul>
  <li>Verzamel logo&rsquo;s het liefst in een goede resolutie (vectorbestand zoals AI, EPS of SVG werkt het best).</li>
  <li>Bepaal vooraf welke sponsor op welke plek komt &mdash; borst, rug of mouw &mdash; zodat je later geen discussie hebt.</li>
  <li>Houd rekening met de gekozen opdruktechniek: een logo met veel kleuren of kleurverloop komt anders tot zijn recht in borduurwerk dan in transferprint. We adviseren je graag welke techniek per logo het beste werkt.</li>
</ul>

<h2>Maten verzamelen zonder gedoe</h2>
<p>Het lastigste aan bestellen voor een club is vaak het inventariseren van de maten. Wat helpt:</p>
<ul>
  <li>Werk met een duidelijke maattabel en laat leden zelf hun maat doorgeven.</li>
  <li>Bestel bij twijfel een enkele set ter referentie, zodat leden een model kunnen passen voordat de hele bestelling de deur uit gaat.</li>
  <li>Vraag eerst een digitaal ontwerp ter goedkeuring aan, zodat het bestuur akkoord is voordat we produceren.</li>
</ul>

<h2>Ook voor kleine aantallen</h2>
<p>Niet elke club heeft honderden leden, en lang niet elke bestelling is groot. Veel leveranciers hanteren hoge minimale aantallen, waardoor een klein team of een select groepje vrijwilligers buiten de boot valt. Bij ons is dat geen probleem: er is geen minimale afname, dus ook een kleine serie teamhoodies of een handvol bestuurspolo&rsquo;s kan. Zo bestel je precies wat je nodig hebt, zonder dozen vol overgebleven maten.</p>

<h2>Levering en planning</h2>
<p>Bij een club werk je vaak naar een datum toe: de start van het seizoen, een toernooi of de jubileumavond. Geef die datum daarom vroeg door. Na goedkeuring van het ontwerp gaan we direct aan de slag; de exacte levertijd leggen we vast in de offerte, zodat je zeker weet dat de kleding op tijd binnen is.</p>

<h2>Aan de slag voor jouw club</h2>
<p>Wil je teamkleding of een jubileumeditie laten maken? Bekijk de mogelijkheden op onze <a href="/diensten/#sector-sportclubs">pagina voor sportclubs en verenigingen</a> of <a href="/offerte/">vraag vrijblijvend een offerte aan</a>. Vertel ons om hoeveel leden het gaat en wanneer je de kleding nodig hebt — we reageren binnen 1 werkdag.</p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik clubkleding ook in kleine aantallen bestellen?',
                  'a' => 'Ja. Er is geen minimale afname, dus ook een kleine serie teamkleding of een handvol bestuurspolo&rsquo;s is mogelijk.'),
            array('v' => 'Kunnen meerdere sponsorlogo&rsquo;s op de kleding?',
                  'a' => 'Ja. Lever de logo&rsquo;s het liefst als vectorbestand aan en geef per logo de gewenste plek door. We adviseren welke opdruktechniek per logo het beste werkt.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'kleine-teams-geen-minimale-afname' => array(
        'titel'       => 'Bedrijfskleding voor kleine teams: ook vanaf 1 stuk',
        'tag'         => 'MKB tips',
        'datum_iso'   => '2026-03-05',
        'datum'       => '5 maart 2026',
        'leestijd'    => '5 min',
        'samenvatting'=> 'De meeste leveranciers vragen 50 of 100 stuks minimaal. Maar wat als je maar een paar shirts nodig hebt? Zo werkt bedrijfskleding zonder minimale afname.',
        'meta'        => 'Bedrijfskleding voor een klein team of zzp&rsquo;er? Bij ons geldt geen minimale afname &mdash; bestel al vanaf 1 stuk. Lees hoe het werkt en waar je op let.',
        'body'        => <<<'HTML'
<p>Je hebt een klein team, of je bent zzp&rsquo;er, en je wilt er professioneel uitzien met kleding waar je logo op staat. Logisch. Maar zodra je gaat rondkijken, loop je vaak tegen hetzelfde probleem aan: minimale afnames van 50 of 100 stuks. Voor een team van drie is dat onzin. In dit artikel leggen we uit hoe het óók kan: bedrijfskleding zonder minimale afname, al vanaf 1 stuk.</p>

<h2>Waarom hanteren veel leveranciers een minimum?</h2>
<p>Bij sommige opdruktechnieken zitten er vaste opstartkosten in een order. Zeefdruk bijvoorbeeld vraagt om het maken van een zeef per kleur; die kosten verdeel je het liefst over veel stuks. Daarom sturen grotere leveranciers aan op hoge aantallen — voor hen is een kleine order simpelweg minder efficiënt. Het gevolg: kleine teams vallen buiten de boot of betalen een onlogische prijs.</p>

<h2>Hoe het óók kan: kiezen voor de juiste techniek</h2>
<p>De oplossing zit hem vaak in de opdruktechniek. Voor kleine aantallen zijn sommige technieken veel geschikter dan andere:</p>
<ul>
  <li><strong>Transferprint</strong> is flexibel en heeft geen dure opstartkosten per kleur. Ideaal voor één of een paar stuks, ook met kleurrijke ontwerpen.</li>
  <li><strong>Borduurwerk</strong> werkt goed voor polo&rsquo;s, caps en sweaters en oogt premium, ook bij kleine series.</li>
  <li><strong>Zeefdruk</strong> wordt pas echt voordelig bij grotere aantallen, dus voor één shirt is dat zelden de slimste keuze.</li>
</ul>
<p>Door per situatie de juiste techniek te kiezen, blijft ook een kleine bestelling betaalbaar en netjes. We adviseren je welke techniek past bij jouw logo en aantal. Meer weten? Lees ons artikel over <a href="/blog/opdruktechniek-kiezen/">welke opdruktechniek je kiest</a>.</p>

<h2>Wat betekent "geen minimale afname" concreet?</h2>
<p>Het betekent precies wat het zegt: je kunt 1 shirt bestellen, of 3 hoodies, of 8 polo&rsquo;s — wat je ook nodig hebt. Geen verplichte dozen vol maten die je nooit gebruikt. Dit maakt ons geschikt voor:</p>
<ul>
  <li>Zzp&rsquo;ers die er met één of twee kledingstukken representatief op willen staan.</li>
  <li>Kleine teams en startende ondernemers.</li>
  <li>Verenigingen en commissies die maar een paar stuks nodig hebben.</li>
  <li>Bedrijven die eerst een proefexemplaar willen voordat ze meer bestellen.</li>
</ul>

<h2>Let wel op: de stukprijs ligt anders</h2>
<p>Eerlijk is eerlijk: bij heel kleine aantallen ligt de prijs per stuk hoger dan bij een grote order. Dat komt doordat sommige vaste kosten over minder stuks worden verdeeld. Dat is geen addertje, maar logica. Het voordeel: je betaalt alleen voor wat je echt nodig hebt en zit niet vast aan voorraad. In je offerte zie je precies waar je aan toe bent, zonder verborgen kosten.</p>

<h2>Eerst een proefexemplaar bestellen</h2>
<p>Een fijne bijkomstigheid van geen minimale afname: je kunt eerst één exemplaar laten maken om de pasvorm, de stof en de opdruk te beoordelen. Bevalt het? Dan bestel je de rest bij. Zo kom je nooit voor verrassingen te staan. En je ontvangt sowieso altijd eerst een digitaal ontwerp ter goedkeuring voordat we iets produceren.</p>

<h2>Klein team, net zo serieus geholpen</h2>
<p>Of je nu 1 shirt of 100 hoodies nodig hebt, je krijgt hetzelfde persoonlijke advies en één vast aanspreekpunt. Bekijk de mogelijkheden op onze <a href="/diensten/">dienstenpagina</a> of <a href="/offerte/">vraag een vrijblijvende offerte aan</a>. We reageren binnen 1 werkdag.</p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Kan ik echt vanaf 1 stuk bedrijfskleding bestellen?',
                  'a' => 'Ja. We hanteren geen minimale afname. Of je nu 1 shirt of 100 hoodies nodig hebt, je kunt precies bestellen wat je nodig hebt.'),
            array('v' => 'Is bedrijfskleding voor een klein team duurder per stuk?',
                  'a' => 'Bij heel kleine aantallen ligt de stukprijs doorgaans hoger, omdat vaste kosten over minder stuks worden verdeeld. In je offerte zie je vooraf precies waar je aan toe bent, zonder verborgen kosten.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'opdruktechniek-kiezen' => array(
        'titel'       => 'Bedrijfskleding met logo: welke opdruktechniek kies je?',
        'tag'         => 'Tips &amp; advies',
        'datum_iso'   => '2026-02-02',
        'datum'       => '2 februari 2026',
        'leestijd'    => '6 min',
        'samenvatting'=> 'Zeefdruk, borduren of transferprint? Elke techniek heeft eigen sterke punten. Zo kies je de juiste op basis van je logo, kleding en aantallen.',
        'meta'        => 'Zeefdruk, borduren of transferprint voor je bedrijfskleding met logo? Lees de voor- en nadelen per opdruktechniek en kies de juiste op basis van logo, kleding en aantallen.',
        'body'        => <<<'HTML'
<p>Je logo op bedrijfskleding zetten kan op meerdere manieren, en de techniek die je kiest bepaalt voor een groot deel het eindresultaat én de prijs. Zeefdruk, borduren en transferprint zijn de drie meest gebruikte methodes, met sublimatie als vierde optie voor full-colour ontwerpen. In dit artikel leggen we per techniek uit wanneer die het beste werkt, zodat je een onderbouwde keuze maakt.</p>

<h2>Zeefdruk: voordelig bij grote aantallen</h2>
<p>Bij zeefdruk wordt de inkt via een sjabloon (de zeef) op het textiel aangebracht — één zeef per kleur. Het maken van die zeven kost tijd en geld, maar zodra ze klaar zijn, druk je snel en goedkoop grote oplages.</p>
<ul>
  <li><strong>Sterk in:</strong> grote aantallen, scherpe egale kleuren, lange houdbaarheid.</li>
  <li><strong>Minder geschikt voor:</strong> kleine series of logo&rsquo;s met heel veel kleuren of kleurverloop.</li>
  <li><strong>Typisch gebruikt voor:</strong> t-shirts en hoodies voor events, teams en merchandise in grotere oplages.</li>
</ul>
<p>Kort gezegd: hoe groter de order en hoe eenvoudiger het kleurgebruik, hoe interessanter zeefdruk wordt.</p>

<h2>Borduren: premium en duurzaam</h2>
<p>Bij borduurwerk wordt je logo met garen direct in de stof geborduurd. Dat geeft een professionele, hoogwaardige uitstraling en gaat jarenlang mee — de opdruk kan niet loslaten of barsten zoals een print soms doet.</p>
<ul>
  <li><strong>Sterk in:</strong> premium look, duurzaamheid, ook mooi bij kleine aantallen.</li>
  <li><strong>Minder geschikt voor:</strong> hele fijne details of grote, vlakke logo&rsquo;s (veel garen maakt het stug en duurder).</li>
  <li><strong>Typisch gebruikt voor:</strong> polo&rsquo;s, overhemden, caps en sweaters voor horeca, retail en kantoor.</li>
</ul>
<p>Borduren is vaak de favoriet als je representatief voor de dag wilt komen en het logo relatief compact is, bijvoorbeeld op de borst.</p>

<h2>Transferprint: flexibel voor kleine series en kleur</h2>
<p>Bij transferprint wordt het ontwerp eerst geprint en daarna op de kleding aangebracht. Er zijn geen dure opstartkosten per kleur, waardoor deze techniek juist sterk is bij kleine aantallen en kleurrijke ontwerpen.</p>
<ul>
  <li><strong>Sterk in:</strong> kleine series, full-colour ontwerpen, foto&rsquo;s en kleurverloop, ook vanaf 1 stuk.</li>
  <li><strong>Minder geschikt voor:</strong> de allergrootste oplages, waar zeefdruk per stuk goedkoper wordt.</li>
  <li><strong>Typisch gebruikt voor:</strong> kleine teams, proefexemplaren en ontwerpen met veel kleur.</li>
</ul>
<p>Heb je maar een paar stuks nodig? Dan is transferprint vaak de meest logische en betaalbare keuze. Lees ook ons artikel over <a href="/blog/kleine-teams-geen-minimale-afname/">bedrijfskleding voor kleine teams</a>.</p>

<h2>En sublimatie dan?</h2>
<p>Voor full-colour ontwerpen die over het hele kledingstuk lopen — denk aan sportshirts met een doorlopend patroon — is sublimatie geschikt. De inkt trekt in de vezel, waardoor de opdruk niet voelbaar is en niet slijt. Dit werkt vooral op lichte polyesterstoffen.</p>

<h2>Hoe kies je nu de juiste techniek?</h2>
<p>Loop in je hoofd deze drie vragen langs:</p>
<ul>
  <li><strong>Hoeveel stuks?</strong> Veel stuks met simpele kleuren &rarr; zeefdruk. Een paar stuks &rarr; transferprint of borduren.</li>
  <li><strong>Welk kledingstuk en welke uitstraling?</strong> Premium polo of cap &rarr; borduren. T-shirt voor een event &rarr; zeefdruk of transfer.</li>
  <li><strong>Hoe ziet je logo eruit?</strong> Weinig kleuren &rarr; zeefdruk of borduren. Veel kleuren of een foto &rarr; transferprint of sublimatie.</li>
</ul>
<p>Je hoeft dit niet alleen uit te zoeken. Vertel ons wat je nodig hebt, dan adviseren we welke techniek het beste past bij jouw logo, kleding en aantallen.</p>

<h2>Persoonlijk advies op jouw situatie</h2>
<p>Bekijk de mogelijkheden op onze <a href="/diensten/">dienstenpagina</a> of <a href="/offerte/">vraag vrijblijvend een offerte aan</a>. Stuur je logo mee, dan denken we direct met je mee over de beste techniek. We reageren binnen 1 werkdag.</p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Wat is de beste opdruktechniek voor een klein aantal stuks?',
                  'a' => 'Voor kleine aantallen is transferprint vaak het meest geschikt, omdat er geen dure opstartkosten per kleur zijn. Voor polo&rsquo;s en caps is borduren ook bij kleine series een mooie, duurzame optie.'),
            array('v' => 'Welke techniek is het voordeligst bij grote aantallen?',
                  'a' => 'Zeefdruk wordt per stuk voordeliger naarmate de oplage groter is en het logo weinig kleuren heeft, omdat de opstartkosten over meer stuks worden verdeeld.'),
        ),
    ),

    /* ------------------------------------------------------------------ */
    'prijs-bedrukte-bedrijfskleding' => array(
        'titel'       => 'Wat bepaalt de prijs van bedrukte bedrijfskleding?',
        'tag'         => 'Prijzen &amp; budgettering',
        'datum_iso'   => '2026-01-15',
        'datum'       => '15 januari 2026',
        'leestijd'    => '6 min',
        'samenvatting'=> 'Waarom kost het ene shirt een paar euro en het andere een stuk meer? Dit zijn de factoren die de prijs van bedrukte bedrijfskleding bepalen.',
        'meta'        => 'Wat bepaalt de prijs van bedrukte bedrijfskleding? Ontdek de factoren &mdash; kledingstuk, aantallen, opdruktechniek en aantal kleuren &mdash; zodat je je budget realistisch inschat.',
        'body'        => <<<'HTML'
<p>"Wat kost een shirt met ons logo erop?" Het is de meest gestelde vraag, en het eerlijke antwoord is: dat hangt ervan af. Niet omdat we vaag willen doen, maar omdat de prijs uit meerdere onderdelen is opgebouwd. Als je begrijpt welke factoren meespelen, kun je je budget realistisch inschatten en bewust kiezen waar je op bespaart. In dit artikel zetten we de belangrijkste prijsbepalers op een rij.</p>

<h2>1. Het kledingstuk zelf</h2>
<p>De basis van de prijs is het product waarop gedrukt wordt. Een eenvoudig t-shirt is goedkoper dan een zware premium hoodie of een geborduurd overhemd. Binnen elke categorie zit bovendien een grote spreiding in kwaliteit:</p>
<ul>
  <li>Stofgewicht en samenstelling (een 180-grams t-shirt versus een 320-grams hoodie).</li>
  <li>Merk en kwaliteitsklasse.</li>
  <li>Extra&rsquo;s zoals een dubbele naad, een rits of een speciale pasvorm.</li>
</ul>
<p>Kies daarom eerst het kwaliteitsniveau dat bij je merk en budget past; dat heeft de grootste invloed op de eindprijs.</p>

<h2>2. Het aantal stuks</h2>
<p>Aantallen zijn misschien wel de belangrijkste factor. Veel kosten — zoals het opstarten van een opdruk — zijn grotendeels vast. Verdeel je die over 5 stuks, dan is het aandeel per stuk groot; verdeel je ze over 200 stuks, dan valt het in het niet. Daardoor daalt de stukprijs naarmate je meer bestelt.</p>
<p>Dat betekent niet dat kleine aantallen onbetaalbaar zijn. Door de juiste opdruktechniek te kiezen, blijft ook een kleine bestelling logisch geprijsd. We hanteren geen minimale afname, dus je hoeft niet meer te bestellen dan je nodig hebt — je betaalt alleen een eerlijke stukprijs die bij dat aantal hoort. Lees meer in ons artikel over <a href="/blog/kleine-teams-geen-minimale-afname/">bedrijfskleding voor kleine teams</a>.</p>

<h2>3. De opdruktechniek</h2>
<p>De manier waarop je logo wordt aangebracht, heeft direct effect op de prijs:</p>
<ul>
  <li><strong>Zeefdruk</strong> heeft opstartkosten per kleur, maar wordt per stuk voordelig bij grote oplages.</li>
  <li><strong>Borduren</strong> wordt geprijsd op basis van het aantal steken; een groot of detailrijk logo kost meer dan een compact logo.</li>
  <li><strong>Transferprint</strong> heeft lage opstartkosten en is daardoor gunstig voor kleine series en kleurrijke ontwerpen.</li>
</ul>
<p>Welke techniek het voordeligst is, hangt dus samen met je aantal en je ontwerp. Meer hierover lees je in <a href="/blog/opdruktechniek-kiezen/">welke opdruktechniek je kiest</a>.</p>

<h2>4. Het aantal kleuren en de complexiteit van je logo</h2>
<p>Een logo in één kleur is goedkoper te produceren dan een logo met vijf kleuren of een kleurverloop. Bij zeefdruk betaal je per kleur een zeef; bij borduren bepaalt het aantal steken de prijs. Een vereenvoudigde versie van je logo kan soms flink schelen, zonder dat het er minder strak uitziet.</p>

<h2>5. Aantal opdruklocaties</h2>
<p>Eén logo op de borst is goedkoper dan borst plus rug plus mouw. Elke extra plek is in feite een extra opdruk. Bepaal dus vooraf welke posities echt nodig zijn voor het effect dat je wilt.</p>

<h2>6. Afwerking en extra&rsquo;s</h2>
<p>Wil je je eigen waslabel, een hangtag of individuele namen per kledingstuk? Dat soort personalisatie maakt je kleding bijzonder, maar telt mee in de prijs. Voor een eigen kledingmerk met eigen labels lees je meer in <a href="/blog/eigen-kledingmerk-starten/">je eigen kledingmerk starten</a>.</p>

<h2>Waarom je een offerte krijgt en geen vaste prijslijst</h2>
<p>Omdat al deze factoren samen de prijs bepalen, zegt een losse "vanaf"-prijs weinig. Daarom maken we een offerte op maat: zo weet je vooraf precies wat je betaalt, zonder verborgen kosten. Geef ons door welk kledingstuk je wilt, om hoeveel stuks het gaat en hoe je logo eruitziet, dan rekenen we het netjes voor je uit.</p>

<h2>Benieuwd naar jouw prijs?</h2>
<p>Bekijk eerst de mogelijkheden op onze <a href="/diensten/">dienstenpagina</a> en <a href="/offerte/">vraag daarna een vrijblijvende offerte aan</a>. We reageren binnen 1 werkdag en denken met je mee over de slimste keuzes voor jouw budget.</p>
HTML
        ,
        'faqs' => array(
            array('v' => 'Hebben jullie een vaste prijslijst voor bedrukte kleding?',
                  'a' => 'Nee. De prijs hangt af van het kledingstuk, het aantal stuks, de opdruktechniek, het aantal kleuren en de afwerking. Daarom maken we een offerte op maat, zodat je vooraf precies weet waar je aan toe bent zonder verborgen kosten.'),
            array('v' => 'Hoe houd ik de prijs van bedrijfskleding laag?',
                  'a' => 'Kies een kledingstuk dat past bij je budget, beperk het aantal kleuren en opdruklocaties, en stem de opdruktechniek af op je aantal. We adviseren je graag over de slimste keuzes.'),
        ),
    ),

    );

    return $articles;
}

/**
 * Het op dit moment opgevraagde artikel, of null.
 * Bron: de nette permalink /blog/<slug>/ (via $GLOBALS['mkb_force_article'],
 * gezet in inc/virtual-pages.php) of de oude ?artikel=<slug>-query.
 */
function mkb_current_article() {
    $slug = '';
    if (!empty($GLOBALS['mkb_force_article'])) {
        $slug = sanitize_title($GLOBALS['mkb_force_article']);
    } elseif (!empty($_GET['artikel'])) {
        $slug = sanitize_title(wp_unslash($_GET['artikel']));
    }
    if (!$slug) return null;
    $articles = mkb_get_articles();
    if (!isset($articles[$slug])) return null;
    return array('slug' => $slug) + $articles[$slug];
}

/**
 * Rendert de blogpagina: óf het artikeloverzicht, óf een los artikel.
 * Wordt aangeroepen vanuit home.php en index.php (tussen header en footer).
 */
function mkb_render_blog() {
    $art = mkb_current_article();
    if ($art) {
        mkb_render_single_article($art);
    } else {
        mkb_render_blog_overview();
    }
}

function mkb_render_blog_overview() {
    $articles = mkb_get_articles();
    ?>
    <header class="page-hero">
      <div class="container">
        <h1>Blog</h1>
        <p>Tips &amp; advies over bedrijfskleding, eigen kledingmerk en jubileumkleding.</p>
      </div>
    </header>
    <section class="section">
      <div class="container">
        <div class="blog-grid">
          <?php foreach ($articles as $slug => $a) :
            $url = home_url('/blog/' . $slug . '/'); ?>
            <article class="blog-card">
              <div class="blog-card-body">
                <span class="blog-tag"><?php echo wp_kses_post($a['tag']); ?></span>
                <h3><a href="<?php echo esc_url($url); ?>"><?php echo wp_kses_post($a['titel']); ?></a></h3>
                <p><?php echo wp_kses_post($a['samenvatting']); ?></p>
                <div class="blog-meta">
                  <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html($a['datum']); ?></span>
                  <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html($a['leestijd']); ?></span>
                </div>
                <a href="<?php echo esc_url($url); ?>" class="btn btn-secondary btn-small" style="margin-top:14px">Lees artikel</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php
}

function mkb_render_single_article($art) {
    ?>
    <header class="artikel-hero">
      <div class="container">
        <div class="artikel-meta">
          <span class="blog-tag"><?php echo wp_kses_post($art['tag']); ?></span>
          <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html($art['datum']); ?></span>
          <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html($art['leestijd']); ?></span>
        </div>
        <h1><?php echo wp_kses_post($art['titel']); ?></h1>
      </div>
    </header>
    <main class="artikel-body">
      <div class="container artikel-container">
        <?php echo wp_kses_post($art['body']); ?>
        <p style="margin-top:32px">
          <a href="/offerte/" class="btn btn-primary">Offerte aanvragen</a>
          <a href="/blog/" class="btn btn-secondary" style="margin-left:8px">Terug naar blog</a>
        </p>
      </div>
    </main>
    <?php
}
