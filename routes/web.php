<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GulmaController;
use App\Http\Controllers\HamaCategoryController;
use App\Http\Controllers\HamaController;
use App\Http\Controllers\PenyakitCategoryController;
use App\Http\Controllers\PenyakitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'hama', 'as' => 'hama.'], function () {
        Route::get('/', [HamaController::class, 'index'])->name('index');
        Route::get('/create', [HamaController::class, 'createPage'])->name('create.page');
        Route::get('/edit/{hama:id}', [HamaController::class, 'editPage'])->name('edit.page');
        Route::post('/create', [HamaController::class, 'create'])->name('create');
        Route::post('/edit/{hama:id}', [HamaController::class, 'edit'])->name('edit');
        Route::delete('/delete/{hama:id}', [HamaController::class, 'delete'])->name('delete');
        Route::get('/data', [HamaController::class, 'datatables'])->name('datatables');
    });

    Route::group(['prefix' => 'hama/category', 'as' => 'hama.category.'], function () {
        Route::get('/', [HamaCategoryController::class, 'index'])->name('index');
        Route::post('/create', [HamaCategoryController::class, 'create'])->name('create');
        Route::patch('/edit/{category:id}', [HamaCategoryController::class, 'edit'])->name('edit');
        Route::delete('/{category:id}', [HamaCategoryController::class, 'delete'])->name('delete');
        Route::get('/data', [HamaCategoryController::class, 'datatables'])->name('datatables');
    });

    Route::group(['prefix' => 'penyakit', 'as' => 'penyakit.'], function () {
        Route::get('/', [PenyakitController::class, 'index'])->name('index');
        Route::get('/create', [PenyakitController::class, 'createPage'])->name('create.page');
        Route::get('/edit/{penyakit:id}', [PenyakitController::class, 'editPage'])->name('edit.page');
        Route::post('/create', [PenyakitController::class, 'create'])->name('create');
        Route::post('/edit/{penyakit:id}', [PenyakitController::class, 'edit'])->name('edit');
        Route::delete('/delete/{penyakit:id}', [PenyakitController::class, 'delete'])->name('delete');
        Route::get('/data', [PenyakitController::class, 'datatables'])->name('datatables');
    });

    Route::group(['prefix' => 'penyakit/category', 'as' => 'penyakit.category.'], function () {
        Route::get('/', [PenyakitCategoryController::class, 'index'])->name('index');
        Route::post('/create', [PenyakitCategoryController::class, 'create'])->name('create');
        Route::patch('/edit/{category:id}', [PenyakitCategoryController::class, 'edit'])->name('edit');
        Route::delete('/{category:id}', [PenyakitCategoryController::class, 'delete'])->name('delete');
        Route::get('/data', [PenyakitCategoryController::class, 'datatables'])->name('datatables');
    });

    Route::group(['prefix' => 'gulma', 'as' => 'gulma.'], function () {
        Route::get('/', [GulmaController::class, 'index'])->name('index');
        Route::get('/create', [GulmaController::class, 'createPage'])->name('create.page');
        Route::get('/edit/{gulma:id}', [GulmaController::class, 'editPage'])->name('edit.page');
        Route::post('/create', [GulmaController::class, 'create'])->name('create');
        Route::post('/edit/{gulma:id}', [GulmaController::class, 'edit'])->name('edit');
        Route::delete('/delete/{gulma:id}', [GulmaController::class, 'delete'])->name('delete');
        Route::get('/data', [GulmaController::class, 'datatables'])->name('datatables');
    });

    Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::get('/', [AdsController::class, 'index'])->name('index');
        Route::post('/create', [AdsController::class, 'create'])->name('create');
        Route::delete('/delete/{ads:id}', [AdsController::class, 'delete'])->name('delete');
        Route::get('/data', [AdsController::class, 'datatables'])->name('datatables');
    });
});

Route::fallback(function () {
    return redirect()->route('login');
});
