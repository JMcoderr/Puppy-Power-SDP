<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_trust_section_and_quick_start_panel(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Waarom klanten kiezen voor ons')
            ->assertSee('Snel starten?')
            ->assertSee('Persoonlijk');
    }
}
