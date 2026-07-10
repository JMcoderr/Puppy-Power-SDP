<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Training;
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
    }
}
