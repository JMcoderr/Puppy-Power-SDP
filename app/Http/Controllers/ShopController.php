<?php

namespace App\Http\Controllers;

use App\Models\Product;

// handles the public shop page
class ShopController extends Controller
{
    public function index()
    {
        // read simple shop filters from the query string
        $search = trim((string) request('q', ''));
        $category = (string) request('category', 'all');
        $budget = (string) request('budget', 'all');
        $sort = (string) request('sort', 'name');

        // get all active categories so the filter dropdown can be generated dynamically
        $categories = Product::query()
            ->where('is_active', true)
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        // base query for products that are visible in the shop
        $productsQuery = Product::query()
            ->where('is_active', true)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($category !== 'all', fn ($query) => $query->where('category', $category))
            ->when($budget === 'under_50', fn ($query) => $query->where('price', '<', 50))
            ->when($budget === '50_80', fn ($query) => $query->whereBetween('price', [50, 80]))
            ->when($budget === 'above_80', fn ($query) => $query->where('price', '>', 80));

        // sort products based on the selected option
        $products = match ($sort) {
            'price_low' => (clone $productsQuery)->orderBy('price')->orderBy('name')->get(),
            'price_high' => (clone $productsQuery)->orderByDesc('price')->orderBy('name')->get(),
            'category' => (clone $productsQuery)->orderBy('category')->orderBy('name')->get(),
            default => (clone $productsQuery)->orderBy('name')->get(),
        };

        // summary blocks shown above the product list
        $summary = [
            'total' => $products->count(),
            'courses' => Product::query()->where('is_active', true)->where('category', 'Cursus')->count(),
            'kits' => Product::query()->where('is_active', true)->where('category', 'DIY-pakket')->count(),
            'lowestPrice' => Product::query()->where('is_active', true)->min('price'),
        ];

        $filters = [
            'q' => $search,
            'category' => $category,
            'budget' => $budget,
            'sort' => $sort,
        ];

        return view('shop.index', compact('products', 'categories', 'summary', 'filters'));
    }
}
