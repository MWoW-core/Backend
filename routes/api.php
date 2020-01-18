<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowAuthenticatedUser;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryIndex;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:airlock')->group(function () {
    Route::get('/user', ShowAuthenticatedUser::class)->name('user');

    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::match(['PUT', 'PATCH'], '/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});

Route::get('news-categories', NewsCategoryIndex::class)->name('news-categories');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
