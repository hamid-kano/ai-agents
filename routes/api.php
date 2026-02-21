<?php

use App\Http\Controllers\Api\{ArticleController, NewsController};
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/', [ArticleController::class, 'store']);
    Route::get('/{article}', [ArticleController::class, 'show']);
});

Route::prefix('news')->name('api.news.')->group(function () {
    Route::get('/discover', [NewsController::class, 'discover'])->name('discover');
    Route::post('/{newsTitle}', [NewsController::class, 'createFromNews'])->name('create');
});
