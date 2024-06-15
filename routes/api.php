<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });
});

Route::middleware('user')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'product', 'as' => 'penyakit.'], function () {
    Route::get('/categories', [ProductController::class, 'getProductCategories']);
    Route::get('/category/{penyakitCategory}', [ProductController::class, 'getDetailProductCategory']);
    Route::get('/articles', [ProductController::class, 'getArticlesByCategory']);
    Route::get('/article/{penyakit}', [ProductController::class, 'getDetailArticle']);
});