<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; // <--- TAMBAHKAN BARIS INI
use App\Http\Controllers\ItemController;     // <--- DAN INI JUGA

Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);

