<?php

namespace Tests\Unit;

use App\Models\DaycareRegistration;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DaycareUnitTest extends TestCase
{
    public function test_drop_off_date_is_cast_to_date(): void
    {
        $registration = new DaycareRegistration([
            'owner_name' => 'Yasmin',
            'email' => 'Yasmin@test.nl',
            'dog_name' => 'Adam',
            'drop_off_date' => '2026-11-05',
            'time_slot' => 'Middag',
            'notes' => null,
        ]);

        $this->assertInstanceOf(Carbon::class, $registration->drop_off_date);
    }
}





