<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);