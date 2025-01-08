<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\CommentController;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('labels', LabelController::class);
Route::apiResource('comments', CommentController::class);
