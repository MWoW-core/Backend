<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsCategoryIndex;
use App\Http\Controllers\ShowAuthenticatedUser;
use App\Http\Controllers\ChangePasswordController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', ShowAuthenticatedUser::class)->name('user');

    Route::middleware('throttle:3,1')
        ->post('/change-password', ChangePasswordController::class)
        ->name('change-password.store');

    Route::post('/news', [NewsController::class, 'store'])
        ->name('news.store');

    Route::match(['PUT', 'PATCH'], '/news/{news}', [NewsController::class, 'update'])
        ->name('news.update');

    Route::delete('/news/{news}', [NewsController::class, 'destroy'])
        ->name('news.destroy');

    Route::post('comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::match(['PUT', 'PATCH'], '/comments/{comment}', [CommentController::class, 'update'])
        ->name('comments.update');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

Route::get('news-categories', NewsCategoryIndex::class)->name('news-categories');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
