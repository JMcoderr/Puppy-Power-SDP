<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Training;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    public function index()
    {
        // simple numbers for quick overview on home
        try {
            $activeProducts = Product::query()->where('is_active', true)->count();
            $activeTrainings = Training::query()->where('is_active', true)->count();
        } catch (QueryException $e) {
            // fallback when tables are not ready yet
            $activeProducts = 0;
            $activeTrainings = 0;
        }

        return view('home', compact('activeProducts', 'activeTrainings'));
    }
}
