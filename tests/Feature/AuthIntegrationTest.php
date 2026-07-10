<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_training_content_requires_login(): void
    {
        $this->get('/training/content')->assertRedirect('/login');
    }

    public function test_logged_in_user_can_open_training_content(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/training/content')
            ->assertOk();
    }
}




