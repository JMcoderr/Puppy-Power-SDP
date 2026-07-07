<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
Route::post('/training/enroll', [TrainingController::class, 'enroll'])->name('training.enroll');
Route::get('/training/content', [TrainingController::class, 'content'])
    ->middleware('auth')
    ->name('training.content');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
