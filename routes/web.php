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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/products/{category_id?}', 'ProductController@index')->name('products.index');
Route::get('/item/create', 'ProductController@create')->name('product');
//Route::get('/item/show/{id}', 'ProductController@show')->name('product-show');
//Route::get('/item/edit/{id}', 'ProductController@edit')->name('product-edit');

Route::get('/basket', 'BasketController@index')->name('basket');
Route::post('/basket/add/{id}', 'BasketController@basketAdd')->name('basket-add');
Route::post('/basket/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
Route::get('/basket/place', 'BasketController@basketPlace')->name('basket-place');
Route::post('/basket/place', 'BasketController@basketConfirm')->name('basket-confirm');


//Route::post('/item/store', 'ProductController@store')->name('product-store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
