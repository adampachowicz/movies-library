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
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'API\UserController@logout');
    Route::get('user', 'API\UserController@user');
    Route::get('movies', 'API\MovieController@index')->name('movies.index');
    Route::post('movies', 'API\MovieController@store')->name('movies.store');
    Route::put('movies/{id}', 'API\MovieController@update')->name('movies.update');
    Route::delete('movies/{id}', 'API\MovieController@destroy')->name('movies.destroy');
    Route::post('movies/find', 'API\MovieController@find')->name('movies.find');
});
