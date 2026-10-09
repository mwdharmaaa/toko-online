<?php

use App\Http\Controllers\Api\ApiBlogController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/settings', [ApiSettingController::class, 'index'])->name('api.settings');
    Route::get('/products', [ApiProductController::class, 'index'])->name('api.products.index');
    Route::get('/products/{slug}', [ApiProductController::class, 'show'])->name('api.products.show');
    Route::get('/categories', [ApiCategoryController::class, 'index'])->name('api.categories.index');
    Route::get('/blog', [ApiBlogController::class, 'index'])->name('api.blog.index');
    Route::get('/blog/{slug}', [ApiBlogController::class, 'show'])->name('api.blog.show');
});
