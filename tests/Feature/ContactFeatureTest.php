<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_with_valid_data_is_stored(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jordy Tester',
            'email' => 'jordy@test.nl',
            'subject' => 'Vraag over training',
            'message' => 'Wanneer start de volgende groep?',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'jordy@test.nl',
            'subject' => 'Vraag over training',
        ]);
    }

    public function test_contact_form_rejects_unknown_subject(): void
    {
        // subject must be one of the predefined dropdown values
        $response = $this->post('/contact', [
            'name' => 'Jordy Tester',
            'email' => 'jordy@test.nl',
            'subject' => 'Iets willekeurigs',
            'message' => 'Test.',
        ]);

        $response->assertSessionHasErrors('subject');
        $this->assertDatabaseMissing('contact_messages', ['email' => 'jordy@test.nl']);
    }

    public function test_contact_form_accepts_all_valid_subjects(): void
    {
        // verify every dropdown option is accepted by validation
        $subjects = [
            'Vraag over training',
            'Vraag over dagopvang',
            'Vraag over een product',
            'Overige vraag',
        ];

        foreach ($subjects as $subject) {
            $this->post('/contact', [
                'name' => 'Test',
                'email' => 'test+subject@test.nl',
                'subject' => $subject,
                'message' => 'Test message.',
            ])->assertSessionMissing('errors');
        }
    }

    public function test_contact_page_shows_quick_route_cards(): void
    {
        $this->get('/contact')
            ->assertOk()
            ->assertSee('Snelle route')
            ->assertSee('Vraag over training')
            ->assertSee('Vraag over dagopvang')
            ->assertSee('Vraag over een product');
    }
}






