<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','LandingPageController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart','CartController@index')->name('cart');

Route::get('/shop','ShopController@index')->name('shop');

Route::get('/shop/show/{id}','ShopController@show')->name('shopsow');

Route::get('/shop/kategori/{id}','ShopController@categori')->name('categori');

Route::post('/cart/store','CartController@store')->name('storecart');

Route::delete('/cart/delete/{id}','CartController@delete')->name('cartdelete');

Route::patch('/cart/{id}','CartController@update')->name('cartupdate');

Route::post('/checkout','checkoutController@store')->name('checkout');

Route::get('/incheck','checkoutController@index')->name('incheck');

Route::get('/detail/{id}','checkoutController@transactions_detail')->name('detail');
