<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
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
            ->assertOk()
            ->assertSee('Jouw trainingspad')
            ->assertSee('Lessenoverzicht')
            ->assertSee('Nu bekijken');
    }

    public function test_user_can_register_and_is_redirected_to_training_content(): void
    {
        $response = $this->post('/register', [
            'name' => 'Nieuwe Gebruiker',
            'email' => 'nieuw@test.nl',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/training/content');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'nieuw@test.nl']);
    }

    public function test_login_page_shows_register_and_reset_links(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Nog geen account? Registreer')
            ->assertSee('Wachtwoord vergeten?');
    }

    public function test_user_can_reset_password_via_token_flow(): void
    {
        User::factory()->create([
            'email' => 'reset@test.nl',
            'password' => 'oldpassword',
        ]);

        $response = $this->post('/wachtwoord-vergeten', [
            'email' => 'reset@test.nl',
        ]);

        $row = DB::table('password_reset_tokens')->where('email', 'reset@test.nl')->first();

        $response->assertRedirect();
        $this->assertNotNull($row);

        $updateResponse = $this->post('/wachtwoord-reset', [
            'token' => $row->token,
            'email' => 'reset@test.nl',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $updateResponse->assertRedirect('/login');

        $this->post('/login', [
            'email' => 'reset@test.nl',
            'password' => 'newpassword123',
        ])->assertRedirect('/training/content');
    }

    public function test_logged_in_user_can_open_account_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/mijn-account')
            ->assertOk()
            ->assertSee('Mijn account')
            ->assertSee('Snelle acties');
    }

    public function test_account_page_requires_login(): void
    {
        $this->get('/mijn-account')->assertRedirect('/login');
    }
}




