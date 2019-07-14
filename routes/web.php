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

Route::get('/', function (){
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/products', 'ProductController');

Route::get('/delete-product', 'ProductController@delete')->name('delete-product');

Route::post('/update-product/{id}', 'ProductController@update')->name('update-product');

Route::get('/show-restock/{id}', 'ProductController@show_restock')->name('show-restock');

Route::post('/restock-product', 'ProductController@restock')->name('restock-product');

Route::resource('/sales', 'SalesController');

