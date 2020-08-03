# wpboilerplate
Dette er en boilerplate for å komme raskt igang med utvikling av WordPress themes\
Den benytter seg av SCSS, moderne JS (ES6), twig for PHP (templatespråk) og gulp for hot reload av browser.

## Organisering
*/assets/css* Her ligger en style.css som importerer alle css-filene. Bare legg til flere importer ved behov. I disse filene kan du skrive SCSS som blir kompilert til vanlig css i style.css som ligger i rotmappa, som er fila som blir lest av WordPress.

*/assets/js* Her ligger scripts.js hvor det importeres js-filer og instansieres objekter. Dette blir kompilert med babel til scripts-bundled.js

*/views* Her ligger alle twig-view'ene, altså markupen til hver sidetype. De har php-filer med korresponderende navn i rotmappa.

*/*  I rotmappa legger du controllere til WordPress - de følger vanlig WordPress-hierarki. Se index.php for eksempel.

### Flexible-content (ACF Pro, optional)
Definer først et ACF-felt av typen Flexible Content, og gi denne field name "main". Deretter lager du alle modulene dine som rows i denne.

*/views/acf*  Her legger du views til acf moduler som benytter et Flexible Content-field. Bruk navnekonvensjonen acf-[navn-på-modul].twig. Du kan da få tak i feltene ved å bruke {{ fields.[navn-på-field] }}. I denne mappen ligger acf-main.php, som kaller de forskjellige view'ene.

## How-to
- Opprett domene (domeneshop)

Staging:
  - Opprette site på din hosting-tjeneste (plesk) - Notér ned credentials
  - Installer WordPress hos din host (plesk) - notere ned databasenavn, table-prefix, bruker og passord.

Lokalt:
  - Sett opp en lokal WP installasjon (XAMPP, Laragon, whatever)
  - Gå til wp-config og sett inn db-credentials du fikk fra Plesk.
  - Lag en mappe i wp-content/themes som du gir navnet på din theme.
  - Gå til denne mappen med en terminal og kjør git init.
  - Gå til settings.js i rotmappa og endre urlToPreview til din lokale URL (f.eks sitename.test)

Klikk "use this template" i dette repoet. Du oppretter da et nytt repo med navnet på din theme.

Tilbake i terminalen lokalt, kjør\
```$ git clone [url til repoet du laget]```\

Deretter må du installere Timber (gratis plugin).\
ACF Pro er også anbefalt, men ikke påkrevet.

Nå kan vi installere node pakkene som kreves:\
```$ npm i```

For å kunne kjøre gulp, gå til settings.js, og legg inn din lokale url i urlToPreview.\
Deretter kan du kjøre\
```$ gulp watch```

GL HF!
