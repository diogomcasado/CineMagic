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

Route::get('filmes/lista', 'App\Http\Controllers\filmesController@list')->middleware(['auth', 'verified'])->name('filme.lista');
// Route::get('profile', 'App\Http\Controllers\filmesController@index2')->middleware(['auth', 'verified'])->name('filme.profile');
// Route::post('profile', 'App\Http\Controllers\filmesController@edit')->middleware(['auth', 'verified'])->name('filme.edit');
Route::delete('filme/apagar/{filme}','App\Http\Controllers\filmesController@destroy')->middleware(['auth', 'verified'])->name('filme.destroy');


//users
Route::get('user/list', 'App\Http\Controllers\UserController@list')->middleware(['auth', 'verified'])->name('user.list');
Route::get('profile', 'App\Http\Controllers\UserController@index')->middleware(['auth', 'verified'])->name('user.profile');
Route::post('profile', 'App\Http\Controllers\UserController@edit')->middleware(['auth', 'verified'])->name('user.edit');
Route::patch('user/bloquear/{user}','App\Http\Controllers\UserController@bloquear')->middleware(['auth', 'verified'])->name('user.bloquear');
Route::delete('user/apagar/{user}','App\Http\Controllers\UserController@destroy')->middleware(['auth', 'verified'])->name('user.destroy');
 
//Salas
Route::get('salas/list', 'App\Http\Controllers\salasController@list')->middleware(['auth', 'verified'])->name('sala.list');
// Route::get('profile', 'App\Http\Controllers\filmesController@index2')->middleware(['auth', 'verified'])->name('filme.profile');
// Route::post('profile', 'App\Http\Controllers\filmesController@edit')->middleware(['auth', 'verified'])->name('filme.edit');
Route::delete('sala/apagar/{sala}','App\Http\Controllers\SalaController@destroy')->middleware(['auth', 'verified'])->name('sala.destroy');


//cart
Route::post('update-cart', 'App\Http\Controllers\CartController@updateCart')->name('cart.update');
Route::post('cart', 'App\Http\Controllers\CartController@add')->name('cart.store');
Route::get('cart', 'App\Http\Controllers\CartController@list')->name('cart.list');
Route::post('remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');

//admin
Route::get('admin', 'App\Http\Controllers\ConfiguracaoController@index')->middleware(['auth', 'verified'])->name('config');
Route::post('admin', 'App\Http\Controllers\ConfiguracaoController@edit')->middleware(['auth', 'verified'])->name('config.edit');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
