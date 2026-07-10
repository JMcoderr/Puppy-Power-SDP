Uitleg voor docent

Dit project is een complete webapplicatie voor Puppy Power Academy. Het doel was om shop, training, dagopvang en contact in een logisch platform te zetten, zodat een gebruiker niet op meerdere plekken hoeft te zoeken. Ik heb geprobeerd om het niet alleen werkend te maken, maar ook overzichtelijk en realistisch voor echt gebruik.

De applicatie bevat een homepagina, adviesgids, shop, training, afgeschermde trainingscontent, dagopvang, contact, accountpagina en een beheeromgeving voor admin. De gebruiker kan registreren, inloggen, uitloggen, wachtwoord resetten en formulieren insturen. De admin kan in beheer resultaten bekijken, filteren en als CSV exporteren.

Wat je als docent makkelijk kunt testen is het volgende.
1. Een nieuw account registreren.
2. Inloggen als normale gebruiker.
3. Trainingscontent openen (alleen ingelogd).
4. Een training inschrijven.
5. Een dagopvang-aanmelding versturen.
6. Een contactbericht versturen.
7. Inloggen als admin.
8. Beheer openen, filteren en CSV-export testen.
9. Dark mode en light mode vergelijken.

Na seeden zijn testaccounts beschikbaar. De belangrijkste zijn test@example.com met wachtwoord password en admin@example.com met wachtwoord password. Daarnaast staan er ook extra dummy gebruikers en dummy inhoud in, zodat het meer lijkt op een applicatie die al gebruikt wordt.

Technisch is dit gebouwd met Laravel, Blade, Eloquent, migrations, seeders, Tailwind en Vite. Voor de kwaliteit zijn feature tests gemaakt met PHPUnit.

Mijn laatste controle voor de oplevering bestond uit database seeding, volledige tests en frontend build. Die draaiden goed. Ook de belangrijkste publieke routes gaven een correcte response.

Als afsluiting: ik ben tevreden met dit eindresultaat, omdat ik van analyse naar ontwerp en uiteindelijk realisatie ben gegaan, en de applicatie zichtbaar bruikbaar heb gemaakt voor zowel gebruiker als beheer.