<?php

namespace Tests\Feature;

use App\Models\Training;
use App\Models\TrainingEnrollment;
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
            ->assertSee('Beheer overzicht')
            ->assertSee('Totaal training inschrijvingen');
    }

    public function test_beheer_search_filters_results(): void
    {
        $user = User::factory()->create();
        $training = Training::query()->create([
            'title' => 'Puppy Basis',
            'slug' => 'puppy-basis',
            'summary' => 'Basis commando\'s voor puppy\'s.',
            'capacity' => 10,
            'is_active' => true,
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'ZoekNaam',
            'email' => 'zoek@example.com',
            'dog_name' => 'Buddy',
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'AndereNaam',
            'email' => 'ander@example.com',
            'dog_name' => 'Max',
        ]);

        $this->actingAs($user)
            ->get('/beheer?q=ZoekNaam')
            ->assertOk()
            ->assertSee('ZoekNaam')
            ->assertDontSee('AndereNaam');
    }

    public function test_logged_in_user_can_export_beheer_csv(): void
    {
        $user = User::factory()->create();
        $training = Training::query()->create([
            'title' => 'Puppy Basis',
            'slug' => 'puppy-basis-export',
            'summary' => 'Test training for export.',
            'capacity' => 10,
            'is_active' => true,
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'CsvNaam',
            'email' => 'csv@example.com',
            'dog_name' => 'Rex',
        ]);

        $response = $this->actingAs($user)->get('/beheer/export?q=CsvNaam');

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $response->assertHeader('content-disposition');

        $content = $response->streamedContent();
        $this->assertStringContainsString('Training inschrijvingen', $content);
        $this->assertStringContainsString('CsvNaam', $content);
    }

    public function test_beheer_accepts_sorting_query_parameters(): void
    {
        $user = User::factory()->create();
        $training = Training::query()->create([
            'title' => 'Sort Test',
            'slug' => 'sort-test',
            'summary' => 'Sort test training.',
            'capacity' => 10,
            'is_active' => true,
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'Bravo',
            'email' => 'b@example.com',
            'dog_name' => 'Boris',
        ]);

        TrainingEnrollment::query()->create([
            'training_id' => $training->id,
            'owner_name' => 'Alpha',
            'email' => 'a@example.com',
            'dog_name' => 'Aika',
        ]);

        $this->actingAs($user)
            ->get('/beheer?sort_enrollments=owner_name&dir_enrollments=asc')
            ->assertOk()
            ->assertSee('Alpha')
            ->assertSee('Bravo');
    }

    public function test_beheer_page_accepts_sort_filter(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/beheer?sort=name_az')
            ->assertOk()
            ->assertSee('Sortering');
    }
}
