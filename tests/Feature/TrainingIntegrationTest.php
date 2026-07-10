<?php

namespace Tests\Feature;

use App\Models\Training;
use App\Models\TrainingEnrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrainingIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_training_has_enrollments_relation(): void
    {
        $training = Training::query()->create([
            'title' => 'Puppy Basis',
            'slug' => 'puppy-basis',
            'summary' => 'Basis gehoorzaamheid',
            'starts_on' => '2026-09-01',
            'capacity' => 10,
            'is_active' => true,
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'Jordy',
            'email' => 'Jordy@test.nl',
            'dog_name' => 'Mauwie',
            'phone' => '0610609212',
            'notes' => null,
        ]);

        $freshTraining = Training::with('enrollments')->findOrFail($training->id);

        $this->assertCount(1, $freshTraining->enrollments);
        $this->assertSame('Mauwie', $freshTraining->enrollments->first()->dog_name);
    }
}



