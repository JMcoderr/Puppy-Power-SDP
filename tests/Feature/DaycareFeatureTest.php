<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DaycareFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_daycare_form_rejects_past_date(): void
    {
        $response = $this->post('/dagopvang', [
            'owner_name' => 'Yasmin',
            'email' => 'Yasmin@test.nl',
            'dog_name' => 'Snowy',
            'drop_off_date' => Carbon::yesterday()->toDateString(),
            'time_slot' => 'Ochtend',
            'notes' => 'Geen',
        ]);

        $response->assertSessionHasErrors('drop_off_date');

        $this->assertDatabaseMissing('daycare_registrations', [
            'email' => 'Yasmin@test.nl',
            'dog_name' => 'Snowy',
        ]);
    }

    public function test_daycare_page_shows_schedule_table_and_info_block(): void
    {
        // check that the schedule table and the why-daycare info block are visible
        $this->get('/dagopvang')
            ->assertOk()
            ->assertSee('Beschikbare planning')
            ->assertSee('Waarom dagopvang bij ons?')
            ->assertSee('Kleine groepen van maximaal 6 honden')
            ->assertSee('Beschikbare dagen')
            ->assertSee('Intake checklist');
    }

    public function test_daycare_form_stores_valid_registration(): void
    {
        $response = $this->post('/dagopvang', [
            'owner_name' => 'Lars',
            'email' => 'lars@test.nl',
            'dog_name' => 'Boris',
            'drop_off_date' => Carbon::tomorrow()->toDateString(),
            'time_slot' => 'Hele dag',
            'notes' => null,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('daycare_registrations', [
            'email' => 'lars@test.nl',
            'dog_name' => 'Boris',
            'time_slot' => 'Hele dag',
        ]);
    }
}




