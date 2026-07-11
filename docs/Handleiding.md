Handleiding Puppy Power Academy

Deze website heb ik gemaakt als Software Development Project. Mijn doel was om niet alleen losse pagina's te bouwen, maar echt een complete website neer te zetten die logisch werkt voor gebruikers. Daarom heb ik shop, training, dagopvang, contact, account en beheer allemaal aan elkaar gekoppeld.

Wat de website nu kan:

De bezoeker kan producten bekijken in de shop, trainingen zoeken en inschrijven, dagopvang aanvragen en contact opnemen. Er zit ook een adviesgids in voor mensen die nog twijfelen wat het beste past bij hun hond.

Als iemand een account maakt en inlogt, kan diegene extra trainingscontent zien.

Als admin kun je in de beheerpagina de inzendingen bekijken van training, dagopvang en contact. Je kunt filteren en ook exporteren naar CSV.

Testaccounts

Na seeden kun je deze accounts gebruiken:

Gebruiker
E-mail: test@example.com
Wachtwoord: password

Admin
E-mail: admin@example.com
Wachtwoord: password

Er staan ook extra dummy gebruikers en dummy records in de database, zodat de website realistischer oogt tijdens het testen.

Hoe je het project opstart

Stap 1
Installeer dependencies met composer install en npm install.

Stap 2
Zet je .env goed en draai php artisan key:generate als dat nog niet gedaan is.

Stap 3
Voer migraties en seed uit met php artisan migrate:fresh --seed.

Stap 4
Start de backend met php artisan serve.

Stap 5
Start de frontend met npm run dev.

Vite uitleg (belangrijk)

Ik gebruik Vite voor alle frontend assets. Kort gezegd: Vite bouwt en serveert mijn CSS en JavaScript snel tijdens development.

Met npm run dev start Vite in development mode. Dan worden wijzigingen in resources/css en resources/js direct herladen in de browser.

Met npm run build maakt Vite een productie-build. Die output komt in public/build. Deze build is bedoeld voor oplevering of productie-achtig testen.

Als styles of scripts niet lijken te werken, is meestal de oorzaak dat Vite nog niet draait of dat de build nog niet opnieuw is gemaakt.

Wat ik zelf heb getest

Ik heb de belangrijkste routes en functionaliteiten getest:
registratie en login,
training inschrijven,
dagopvang aanvragen,
contactformulier versturen,
beheerpagina bekijken,
dark en light mode,
plus de test suite met php artisan test.

Voor de frontend check heb ik npm run build gebruikt om te zien of alles compileert zonder errors.

Afsluiting

Ik ben tevreden met dit eindresultaat. De website voelt voor mij als een echte, bruikbare applicatie in plaats van alleen een demo met losse pagina's. 