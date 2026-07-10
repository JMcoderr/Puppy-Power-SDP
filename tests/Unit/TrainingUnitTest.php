<?php

namespace Tests\Unit;

use App\Models\Training;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TrainingUnitTest extends TestCase
{
    public function test_training_casts_are_correct(): void
    {
        $training = new Training([
            'title' => 'Test Training',
            'slug' => 'test-training',
            'summary' => 'Samenvatting',
            'starts_on' => '2026-10-10',
            'capacity' => 8,
            'is_active' => 1,
        ]);

        $this->assertInstanceOf(Carbon::class, $training->starts_on);
        $this->assertTrue($training->is_active);
    }
}




