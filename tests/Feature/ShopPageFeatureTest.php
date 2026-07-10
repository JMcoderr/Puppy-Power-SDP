<?php

namespace Tests\Feature;

use App\Models\Product;
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

    public function test_shop_page_shows_filter_section_and_summary_cards(): void
    {
        $this->get('/shop')
            ->assertOk()
            ->assertSee('Filter en sorteer')
            ->assertSee('Actieve producten')
            ->assertSee('Cursussen')
            ->assertSee('DIY-pakketten');
    }

    public function test_shop_page_filters_products_by_category(): void
    {
        Product::query()->create([
            'name' => 'Cursus A',
            'category' => 'Cursus',
            'description' => 'Test cursus',
            'price' => 10,
            'is_active' => true,
        ]);

        Product::query()->create([
            'name' => 'DIY B',
            'category' => 'DIY-pakket',
            'description' => 'Test pakket',
            'price' => 20,
            'is_active' => true,
        ]);

        $this->get('/shop?category=Cursus')
            ->assertOk()
            ->assertSee('Cursus A')
            ->assertDontSee('DIY B');
    }
}
