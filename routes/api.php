<?php

use App\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as FacadesRoute;

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

FacadesRoute::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

FacadesRoute::get('/animes', function () {
    return Anime::all();
});
