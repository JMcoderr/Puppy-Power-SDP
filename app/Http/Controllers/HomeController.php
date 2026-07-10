<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Training;
use Illuminate\Database\QueryException;

// shows the landing page with some live stats from the database
class HomeController extends Controller
{
    public function index()
    {
        // count active products and trainings to show on the homepage
        try {
            $activeProducts = Product::query()->where('is_active', true)->count();
            $activeTrainings = Training::query()->where('is_active', true)->count();
        } catch (QueryException $e) {
            // if the DB is not ready yet (e.g. fresh install), use zeros
            $activeProducts = 0;
            $activeTrainings = 0;
        }

        return view('home', compact('activeProducts', 'activeTrainings'));
    }
}
