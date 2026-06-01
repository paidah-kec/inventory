<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource(
        'categories',
        CategoryController::class
    )->except(['destroy']);

    Route::delete(
        'categories/{category}',
        [CategoryController::class, 'destroy']
    )->middleware('role:admin');

    Route::apiResource(
        'items',
        ItemController::class
    )->except(['destroy']);

    Route::delete(
        'items/{item}',
        [ItemController::class, 'destroy']
    )->middleware('role:admin');

});