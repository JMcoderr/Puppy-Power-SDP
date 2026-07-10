<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdviceGuideController;
use App\Http\Controllers\BeheerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DaycareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

// public pages - no authentication needed
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/adviesgids', [AdviceGuideController::class, 'index'])->name('guide.index');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// training overview and enrollment are public; content page requires login
Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
Route::post('/training/enroll', [TrainingController::class, 'enroll'])->name('training.enroll');
Route::get('/training/content', [TrainingController::class, 'content'])
    ->middleware('auth')
    ->name('training.content');

// daycare schedule and registration
Route::get('/dagopvang', [DaycareController::class, 'index'])->name('daycare.index');
Route::post('/dagopvang', [DaycareController::class, 'store'])->name('daycare.store');

// contact form
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// admin-only dashboard - requires both auth and is_admin flag
Route::get('/beheer', [BeheerController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('beheer.index');
Route::get('/beheer/export', [BeheerController::class, 'export'])
    ->middleware(['auth', 'admin'])
    ->name('beheer.export');

// authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/wachtwoord-vergeten', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/wachtwoord-vergeten', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/wachtwoord-reset/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset.form');
Route::post('/wachtwoord-reset', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/mijn-account', [AccountController::class, 'index'])->middleware('auth')->name('account.index');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
