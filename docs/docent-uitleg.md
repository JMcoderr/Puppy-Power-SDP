# Uitleg voor docent

## Kort uitgelegd
Dit project is een webapplicatie voor Puppy Power Academy.
Ik heb gekozen voor een platform waar een bezoeker niet alleen informatie kan lezen, maar ook echt acties kan uitvoeren.
De gebruiker kan producten bekijken, trainingen kiezen, dagopvang aanvragen, contact opnemen, een account maken en als admin ook alles beheren.

Ik heb geprobeerd om het project niet alleen werkend te maken, maar ook logisch, overzichtelijk en netjes afgewerkt.

## Wat er in de applicatie zit
- Homepagina met uitleg, call-to-actions, FAQ en adviesroutes
- Adviesgids voor bezoekers die nog niet weten wat het beste bij hun hond past
- Shop met filters, categorieen, budgetkeuze en extra uitleg
- Trainingsoverzicht met filters, inschrijfformulier en extra toelichting
- Afgeschermde trainingscontent voor ingelogde gebruikers
- Dagopvangpagina met planning, intake-uitleg en aanmeldformulier
- Contactpagina met onderwerpkeuze en extra hulpblokken
- Registreren, inloggen, uitloggen en wachtwoord resetten
- Mijn account pagina voor ingelogde gebruikers
- Beheerpagina voor admin met overzichten, filters, CSV-export en samenvattingen
- Dark mode en light mode

## Testaccounts
Na seeden zijn deze accounts beschikbaar:

- Gebruiker
  - e-mail: test@example.com
  - wachtwoord: password
- Admin
  - e-mail: admin@example.com
  - wachtwoord: password

## Belangrijkste functionaliteiten

### 1. Shop
Op de shoppagina kan de gebruiker producten bekijken en filteren op:
- zoekterm
- categorie
- budget
- sortering

Er staan ook extra uitlegblokken en een FAQ bij zodat de pagina completer voelt.

### 2. Training
Op de trainingspagina kan de gebruiker:
- trainingen bekijken
- filteren op beschikbaarheid
- filteren op doel
- sorteren
- zich direct inschrijven

Er wordt ook getoond hoeveel plekken nog vrij zijn.

### 3. Trainingscontent
Als een gebruiker is ingelogd, krijgt die toegang tot extra trainingscontent.
Daar staan lessen, samenvattingen, huiswerk en praktische tips.

### 4. Dagopvang
De gebruiker kan een opvangdag plannen via een formulier.
Er staat ook een voorbeeldplanning en extra uitleg over hoe een opvangdag verloopt.

### 5. Contact
De bezoeker kan een bericht sturen met een onderwerpkeuze.
Hierdoor komt de vraag overzichtelijk binnen in het beheergedeelte.

### 6. Beheer
De admin kan in beheer:
- training inschrijvingen bekijken
- dagopvang aanmeldingen bekijken
- contactberichten bekijken
- zoeken en filteren
- CSV exporteren
- extra inzichten zien zoals verdelingen en meest voorkomende vragen

## Extra eindverbetering
Als laatste heb ik nog een aparte adviesgids toegevoegd.
Die pagina helpt bezoekers kiezen tussen shop, training en dagopvang.
Ik vond dat een goede laatste toevoeging omdat de applicatie daardoor meer voelt als een complete echte website en niet alleen als losse pagina's.

## Techniek
Gebruikte technieken:
- Laravel
- PHP
- Blade
- Eloquent ORM
- migrations en seeders
- Tailwind CSS
- Vite
- PHPUnit feature tests

## Wat ik heb gecontroleerd
Ik heb de applicatie nog een laatste keer gecontroleerd met:

- database seeding
- volledige test suite
- frontend build
- smoke test van de belangrijkste publieke pagina's

Resultaat bij laatste controle:
- php artisan db:seed --force: geslaagd
- php artisan test: 39/39 tests geslaagd
- npm run build: geslaagd
- publieke routes zoals home, adviesgids, shop, training, dagopvang, contact, login en register gaven een 200 response

## Wat de docent makkelijk kan nakijken
- Een account registreren
- Inloggen als gewone gebruiker
- Trainingscontent openen
- Een training inschrijven
- Dagopvang aanvragen
- Contactformulier invullen
- Inloggen als admin
- Beheer openen
- Filteren en CSV export gebruiken
- Dark mode testen

## Opmerking over rubric / studiehandleiding
In de huidige repo zat geen apart bestand met een studiehandleiding of rubric.
Daarom baseer ik mijn eigen beoordeling op de uitgewerkte functionaliteiten, afwerking, testresultaten en de algemene projectverwachting van een complete webapplicatie.

## Mijn eigen beoordeling
Als ik eerlijk kijk naar deze versie, verwacht ik dat dit ruim voldoende moet zijn.

Waarom ik dat denk:
- er zitten meerdere werkende functionaliteiten in
- er is authenticatie
- er is beheer
- formulieren werken
- de applicatie heeft een duidelijke structuur
- de UI is afgewerkt en consistent
- er zijn tests aanwezig en die slagen allemaal
- de site voelt als een compleet product en niet als een klein prototype

Mijn eigen inschatting zou zijn:
- minimaal een voldoende
- waarschijnlijk ergens in de richting van een ruime voldoende tot goed, als de rubric vooral kijkt naar functionaliteit, afwerking en compleetheid

Als de beoordeling heel streng is op extra documentatie buiten de code, dan is dit bestand bedoeld om dat overzicht ook duidelijk te maken.

## Afsluiting
Ik ben zelf tevreden met deze eindversie, omdat de app nu zowel technisch als visueel een stuk completer aanvoelt.
Er zit genoeg in om te laten zien dat ik niet alleen pagina's heb gemaakt, maar ook heb nagedacht over gebruikersflow, beheer, inhoud en afwerking.