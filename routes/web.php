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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//filmes
Route::get('filmes', 'App\Http\Controllers\FilmesController@index')->name('filmes.list');
Route::get('filme/{id}', 'App\Http\Controllers\FilmesController@detalhes');
Route::get('filmes/lista', 'App\Http\Controllers\filmesController@list')->middleware(['auth', 'verified'])->name('filme.lista');
Route::get('filme/{filme}/edit', 'App\Http\Controllers\filmesController@edit')->middleware(['auth', 'verified'])->name('filme.edit');
Route::delete('filme/apagar/{filme}','App\Http\Controllers\filmesController@destroy')->middleware(['auth', 'verified'])->name('filme.destroy');
Route::get('filmes/lista/create', 'App\Http\Controllers\filmesController@create')->name('filmes.create')->middleware(['auth', 'verified']);
Route::post('filmes', 'App\Http\Controllers\filmesController@store')->middleware(['auth', 'verified'])->name('filmes.store');
Route::put('fiilme/{filme}/update', 'App\Http\Controllers\filmesController@update')->name('filme.update')->middleware(['auth', 'verified']);


//users
Route::get('user/list', 'App\Http\Controllers\UserController@list')->middleware(['auth', 'verified'])->name('user.list');
Route::get('profile', 'App\Http\Controllers\UserController@index')->middleware(['auth', 'verified'])->name('user.profile');
Route::post('profile', 'App\Http\Controllers\UserController@edit')->middleware(['auth', 'verified'])->name('user.edit');
Route::patch('user/bloquear/{user}','App\Http\Controllers\UserController@bloquear')->middleware(['auth', 'verified'])->name('user.bloquear');
Route::delete('user/apagar/{user}','App\Http\Controllers\UserController@destroy')->middleware(['auth', 'verified'])->name('user.destroy');
 
//Salas
Route::get('salas/list', 'App\Http\Controllers\salasController@list')->middleware(['auth', 'verified'])->name('sala.list');
Route::put('salas/{sala}/update', 'App\Http\Controllers\salasController@update')->name('sala.update')->middleware(['auth', 'verified']);
Route::get('sala/{sala}/edit', 'App\Http\Controllers\salasController@edit')->middleware(['auth', 'verified'])->name('sala.edit');
Route::delete('sala/apagar/{sala}','App\Http\Controllers\salasController@destroy')->middleware(['auth', 'verified'])->name('sala.destroy');
Route::get('salas/lista/create', 'App\Http\Controllers\salasController@create')->name('salas.create')->middleware(['auth', 'verified']);
Route::post('salas', 'App\Http\Controllers\salasController@store')->name('salas.store')->middleware(['auth', 'verified']);

//cart
Route::post('update-cart', 'App\Http\Controllers\CartController@updateCart')->name('cart.update');
Route::post('cart', 'App\Http\Controllers\CartController@add')->name('cart.store');
Route::get('cart', 'App\Http\Controllers\CartController@list')->name('cart.list');
Route::post('remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');

//checkout
Route::get('checkout/create','App\Http\Controllers\CheckoutsController@create')->name('checkout.create');

//historico
Route::get('bilhetes/list','App\Http\Controllers\BilhetesController@list')->name('historico.listB');
Route::get('checkout/list','App\Http\Controllers\CheckoutsController@index')->name('checkout.list');

//PDF
Route::get('checkout/pdf/{ckeckout}','App\Http\Controllers\CheckoutsController@create')->name('checkout.pdf');

//sessao
Route::get('controlo', 'App\Http\Controllers\SessaoController@index')->name('controlo');
Route::get('controlo/get_sessao/{id}', 'App\Http\Controllers\SessaoController@get_sessao')->name('controlo.sessao');

Route::get('sessoes/list', 'App\Http\Controllers\sessaoController@list')->middleware(['auth', 'verified'])->name('sessao.list');
Route::get('Sessao/{sessao}/edit', 'App\Http\Controllers\SessaoController@edit')->middleware(['auth', 'verified'])->name('sessao.edit');
Route::delete('sessao/apagar/{sessao}','App\Http\Controllers\SessaoController@destroy')->middleware(['auth', 'verified'])->name('sessao.destroy');
Route::get('sessoes/lista/create', 'App\Http\Controllers\SessaoController@create')->name('sessoes.create')->middleware(['auth', 'verified']);
Route::post('sessoes', 'App\Http\Controllers\SessaoController@store')->name('sessoes.store')->middleware(['auth', 'verified']);
Route::put('sessao/{sessao}/update', 'App\Http\Controllers\SessaoController@update')->name('sessao.update')->middleware(['auth', 'verified']);

//admin
Route::get('admin', 'App\Http\Controllers\ConfiguracaoController@index')->middleware(['auth', 'verified'])->name('config');
Route::post('admin', 'App\Http\Controllers\ConfiguracaoController@edit')->middleware(['auth', 'verified'])->name('config.edit');


Auth::routes(['verify' => true]);


