<?php
use Illuminate\Support\Facades\Route;
Route::apiResource('categories', 'CategoryController::class');
Route::apiResource('items', 'ItemController::class');