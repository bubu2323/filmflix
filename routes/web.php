<?php

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', 'App\Http\Controllers\UserController@profile');
Route::post('/profile', 'App\Http\Controllers\UserController@update_avatar')->name('profile');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource(
        'admin/films',
        App\Http\Controllers\FilmController::class
    );
});
Route::resource('like', App\Http\Controllers\LikeController::class);
Route::delete('likes/{id}', '@LikeController@destroy');