<?php

use App\Http\Controllers\V1\TheOddsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'v1',
], function () {
    Route::get('/sports', [TheOddsController::class, 'sports'])->name('sports');
});

require __DIR__.'/auth.php';
