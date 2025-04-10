<?php

use App\Http\Controllers\Api\PlaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('places')->group(function () {
    Route::post('/', [PlaceController::class, 'store']);
    Route::get('/', [PlaceController::class, 'index']);
    Route::get('/{slug}', [PlaceController::class, 'show']);
    Route::put('/{slug}', [PlaceController::class, 'update']);
    Route::delete('/{slug}', [PlaceController::class, 'destroy']);

});
