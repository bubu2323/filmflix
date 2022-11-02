<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('films', App\Http\Controllers\FilmController::class);
Route::apiResource('pivot', App\Http\Controllers\CategoryFilmController::class);
Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
Route::apiResource('likes', App\Http\Controllers\LikeController::class);
