<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/save-my-search', [Settings::class, 'store']);
    Route::get('/get-my-search', [Settings::class, 'getMySearch']);
    Route::delete('/delete-my-search', [Settings::class, 'delete']);
});

Route::prefix('/article')->group(function () {
    Route::get('/all', [ArticleController::class, 'getLatest']);
    Route::get('/everything', [ArticleController::class, 'getEverything']);
    Route::get('/top-headlines', [ArticleController::class, 'topHeadlines']);

    Route::get('/{id}', [ArticleController::class, 'show']);
});

Route::prefix('/data')->group(function () {
    Route::get('/countries', [ArticleController::class, 'getCountriesTypes']);
    Route::get('/languages', [ArticleController::class, 'getLanguagesTypes']);
    Route::get('/categories', [ArticleController::class, 'getCategoriesTypes']);
    Route::get('/get-sort-by', [ArticleController::class, 'getSortByTypes']);
    Route::get('/sources', [ArticleController::class, 'getSources']);

});




// Route::group(['middleware' => ['auth']], function () {



// });