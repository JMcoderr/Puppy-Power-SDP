# Beheerhandleiding Puppy Power Academy

## 1. Project starten
1. Open de map `puppy-power-academy` in je terminal.
2. Start de app:
   - `php artisan serve`
3. Open de website op het adres dat in de terminal staat.

## 2. Database opzetten
1. Maak de database leeg en opnieuw aan:
   - `php artisan migrate:fresh --seed`
2. Voor testen:
   - `php artisan test`

## 3. Inloggen op afgeschermde training
1. Ga naar `/login`.
2. Gebruik demo account:
   - E-mail: `test@example.com`
   - Wachtwoord: `password`

## 4. Content beheren
- Shop producten: tabel `products`
- Trainingen: tabel `trainings`
- Training inschrijvingen: tabel `training_enrollments`
- Dagopvang aanmeldingen: tabel `daycare_registrations`
- Contactberichten: tabel `contact_messages`

Je kunt deze data beheren via bijvoorbeeld:
- SQLite viewer
- DB tool in je editor
- Laravel Tinker (`php artisan tinker`)

## 5. Branch workflow
- `main`: stabiele basis
- `dev`: verzamelbranch voor onderdelen
- Subbranches:
  - `feature/shop`
  - `feature/training`
  - `feature/dagopvang`
  - `feature/contact`
  - `feature/documentatie`

## 6. Nieuwe wijziging doen
1. Ga naar `dev`
2. Maak een nieuwe feature branch
3. Doe je aanpassingen
4. Commit met duidelijke Nederlandse commit boodschap
5. Merge naar `dev`
6. Push branch en `dev`
