<?php

use Illuminate\Support\Facades\Route;

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

//filmes
Route::get('filmes', 'App\Http\Controllers\FilmesController@index')->name('filmes.list');
Route::get('filme/{id}', 'App\Http\Controllers\FilmesController@detalhes');

//users
Route::get('user/list', 'App\Http\Controllers\UserController@list')->middleware(['auth', 'verified'])->name('user.list');
Route::get('profile', 'App\Http\Controllers\UserController@index')->middleware(['auth', 'verified'])->name('user.profile');
Route::post('profile', 'App\Http\Controllers\UserController@edit')->middleware(['auth', 'verified'])->name('user.edit');
Route::patch('user/bloquear/{user}','App\Http\Controllers\UserController@bloquear')->middleware(['auth', 'verified'])->name('user.bloquear');
Route::delete('user/apagar/{user}','App\Http\Controllers\UserController@destroy')->middleware(['auth', 'verified'])->name('user.destroy');

//cart
Route::post('update-cart', 'App\Http\Controllers\CartController@updateCart')->name('cart.update');
Route::post('cart', 'App\Http\Controllers\CartController@add')->name('cart.store');
Route::get('cart', 'App\Http\Controllers\CartController@list')->name('cart.list');
Route::post('remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
