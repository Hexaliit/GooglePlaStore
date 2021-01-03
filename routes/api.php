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

Route::get('apps','App\Http\Controllers\AppController@index');
Route::get('apps/free','App\Http\Controllers\AppController@showFree');
Route::get('apps/paid','App\Http\Controllers\AppController@showPaid');
Route::get('app/{id}','App\Http\Controllers\AppController@show');
Route::get('categories','App\Http\Controllers\AppController@showCategories');
Route::get('genres','App\Http\Controllers\AppController@showGenres');
Route::get('genre/{genre}','App\Http\Controllers\AppController@showByGenre');
Route::get('category/{category}','App\Http\Controllers\AppController@showByCategory');
Route::get('rating','App\Http\Controllers\AppController@showByRating');
Route::get('search','App\Http\Controllers\AppController@search');
Route::post('comment/{id}','App\Http\Controllers\AppController@postComment');
