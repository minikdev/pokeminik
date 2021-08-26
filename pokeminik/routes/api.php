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

Route::group(['prefix' => 'pokemon'], function () {
    Route::get("/","PokemonController@index");
    Route::get("/{id}","PokemonController@show");
    Route::get("/search/{nameOrId}","PokemonController@search");
});


Route::group(['prefix' => 'item'], function () {
    Route::get("/","ItemController@index");
    Route::get("/{id}","ItemController@show");
});
Route::group(['prefix' => 'trainer'], function () {

    Route::get("/{id}","TrainerController@show");
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/user-profile', 'AuthController@userProfile');
});
