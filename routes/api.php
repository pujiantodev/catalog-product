<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/public')->group(function () {
    Route::get('/categories/list', [\App\Http\Controllers\Api\CategoryController::class, 'listOption'])->name('api.public.categories.list');
    Route::get('/brand/list', [\App\Http\Controllers\Api\BrandController::class, 'listOption'])->name('api.public.brands.list');
});
