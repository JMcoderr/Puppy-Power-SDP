<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopPageFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_shop_page_shows_guidance_panels(): void
    {
        $this->get('/shop')
            ->assertOk()
            ->assertSee('Wat past het best bij jouw situatie?')
            ->assertSee('Kies een cursus als je:')
            ->assertSee('Veelgekozen redenen');
    }
}
