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

        // seed demo products only if the table is empty, to avoid duplicates
        if (Product::query()->count() === 0) {
        Product::query()->insert([
            [
                'name' => 'Puppy Basis Cursus',
                'category' => 'Cursus',
                'description' => 'Online cursus met stap-voor-stap puppytraining.',
                'price' => 79.00,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DIY Snuffelmat Pakket',
                'category' => 'DIY-pakket',
                'description' => 'Compleet pakket om zelf een snuffelmat te maken.',
                'price' => 34.95,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vuurwerk Rustplan',
                'category' => 'Cursus',
                'description' => 'Praktisch stappenplan voor vuurwerkangst bij honden.',
                'price' => 49.50,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        } // end products guard

        // seed demo trainings only if the table is empty, to avoid duplicate slugs
        if (Training::query()->count() === 0) {
        Training::query()->insert([
            [
                'title' => 'Puppytraining',
                'slug' => 'puppytraining',
                'summary' => 'Voor pups van 8 weken tot 6 maanden met focus op basiscommando\'s.',
                'starts_on' => now()->addWeek()->toDateString(),
                'capacity' => 12,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Vuurwerkangst',
                'slug' => 'vuurwerkangst',
                'summary' => 'Stapsgewijze training om spanning rond harde geluiden te verlagen.',
                'starts_on' => now()->addWeeks(2)->toDateString(),
                'capacity' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gedragstraining',
                'slug' => 'gedragstraining',
                'summary' => 'Voor honden met uitvalgedrag, onzekerheid of onrust in huis.',
                'starts_on' => now()->addWeeks(3)->toDateString(),
                'capacity' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pubertraining',
                'slug' => 'pubertraining',
                'summary' => 'Voor jonge honden die grenzen testen en extra focus nodig hebben.',
                'starts_on' => now()->addWeeks(4)->toDateString(),
                'capacity' => 9,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sociale wandeling',
                'slug' => 'sociale-wandeling',
                'summary' => 'Rustige begeleide wandeling voor honden die vertrouwen moeten opbouwen in de buitenwereld.',
                'starts_on' => now()->addWeeks(5)->toDateString(),
                'capacity' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        } // end trainings guard
    }
}
