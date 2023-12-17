<?php

use App\Http\Controllers\V1\TheOddsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'v1',
], function () {
    Route::get('/countries', [TheOddsController::class, 'countries'])->name('countries');
    Route::get('/leagues/country/{id}', [TheOddsController::class, 'leagues'])->name('leagues');
});

require __DIR__.'/auth.php';
