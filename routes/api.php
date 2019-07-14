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

//Route::get('/products', 'ProductController@get_all')->name('product_list');
Route::get('/products', 'LookupController@get_all')->name('product_list');
Route::get('/product', 'LookupController@get')->name('get_product');
Route::get('/branch-id', 'LookupController@branch_id')->name('branch-id');
Route::post('/add-sale', 'LookupController@create_sale')->name('add-sale');
Route::post('/add-sale-item', 'LookupController@create_sale_item')->name('create_sale_item');
Route::get('/sales-items', 'LookupController@get_sale_items')->name('sale_items');