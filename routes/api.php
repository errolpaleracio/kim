<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'AuthController@login');

//Route::get('/products', 'ProductController@get_all')->name('product_list');
Route::middleware('auth:api')->get('/products', 'ProductController@get_all')->name('product_list');
Route::middleware('auth:api')->get('/products/{id}', 'ProductController@get')->name('get_product');
