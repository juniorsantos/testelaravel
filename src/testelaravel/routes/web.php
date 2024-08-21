<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ForgotController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('web')->group(function () {
    Route::get('/login', LoginController::class)->name('login');
});

Route::get('/', IndexController::class)->name('home.index');
Route::get('/', RegisterController::class)->name('home.register');
Route::get('/forgot', ForgotController::class)->name('home.forgot');

Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard.index');
});
