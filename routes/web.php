<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// brand
Route::prefix('/brands')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\BrandController::class, 'index'])->name('brands.index');
    Route::post('/', [\App\Http\Controllers\BrandController::class, 'store'])->name('brands.store');
    Route::patch('/{id}', [\App\Http\Controllers\BrandController::class, 'update'])->name('brands.update');
    Route::delete('/{id}', [\App\Http\Controllers\BrandController::class, 'destroy'])->name('brands.destroy');
});
// brand
Route::prefix('/categories')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::patch('/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
});
