<?php

use App\Http\Controllers\Api\V1\User\IndexController;
use App\Http\Controllers\Api\V1\User\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('users.index');
Route::get('/{user:ulid}', ShowController::class)->name('users.show');
