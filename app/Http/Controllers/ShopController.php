<?php

namespace App\Http\Controllers;

use App\Models\Product;

// handles the public shop page
class ShopController extends Controller
{
    public function index()
    {
        // read simple shop filters from the query string
        $category = (string) request('category', 'all');
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
            ->when($category !== 'all', fn ($query) => $query->where('category', $category));

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
        ];

        $filters = [
            'category' => $category,
            'sort' => $sort,
        ];

        return view('shop.index', compact('products', 'categories', 'summary', 'filters'));
    }
}
