<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

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
    }
}
