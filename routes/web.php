<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

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
Route::get('filmes/lista/create', 'App\Http\Controllers\filmesController@create')->middleware(['auth', 'verified'])->name('filmes.create');
Route::post('filmes', 'App\Http\Controllers\filmesController@store')->middleware(['auth', 'verified'])->name('filmes.store');
Route::put('filme/{filme}/update', 'App\Http\Controllers\filmesController@update')->middleware(['auth', 'verified'])->name('filme.update');


//users
Route::get('user/list', 'App\Http\Controllers\UserController@list')->middleware(['auth', 'verified'])->name('user.list');
Route::get('profile', 'App\Http\Controllers\UserController@index')->middleware(['auth', 'verified'])->name('user.profile');
Route::post('profile', 'App\Http\Controllers\UserController@edit')->middleware(['auth', 'verified'])->name('user.edit');
Route::patch('user/bloquear/{user}','App\Http\Controllers\UserController@bloquear')->middleware(['auth', 'verified'])->name('user.bloquear');
Route::delete('user/apagar/{user}','App\Http\Controllers\UserController@destroy')->middleware(['auth', 'verified'])->name('user.destroy');
##
Route::put('users/{user}/update', 'App\Http\Controllers\userController@update')->middleware(['auth', 'verified'])->name('user.update');
Route::get('user/{user}/edit', 'App\Http\Controllers\userController@edit2')->middleware(['auth', 'verified'])->name('user.edit2');
Route::get('user/user/create', 'App\Http\Controllers\userController@create')->middleware(['auth', 'verified'])->name('user.create');
Route::post('users', 'App\Http\Controllers\userController@store')->middleware(['auth', 'verified'])->name('user.store');
Route::delete('user/apagar/{user}','App\Http\Controllers\UserController@destroy2')->middleware(['auth', 'verified'])->name('user.destroy2');

 


//Salas
Route::get('salas/list', 'App\Http\Controllers\salasController@list')->middleware(['auth', 'verified'])->name('sala.list');
Route::put('salas/{sala}/update', 'App\Http\Controllers\salasController@update')->middleware(['auth', 'verified'])->name('sala.update');
Route::get('sala/{sala}/edit', 'App\Http\Controllers\salasController@edit')->middleware(['auth', 'verified'])->name('sala.edit');
Route::delete('sala/apagar/{sala}','App\Http\Controllers\salasController@destroy')->middleware(['auth', 'verified'])->name('sala.destroy');
Route::get('salas/lista/create', 'App\Http\Controllers\salasController@create')->middleware(['auth', 'verified'])->name('salas.create');
Route::post('salas', 'App\Http\Controllers\salasController@store')->middleware(['auth', 'verified'])->name('salas.store');

//Generos
Route::get('generos/list', 'App\Http\Controllers\generosController@list')->middleware(['auth', 'verified'])->name('genero.list');
Route::put('generos/{genero}/update', 'App\Http\Controllers\generosController@update')->middleware(['auth', 'verified'])->name('genero.update');
Route::get('genero/{genero}/edit', 'App\Http\Controllers\generosController@edit')->middleware(['auth', 'verified'])->name('genero.edit');
Route::delete('genero/apagar/{genero}','App\Http\Controllers\generosController@destroy')->middleware(['auth', 'verified'])->name('genero.destroy');
Route::get('generos/lista/create', 'App\Http\Controllers\generosController@create')->middleware(['auth', 'verified'])->name('generos.create');
Route::post('generos', 'App\Http\Controllers\generosController@store')->middleware(['auth', 'verified'])->name('generos.store');

//cart
Route::post('update-cart', 'App\Http\Controllers\CartController@updateCart')->name('cart.update');
Route::post('cart', 'App\Http\Controllers\CartController@add')->name('cart.store');
Route::get('cart', 'App\Http\Controllers\CartController@list')->name('cart.list');
Route::post('remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');

//checkout
Route::get('checkout/create','App\Http\Controllers\CheckoutsController@create')->name('checkout.create');
Route::post('checkout/store','App\Http\Controllers\CheckoutsController@store')->name('checkout.store');


//historico
Route::get('bilhetes/list','App\Http\Controllers\BilhetesController@list')->name('historico.listB');
Route::get('recibos/list','App\Http\Controllers\CheckoutsController@index')->name('historico.list');

//PDF
Route::get('checkout/pdf_recibo','App\Http\Controllers\CheckoutsController@pdf_recibo')->name('pdf.pdf_recibo.blade');
Route::get('checkout/pdf_bilhete','App\Http\Controllers\CheckoutsController@pdf_bilhete')->name('pdf.pdf_bilhete.blade');


//Email

Route::get('invoices/{id}', 'App\Http\Controllers\InvoiceController@show')->name('invoices.show');

Route::post('email/notification/1', 'App\Http\Controllers\EmailController@send_email_with_notification1')->name('email.send_with_notification1');
//sessao
Route::get('controlo', 'App\Http\Controllers\SessaoController@index')->name('controlo');
Route::get('controlo/get_data/{id}', 'App\Http\Controllers\SessaoController@get_data')->name('controlo.data');
Route::get('controlo/get_horario/{id}/{data}', 'App\Http\Controllers\SessaoController@get_horario')->name('controlo.horario');
Route::get('controlo/{sessao}', 'App\Http\Controllers\SessaoController@sessao')->name('controlo.sessao');
Route::post('controlo/bilhete', 'App\Http\Controllers\SessaoController@bilhete')->name('encontra.bilhete');
Route::post('controlo/bilhete/validar', 'App\Http\Controllers\BilhetesController@valida_bilhete')->name('bilhete');

Route::get('sessoes/list', 'App\Http\Controllers\sessaoController@list')->middleware(['auth', 'verified'])->name('sessao.list');
Route::get('Sessao/{sessao}/edit', 'App\Http\Controllers\SessaoController@edit')->middleware(['auth', 'verified'])->name('sessao.edit');
Route::delete('sessao/apagar/{sessao}','App\Http\Controllers\SessaoController@destroy')->middleware(['auth', 'verified'])->name('sessao.destroy');
Route::get('sessoes/lista/create', 'App\Http\Controllers\SessaoController@create')->name('sessoes.create')->middleware(['auth', 'verified']);
Route::post('sessoes', 'App\Http\Controllers\SessaoController@store')->name('sessoes.store')->middleware(['auth', 'verified']);
Route::put('sessao/{sessao}/update', 'App\Http\Controllers\SessaoController@update')->name('sessao.update')->middleware(['auth', 'verified']);

//admin
Route::get('admin', 'App\Http\Controllers\ConfiguracaoController@index')->middleware(['auth', 'verified'])->name('config');
Route::post('admin', 'App\Http\Controllers\ConfiguracaoController@edit')->middleware(['auth', 'verified'])->name('config.edit');


//Estatisticas
Route::get('estatisticas','App\Http\Controllers\EstatisticasController@index')->middleware(['auth', 'verified'])->name('estatisticas.index');
Route::get('pagamentos','App\Http\Controllers\EstatisticasController@pagamentos')->middleware(['auth', 'verified'])->name('pagamentos.index');

Auth::routes(['verify' => true]);


