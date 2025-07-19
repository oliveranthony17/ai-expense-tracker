<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

Route::get('/ping', function () {
    return response()->json(
        ['pong' => true]
    );
});

Route::middleware('api.key')->group(function () {
    Route::apiResource('expenses', ExpenseController::class);
});
