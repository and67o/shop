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

Route::get('/products/{category_id?}', 'ProductController@index')->name('products');
Route::get('/item/create', 'ProductController@create')->name('product');

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('reset', 'ResetController@reset')->name('reset');

Route::middleware(['auth'])->group(function () {
    Route::group([
        'prefix' => 'person',
        'namespace' => 'Person',
        'as' => 'person.',
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    });

    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin',
    ], function () {
        Route::group(['middleware' => 'is_admin'], function () {
            Route::get('/panel', 'OrderController@index')->name('panel');
            Route::get('/panel/{order}', 'OrderController@show')->name('panel.show');
        });

        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
    });
});

Route::group([
    'prefix' => 'basket',
], function () {
    Route::post('/basket/add/{id}', 'BasketController@basketAdd')->name('basket-add');
    Route::group([
        'middleware' => 'basket_is_not_empty',
    ], function () {
        Route::get('/', 'BasketController@index')->name('basket');
        Route::post('/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
        Route::get('/place', 'BasketController@basketPlace')->name('basket-place');
        Route::post('/place', 'BasketController@basketConfirm')->name('basket-confirm');
    });
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
