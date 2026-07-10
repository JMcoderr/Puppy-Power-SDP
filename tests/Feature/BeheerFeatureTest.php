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

    // helper to quickly create an admin user in each test
    private function adminUser(): User
    {
        return User::factory()->admin()->create();
    }

    public function test_beheer_page_requires_login(): void
    {
        // unauthenticated visitors should be redirected to the login page
        $this->get('/beheer')->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_beheer(): void
    {
        // a regular (non-admin) user must get a 403 forbidden response
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get('/beheer')
            ->assertForbidden();
    }

    public function test_logged_in_user_can_open_beheer_page(): void
    {
        $user = $this->adminUser();

        $this->actingAs($user)
            ->get('/beheer')
            ->assertOk()
            ->assertSee('Beheer overzicht')
            ->assertSee('Totaal training inschrijvingen')
            ->assertSee('Operationele inzichten')
            ->assertSee('Contactverdeling');
    }

    public function test_beheer_search_filters_results(): void
    {
        $user = $this->adminUser();
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

    public function test_beheer_shows_breakdowns_for_contact_and_daycare(): void
    {
        $user = $this->adminUser();

        \App\Models\ContactMessage::query()->create([
            'name' => 'Lisa',
            'email' => 'lisa@example.com',
            'subject' => 'Vraag over training',
            'message' => 'Welke training past bij mijn pup?',
        ]);

        \App\Models\DaycareRegistration::query()->create([
            'owner_name' => 'Tom',
            'email' => 'tom@example.com',
            'dog_name' => 'Bo',
            'drop_off_date' => now()->addDay()->toDateString(),
            'time_slot' => 'Ochtend',
            'notes' => 'Rustige hond',
        ]);

        $this->actingAs($user)
            ->get('/beheer')
            ->assertOk()
            ->assertSee('Vraag over training')
            ->assertSee('Ochtend');
    }

    public function test_logged_in_user_can_export_beheer_csv(): void
    {
        $user = $this->adminUser();
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
        $user = $this->adminUser();
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
        $user = $this->adminUser();

        $this->actingAs($user)
            ->get('/beheer?sort=name_az')
            ->assertOk()
            ->assertSee('Sortering');
    }

    public function test_beheer_reversed_date_range_gets_adjusted_with_feedback(): void
    {
        $user = $this->adminUser();

        $this->actingAs($user)
            ->get('/beheer?from=2026-12-31&to=2026-01-01')
            ->assertOk()
            ->assertSee('Datumbereik is automatisch omgedraaid');
    }

    public function test_non_admin_user_gets_forbidden_on_beheer_page(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->actingAs($user)
            ->get('/beheer')
            ->assertForbidden();
    }
}
