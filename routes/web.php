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

Route::get('/item', 'ItemController@index')->name('item.index');
Route::get('item/create', 'ItemController@create')->name('item.create');
Route::get('item/show/{id}', 'ItemController@show')->name('item.show');
Route::get('item/edit/{id}', 'ItemController@edit')->name('item.edit');

Route::post('item/store', 'ItemController@store')->name('item.store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
