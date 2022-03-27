<?php

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

use App\Mail\NovoAnime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/animes', 'AnimeController@index')->name('listar_animes');
Route::get('/animes/criar', 'AnimeController@create')->name('criar_anime')->middleware('autenticador');
Route::post('/animes/criar', 'AnimeController@store')->middleware('autenticador');
Route::delete('/animes/{id}', 'AnimeController@destroy')->middleware('autenticador');
Route::post('/animes/{id}/editaNome', 'AnimeController@editaNome')->middleware('autenticador');

Route::get('/animes/{animeId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->middleware('autenticador');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});

Route::get('/enviando-email', function () {
    return 'Email Enviado';
});
