<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Training;

// simple member dashboard with quick actions and account overview
class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $summary = [
            'products' => Product::query()->where('is_active', true)->count(),
            'trainings' => Training::query()->where('is_active', true)->count(),
            'role' => $user->is_admin ? 'Administrator' : 'Lid',
        ];

        return view('account.index', compact('user', 'summary'));
    }
}
