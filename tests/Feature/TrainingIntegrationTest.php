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

    public function test_training_page_shows_available_spots(): void
    {
        // create a training with 5 capacity and 2 enrollments, expect 3 shown
        $training = Training::query()->create([
            'title' => 'Gedragstraining',
            'slug' => 'gedragstraining-spots',
            'summary' => 'Spots test.',
            'starts_on' => '2026-10-01',
            'capacity' => 5,
            'is_active' => true,
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'Eigenaar A',
            'email' => 'a@test.nl',
            'dog_name' => 'Hond A',
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'Eigenaar B',
            'email' => 'b@test.nl',
            'dog_name' => 'Hond B',
        ]);

        $this->get('/training')
            ->assertOk()
            ->assertSee('3 van 5');
    }

    public function test_training_page_shows_filter_and_summary_sections(): void
    {
        $this->get('/training')
            ->assertOk()
            ->assertSee('Filter en sorteer')
            ->assertSee('Actieve trainingen')
            ->assertSee('Open inschrijvingen')
            ->assertSee('Zo bereid je je goed voor op een training')
            ->assertSee('Training veelgestelde vragen');
    }

    public function test_training_page_can_filter_full_trainings(): void
    {
        $fullTraining = Training::query()->create([
            'title' => 'Volle training',
            'slug' => 'volle-training',
            'summary' => 'Geen plekken meer',
            'starts_on' => '2026-11-01',
            'capacity' => 1,
            'is_active' => true,
        ]);

        $openTraining = Training::query()->create([
            'title' => 'Open training',
            'slug' => 'open-training',
            'summary' => 'Nog plekken vrij',
            'starts_on' => '2026-11-02',
            'capacity' => 3,
            'is_active' => true,
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $fullTraining->id,
            'owner_name' => 'Tester',
            'email' => 'tester@test.nl',
            'dog_name' => 'Rex',
        ]);

        $this->get('/training?availability=full')
            ->assertOk()
            ->assertSee('Volle training')
            ->assertDontSee('Open training');
    }

    public function test_training_page_can_filter_by_focus(): void
    {
        Training::query()->create([
            'title' => 'Puppytraining',
            'slug' => 'puppytraining',
            'summary' => 'Basis',
            'starts_on' => '2026-09-01',
            'capacity' => 10,
            'is_active' => true,
        ]);

        Training::query()->create([
            'title' => 'Gedragstraining',
            'slug' => 'gedragstraining',
            'summary' => 'Gedrag',
            'starts_on' => '2026-09-02',
            'capacity' => 10,
            'is_active' => true,
        ]);

        $this->get('/training?focus=gedrag')
            ->assertOk()
            ->assertSee('Gedragstraining')
            ->assertDontSee('Puppytraining');
    }
}



