<?php

use App\Http\Controllers\Api\V1\Auth\ForgoPasswordController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Auth\VerificationEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('auth.register');
Route::post('/login', LoginController::class)->middleware('web')->name('auth.login');
Route::post('/forgot-password', ForgoPasswordController::class)->name('auth.forgot-password');
Route::post('/reset-password/{token}', ResetPasswordController::class)->name('auth.password.reset');
Route::get('/email/verify/{id}/{hash}', VerificationEmailController::class)
    ->name('verification.verify');
Route::post('/logout', LogoutController::class)->name('auth.logout')
    ->middleware('auth:sanctum');
