<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdviceGuideFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_advice_guide_page_is_public_and_shows_core_sections(): void
    {
        $this->get('/adviesgids')
            ->assertOk()
            ->assertSee('Adviesgids')
            ->assertSee('Jouw startpunt voor een slim plan met je hond')
            ->assertSee('Zo gebruik je deze gids het best')
            ->assertSee('Veelvoorkomende situaties')
            ->assertSee('Veelgestelde vragen bij het kiezen van een route');
    }
}