<?php

use App\Http\Controllers\AuthController;
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
});

Route::fallback(function () {
    return redirect()->route('login');
});
