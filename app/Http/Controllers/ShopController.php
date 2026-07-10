<?php

namespace App\Http\Controllers;

use App\Models\Product;

// handles the public shop page
class ShopController extends Controller
{
    public function index()
    {
        // only show active products, grouped by category then name
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        return view('shop.index', compact('products'));
    }
}
