# mkbkleding.nl — WordPress-thema

Dit is het thema dat op **mkbkleding.nl** draait. Push je naar `main`, dan zet
GitHub het thema automatisch op de server.

```
mkbkleding/                  het thema zelf (dit gaat naar de server)
.github/workflows/deploy.yml het deployscript
```

> **Let op — de losse HTML-bestanden in deze map zijn oud.**
> `index.html`, `producten.html`, `css/`, `blog/` en de mappen daaromheen zijn de
> statische website van vóór juni 2026. **Die site is niet meer live.**
> mkbkleding.nl draait op WordPress; alleen de map `mkbkleding/` gaat naar de
> server. De oude bestanden staan er nog omdat er een GitHub Pages-site op draait
> vanaf de branch `claude/amazing-carson-df4pye`.

---

## Eenmalig instellen (ongeveer 10 minuten)

Dit hoeft maar één keer. Daarna is pushen genoeg.

### Stap 1 — FTP-gegevens ophalen bij ZXCS

Je hosting staat bij **ZXCS** (server `web0173.zxcs.nl`). Log in op je
klantenpaneel of DirectAdmin en zoek je FTP-gegevens op. Je hebt drie dingen nodig:

| Wat | Voorbeeld |
|---|---|
| Servernaam | `web0173.zxcs.nl` |
| Gebruikersnaam | jouw FTP-gebruiker |
| Wachtwoord | jouw FTP-wachtwoord |

Kun je ze niet vinden? Vraag ZXCS om je FTP-gegevens; dat is een standaardvraag.

### Stap 2 — De gegevens in GitHub zetten

**Zet ze nergens anders neer dan hier.** GitHub versleutelt ze en niemand kan ze
daarna nog uitlezen, ook jij niet.

1. Ga in deze repo naar **Settings → Secrets and variables → Actions**
2. Klik **New repository secret** en voeg deze drie toe:

| Name | Secret |
|---|---|
| `FTP_SERVER` | de servernaam |
| `FTP_USERNAME` | je FTP-gebruikersnaam |
| `FTP_PASSWORD` | je FTP-wachtwoord |

### Stap 3 — Eerst een proefrun

Belangrijk: we weten nog niet zeker wat het juiste pad op de server is. De
proefrun maakt verbinding en laat zien wat er zou gebeuren, **zonder iets te
uploaden**.

1. Ga naar het tabblad **Actions**
2. Klik links op **Thema naar mkbkleding.nl zetten**
3. Klik rechts op **Run workflow**
4. Laat **proef** op `true` staan en klik op de groene knop

Bekijk daarna het resultaat:

- **Groen, en je ziet een lijst met themabestanden** → het pad klopt. Door naar stap 4.
- **Rood met "no such directory" of "550"** → het pad klopt niet. Draai de
  proefrun opnieuw en vul bij **pad** een andere map in. Veelvoorkomende varianten:
  - `./domains/mkbkleding.nl/public_html/wp-content/themes/mkbkleding/`
  - `./public_html/wp-content/themes/mkbkleding/`
  - `./wp-content/themes/mkbkleding/`

  Werkt er één? Zet die dan in `deploy.yml` achter `STANDAARD_PAD:` en push dat.
- **Rood met "530" of "login incorrect"** → de inloggegevens kloppen niet.
  Controleer de drie secrets uit stap 2.

### Stap 4 — Echt deployen

Run de workflow nog een keer, nu met **proef** op `false`. Controleer daarna
`https://mkbkleding.nl/statiegeld/`.

Vanaf nu geldt: **push naar `main` = live**.

---

## Bij elke wijziging: verhoog het versienummer

WordPress hangt het versienummer van het thema achter de CSS en JavaScript, zodat
browsers de nieuwe versie ophalen in plaats van de oude uit hun geheugen.

Verander je iets aan het thema, zet dan in `mkbkleding/style.css` het
versienummer één omhoog:

```
Version: 1.9      ->      Version: 2.0
```

Sla je dat over, dan zien bezoekers je wijziging misschien niet meteen.

---

## Als er iets misgaat

De deploy maakt de map op de server **nooit eerst leeg** en raakt alleen
`wp-content/themes/mkbkleding/` aan. WordPress, je database, je pagina's, je
uploads en je offerteaanvragen blijven altijd staan.

Gaat er toch iets mis met het thema zelf, dan zet je het vorige terug via
**wp-admin → Weergave → Thema's → Thema uploaden** met `mkbkleding-v18.zip`
van je bureaublad.

---

## Wat er in versie 1.9 zit

Het statiegeldsysteem: de pagina `/statiegeld/` met rekenhulp en
retourformulier, uitgelichte blokken op de homepage en de dienstenpagina, en de
verwerking van retouraanmeldingen in WordPress (menu **Retouraanmeldingen**).

De statiegeldbedragen staan op één plek: het blokje `$mkb_tarieven` bovenin
`mkbkleding/template-statiegeld.php`.
