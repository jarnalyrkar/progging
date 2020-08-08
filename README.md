# wpboilerplate
Dette er en boilerplate for å komme raskt igang med utvikling av WordPress themes\
Den benytter seg av SCSS, moderne JS (ES6), twig for PHP (templatespråk) og Webpack (byggeverktøy).

## Organisering
*/assets/css* Her ligger en style.scss som importerer alle scss-filene. Bare legg til flere importer ved behov. I disse filene kan du skrive SCSS som blir kompilert til vanlig css i style.[hash].css som ligger i rotmappa, som er fila som blir lastet inn av WordPress.

*/assets/js* Her ligger scripts.js hvor det importeres js-filer og instansieres objekter. Dette blir kompilert med babel til .dist/js/bundle.[hash].js

*/views* Her ligger alle twig-view'ene, altså markupen til hver sidetype. De har php-filer med korresponderende navn i rotmappa.

*/*  I rotmappa legger du controllere til WordPress - de følger vanlig WordPress-hierarki. Se index.php for eksempel.

### Flexible-content (ACF Pro, optional)
Definer først et ACF-felt av typen Flexible Content, og gi denne field name "main". Deretter lager du alle modulene dine som rows i denne.

*/views/acf*  Her legger du views til acf-moduler som benytter et Flexible Content-field. Bruk navnekonvensjonen acf-[navn-på-modul].twig. Du kan da få tak i feltene ved å bruke {{ fields.[navn-på-field] }}. I denne mappen ligger acf-main.php, som kaller de forskjellige view'ene.

## How-to
- Opprett domene (domeneshop)
- Klikk "use this template" i dette repoet. Du oppretter da et nytt repo med navnet på din theme.

Staging:
  - Opprette site på din hosting-tjeneste (plesk) - Notér ned credentials
  - Installer WordPress hos din host (plesk) - notere ned databasenavn, table-prefix, bruker og passord.

Lokalt:
  - Sett opp en lokal WP installasjon (XAMPP, Laragon, LocalByFlywheel, Vagrant, Docker.. whatever.)
  - Gå til wp-config og legg inn db-credentials du fikk fra Plesk.
  - Logg inn på wp-admin i din lokale nettside, og legg inn et plugin som heter Timber (gratis).
  - Gå til wp-content/themes i terminalen, og kjør ```$ git clone [url til repoet du laget]```
  - Nå kan vi installere node pakkene som kreves:\
  ```$ npm i```
  - Gå til webpack.config.js, gå til linj 10, og endre til navnet på din lokale php-server (f.eks kewlsite.test) \
  - Deretter kan du kjøre\
  ```$ npm run watch```

GL HF!
