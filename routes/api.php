<?php

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\GulmaController;
use App\Http\Controllers\Api\HamaController;
use App\Http\Controllers\Api\PenyakitController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hama', 'as' => 'hama.'], function () {
    Route::get('/categories', [HamaController::class, 'getHamaCategories']);
    Route::get('/category/{hamaCategory}', [HamaController::class, 'getDetailHamaCategory']);
    Route::get('/articles', [HamaController::class, 'getArticlesByCategory']);
    Route::get('/article/{hama}', [HamaController::class, 'getDetailArticle']);
});

Route::group(['prefix' => 'penyakit', 'as' => 'penyakit.'], function () {
    Route::get('/categories', [PenyakitController::class, 'getPenyakitCategories']);
    Route::get('/category/{penyakitCategory}', [PenyakitController::class, 'getDetailPenyakitCategory']);
    Route::get('/articles', [PenyakitController::class, 'getArticlesByCategory']);
    Route::get('/article/{penyakit}', [PenyakitController::class, 'getDetailArticle']);
});

Route::group(['prefix' => 'gulma', 'as' => 'gulma.'], function () {
    Route::get('/articles', [GulmaController::class, 'getArticles']);
    Route::get('/article/{gulma}', [GulmaController::class, 'getDetailArticle']);
});

Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
    Route::get('/', [AdsController::class, 'getAds']);
});