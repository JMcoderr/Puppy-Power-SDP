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
}






