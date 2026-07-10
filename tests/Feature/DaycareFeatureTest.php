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
}




