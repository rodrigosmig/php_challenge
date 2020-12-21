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

Route::post('/auth/login', 'Api\\AuthController@login');
Route::post('/auth/register', 'Api\\AuthController@register');

Route::group([
    'middleware' => ['apiJwt'] 
], function() {
    Route::get('/person/{person_id}', 'Api\\PersonController@show');
    Route::get('/person', 'Api\\PersonController@index');

    Route::get('/ship-orders/{person_id}', 'Api\\ShipOrderController@show');
    Route::get('/ship-orders', 'Api\\ShipOrderController@index');
});
