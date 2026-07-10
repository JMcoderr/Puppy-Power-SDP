<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\DaycareRegistration;
use App\Models\Product;
use App\Models\Training;
use App\Models\TrainingEnrollment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create a regular test user (can view training content, cannot access beheer)
        User::query()->updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // create an admin test user (has access to the beheer dashboard)
        User::query()->updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Test Admin',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        foreach ([
            [
                'name' => 'Puppy Basis Cursus',
                'category' => 'Cursus',
                'description' => 'Online cursus met stap-voor-stap puppytraining.',
                'price' => 79.00,
                'is_active' => true,
            ],
            [
                'name' => 'DIY Snuffelmat Pakket',
                'category' => 'DIY-pakket',
                'description' => 'Compleet pakket om zelf een snuffelmat te maken.',
                'price' => 34.95,
                'is_active' => true,
            ],
            [
                'name' => 'Vuurwerk Rustplan',
                'category' => 'Cursus',
                'description' => 'Praktisch stappenplan voor vuurwerkangst bij honden.',
                'price' => 49.50,
                'is_active' => true,
            ],
            [
                'name' => 'Puber Focus Mini-cursus',
                'category' => 'Cursus',
                'description' => 'Korte online training voor puberhonden die snel afgeleid zijn.',
                'price' => 59.00,
                'is_active' => true,
            ],
            [
                'name' => 'Clicker Startpakket',
                'category' => 'DIY-pakket',
                'description' => 'Starterspakket met clicker, targetstick en eenvoudige oefenkaartjes.',
                'price' => 24.95,
                'is_active' => true,
            ],
            [
                'name' => 'Speurspel Box',
                'category' => 'DIY-pakket',
                'description' => 'Moeilijkere neuswerk-opdrachten voor honden die extra uitdaging nodig hebben.',
                'price' => 44.50,
                'is_active' => true,
            ],
            [
                'name' => 'Kalme Start Videobundel',
                'category' => 'Cursus',
                'description' => 'Extra videolessen voor honden die thuis meer rust en routine nodig hebben.',
                'price' => 64.00,
                'is_active' => true,
            ],
            [
                'name' => 'Balans en Coördinatie Box',
                'category' => 'DIY-pakket',
                'description' => 'Praktische materialen en oefenkaarten voor lichaamsbewustzijn en gecontroleerd bewegen.',
                'price' => 54.95,
                'is_active' => true,
            ],
            [
                'name' => 'Terugroep Booster',
                'category' => 'Cursus',
                'description' => 'Korte verdiepingscursus voor beter terugkomen buiten en meer aandacht op afstand.',
                'price' => 42.50,
                'is_active' => true,
            ],
        ] as $product) {
            Product::query()->updateOrCreate(
                ['name' => $product['name']],
                $product,
            );
        }

        foreach ([
            [
                'title' => 'Puppytraining',
                'slug' => 'puppytraining',
                'summary' => 'Voor pups van 8 weken tot 6 maanden met focus op basiscommando\'s.',
                'starts_on' => now()->addWeek()->toDateString(),
                'capacity' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Vuurwerkangst',
                'slug' => 'vuurwerkangst',
                'summary' => 'Stapsgewijze training om spanning rond harde geluiden te verlagen.',
                'starts_on' => now()->addWeeks(2)->toDateString(),
                'capacity' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Gedragstraining',
                'slug' => 'gedragstraining',
                'summary' => 'Voor honden met uitvalgedrag, onzekerheid of onrust in huis.',
                'starts_on' => now()->addWeeks(3)->toDateString(),
                'capacity' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Pubertraining',
                'slug' => 'pubertraining',
                'summary' => 'Voor jonge honden die grenzen testen en extra focus nodig hebben.',
                'starts_on' => now()->addWeeks(4)->toDateString(),
                'capacity' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Sociale wandeling',
                'slug' => 'sociale-wandeling',
                'summary' => 'Rustige begeleide wandeling voor honden die vertrouwen moeten opbouwen in de buitenwereld.',
                'starts_on' => now()->addWeeks(5)->toDateString(),
                'capacity' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Loslopen en terugroepen',
                'slug' => 'loslopen-en-terugroepen',
                'summary' => 'Praktische training voor honden die buiten beter moeten leren luisteren en terugkomen.',
                'starts_on' => now()->addWeeks(6)->toDateString(),
                'capacity' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Rust in huis',
                'slug' => 'rust-in-huis',
                'summary' => 'Training voor honden die thuis moeilijk ontspannen of snel onrustig worden.',
                'starts_on' => now()->addWeeks(7)->toDateString(),
                'capacity' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Zelfvertrouwen op straat',
                'slug' => 'zelfvertrouwen-op-straat',
                'summary' => 'Voor honden die buiten spanning opbouwen en stapsgewijs meer zekerheid nodig hebben.',
                'starts_on' => now()->addWeeks(8)->toDateString(),
                'capacity' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Snuffel- en focuswerk',
                'slug' => 'snuffel-en-focuswerk',
                'summary' => 'Gerichte training voor concentratie, denkwerk en gecontroleerd schakelen tussen rust en actie.',
                'starts_on' => now()->addWeeks(9)->toDateString(),
                'capacity' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Basis herstart',
                'slug' => 'basis-herstart',
                'summary' => 'Voor honden die opnieuw moeten starten met luisteren, structuur en dagelijkse basisvaardigheden.',
                'starts_on' => now()->addWeeks(10)->toDateString(),
                'capacity' => 10,
                'is_active' => true,
            ],
        ] as $training) {
            Training::query()->updateOrCreate(
                ['slug' => $training['slug']],
                $training,
            );
        }

        // extra dummy users so the app feels like it has active members
        foreach ([
            ['name' => 'Sanne de Vries', 'email' => 'sanne@example.com', 'is_admin' => false],
            ['name' => 'Milan Jansen', 'email' => 'milan@example.com', 'is_admin' => false],
            ['name' => 'Lotte Bakker', 'email' => 'lotte@example.com', 'is_admin' => false],
            ['name' => 'Daan Smit', 'email' => 'daan@example.com', 'is_admin' => false],
            ['name' => 'Noor Visser', 'email' => 'noor@example.com', 'is_admin' => false],
            ['name' => 'Bram van Dijk', 'email' => 'bram@example.com', 'is_admin' => false],
            ['name' => 'Kim Mulder', 'email' => 'kim@example.com', 'is_admin' => false],
            ['name' => 'Floor Tester', 'email' => 'floor.admin@example.com', 'is_admin' => true],
        ] as $dummyUser) {
            User::query()->updateOrCreate(
                ['email' => $dummyUser['email']],
                [
                    'name' => $dummyUser['name'],
                    'password' => Hash::make('password'),
                    'is_admin' => $dummyUser['is_admin'],
                ],
            );
        }

        $trainingIdsBySlug = Training::query()->pluck('id', 'slug');

        // sample enrollments for a realistic beheer overview
        foreach ([
            ['slug' => 'puppytraining', 'owner_name' => 'Sanne de Vries', 'email' => 'sanne@example.com', 'dog_name' => 'Puck', 'phone' => '0611111111', 'notes' => 'Eerste puppy, wil vooral structuur.'],
            ['slug' => 'gedragstraining', 'owner_name' => 'Milan Jansen', 'email' => 'milan@example.com', 'dog_name' => 'Rex', 'phone' => '0622222222', 'notes' => 'Trekt veel aan de lijn.'],
            ['slug' => 'vuurwerkangst', 'owner_name' => 'Lotte Bakker', 'email' => 'lotte@example.com', 'dog_name' => 'Milo', 'phone' => '0633333333', 'notes' => 'Spanning bij harde geluiden.'],
            ['slug' => 'rust-in-huis', 'owner_name' => 'Noor Visser', 'email' => 'noor@example.com', 'dog_name' => 'Nala', 'phone' => '0644444444', 'notes' => 'Onrustig tijdens bezoek.'],
            ['slug' => 'snuffel-en-focuswerk', 'owner_name' => 'Bram van Dijk', 'email' => 'bram@example.com', 'dog_name' => 'Bikkel', 'phone' => '0655555555', 'notes' => 'Zoekt meer uitdaging thuis.'],
            ['slug' => 'zelfvertrouwen-op-straat', 'owner_name' => 'Kim Mulder', 'email' => 'kim@example.com', 'dog_name' => 'Luna', 'phone' => '0666666666', 'notes' => 'Schrikt snel buiten.'],
        ] as $enrollment) {
            $trainingId = $trainingIdsBySlug[$enrollment['slug']] ?? null;

            if (! $trainingId) {
                continue;
            }

            TrainingEnrollment::query()->updateOrCreate(
                [
                    'training_id' => $trainingId,
                    'email' => $enrollment['email'],
                    'dog_name' => $enrollment['dog_name'],
                ],
                [
                    'owner_name' => $enrollment['owner_name'],
                    'phone' => $enrollment['phone'],
                    'notes' => $enrollment['notes'],
                ],
            );
        }

        foreach ([
            ['owner_name' => 'Sanne de Vries', 'email' => 'sanne@example.com', 'dog_name' => 'Puck', 'drop_off_date' => now()->addDays(2)->toDateString(), 'time_slot' => 'Ochtend', 'notes' => 'Nog jong, graag rustige groep.'],
            ['owner_name' => 'Milan Jansen', 'email' => 'milan@example.com', 'dog_name' => 'Rex', 'drop_off_date' => now()->addDays(3)->toDateString(), 'time_slot' => 'Middag', 'notes' => 'Actieve hond, houdt van spelen.'],
            ['owner_name' => 'Noor Visser', 'email' => 'noor@example.com', 'dog_name' => 'Nala', 'drop_off_date' => now()->addDays(4)->toDateString(), 'time_slot' => 'Hele dag', 'notes' => 'Kan in het begin wat spanning hebben.'],
            ['owner_name' => 'Daan Smit', 'email' => 'daan@example.com', 'dog_name' => 'Kaya', 'drop_off_date' => now()->addDays(5)->toDateString(), 'time_slot' => 'Ochtend', 'notes' => 'Lief en sociaal met andere honden.'],
        ] as $daycare) {
            DaycareRegistration::query()->updateOrCreate(
                [
                    'email' => $daycare['email'],
                    'dog_name' => $daycare['dog_name'],
                    'drop_off_date' => $daycare['drop_off_date'],
                ],
                [
                    'owner_name' => $daycare['owner_name'],
                    'time_slot' => $daycare['time_slot'],
                    'notes' => $daycare['notes'],
                ],
            );
        }

        foreach ([
            ['name' => 'Sanne de Vries', 'email' => 'sanne@example.com', 'subject' => 'Vraag over training', 'message' => 'Ik twijfel tussen puppytraining en basis herstart, wat past beter?'],
            ['name' => 'Milan Jansen', 'email' => 'milan@example.com', 'subject' => 'Vraag over dagopvang', 'message' => 'Is er nog plek op dinsdagmiddag voor een actieve hond?'],
            ['name' => 'Lotte Bakker', 'email' => 'lotte@example.com', 'subject' => 'Vraag over een product', 'message' => 'Welk pakket helpt het meest bij rustig snuffelwerk thuis?'],
            ['name' => 'Kim Mulder', 'email' => 'kim@example.com', 'subject' => 'Overige vraag', 'message' => 'Kan ik eerst een intakeadvies krijgen voordat ik kies?'],
        ] as $message) {
            ContactMessage::query()->updateOrCreate(
                [
                    'email' => $message['email'],
                    'subject' => $message['subject'],
                ],
                [
                    'name' => $message['name'],
                    'message' => $message['message'],
                ],
            );
        }
    }
}
