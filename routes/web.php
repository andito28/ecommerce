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
Route::get('/shop','ShopController@index')->name('shop');
Route::get('/shop/show/{id}','ShopController@show')->name('shopsow');
Route::get('/shop/kategori/{id}','ShopController@categori')->name('categori');

Auth::routes();

Route::group(['middleware'=>['auth','checkrole:user,admin']],function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile',function(){
        return view('profile');
    });
});


Route::group(['middleware'=>['auth','checkrole:admin']],function(){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');

    Route::get('/product','ProductController@index')->name('product');

    Route::get('/dataProduct','ProductController@dataProduct')->name('dataProduct');

    Route::post('/addProduct','ProductController@store')->name('addProduct');

    Route::get('/deleteProduct/{id}','ProductController@destroy');

    Route::get('/editProduct/{id}','ProductController@edit');

    Route::get('/categori','CategoriController@index')->name('categori');

    Route::get('/dataCategori','CategoriController@dataCategori')->name('dataCategori');

    Route::post('/addCategori','CategoriController@store')->name('addCategori');

    Route::get('/editCategori/{id}','CategoriController@edit');

    Route::get('/deleteCategori/{id}','CategoriController@destroy');

});

Route::group(['middleware'=>['auth','checkrole:user']],function(){

    Route::get('/cart','CartController@index')->name('cart');

    Route::post('/cart/store','CartController@store')->name('storecart');

    Route::delete('/cart/delete/{id}','CartController@delete')->name('cartdelete');

    Route::patch('/cart/{id}','CartController@update')->name('cartupdate');

    Route::post('/checkout','checkoutController@store')->name('checkout');

    Route::get('/incheck','checkoutController@index')->name('incheck');

    Route::get('/detail/{id}','checkoutController@transactions_detail')->name('detail');
});





