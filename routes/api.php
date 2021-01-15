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

Route::group(['prefix' => 'quotes'], function () {
    Route::get('/quotd', 'App\Http\Controllers\QuoteController@quotd');
    Route::get('/random', 'App\Http\Controllers\QuoteController@random');
    Route::get('/search', 'App\Http\Controllers\QuoteController@search');
});