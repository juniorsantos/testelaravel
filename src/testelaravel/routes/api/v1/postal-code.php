<?php

use App\Http\Controllers\Api\V1\PostalCode\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('/{postalCode}', ShowController::class)->name('postal-code.show');
