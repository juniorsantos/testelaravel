<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    require __DIR__.'/api/v1/auth.php';
});

Route::prefix('users')->middleware(['auth:sanctum', 'verified'])->group(function () {
    require __DIR__.'/api/v1/users.php';
});

Route::prefix('postal-code')->group(function () {
    require __DIR__.'/api/v1/postal-code.php';
});
