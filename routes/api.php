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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('apps','App\Http\Controllers\AppController@index');
Route::get('apps/free','App\Http\Controllers\AppController@showFree');
Route::get('apps/paid','App\Http\Controllers\AppController@showPaid');
Route::get('app/{id}','App\Http\Controllers\AppController@show');
Route::get('categories','App\Http\Controllers\AppController@showCategories');
Route::get('genres','App\Http\Controllers\AppController@showGenres');
Route::get('category/{category}','App\Http\Controllers\AppController@showByCategory');
Route::get('rating','App\Http\Controllers\AppController@showByRating');
Route::get('updates','App\Http\Controllers\AppController@showLastUpdates');
Route::get('search','App\Http\Controllers\AppController@search');
Route::get('test','App\Http\Controllers\AppController@create');
