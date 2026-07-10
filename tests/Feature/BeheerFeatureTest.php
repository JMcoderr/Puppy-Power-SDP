<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeheerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_beheer_page_requires_login(): void
    {
        $this->get('/beheer')->assertRedirect('/login');
    }

    public function test_logged_in_user_can_open_beheer_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/beheer')
            ->assertOk()
            ->assertSee('Beheer overzicht');
    }
}
