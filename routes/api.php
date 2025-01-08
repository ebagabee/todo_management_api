<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/status', function () {
    return response()->json(['status' => 'Running']);
});

Route::apiResource('tasks', TaskController::class);
