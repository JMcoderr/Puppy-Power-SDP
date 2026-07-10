<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeheerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DaycareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
Route::post('/training/enroll', [TrainingController::class, 'enroll'])->name('training.enroll');
Route::get('/training/content', [TrainingController::class, 'content'])
    ->middleware('auth')
    ->name('training.content');

Route::get('/dagopvang', [DaycareController::class, 'index'])->name('daycare.index');
Route::post('/dagopvang', [DaycareController::class, 'store'])->name('daycare.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/beheer', [BeheerController::class, 'index'])
    ->middleware('auth')
    ->name('beheer.index');
Route::get('/beheer/export', [BeheerController::class, 'export'])
    ->middleware('auth')
    ->name('beheer.export');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
