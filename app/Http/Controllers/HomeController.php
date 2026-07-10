<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Training;

class HomeController extends Controller
{
    public function index()
    {
        // simple numbers for quick overview on home
        $activeProducts = Product::query()->where('is_active', true)->count();
        $activeTrainings = Training::query()->where('is_active', true)->count();

        return view('home', compact('activeProducts', 'activeTrainings'));
    }
}
