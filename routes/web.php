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
Route::get('/shop/kategori/{id}','ShopController@categori')->name('categoriId');

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

    Route::get('/users','UsersController@index')->name('users');

    Route::get('/dataUsers','UsersController@dataUsers')->name('dataUsers');

    Route::get('/orderStatus','OrderController@order')->name('orderStatus');

    Route::get('/dataOrder','OrderController@dataOrder')->name('dataOrder');

    Route::get('/editStatusPembayaran/{id}','OrderController@edit');

    Route::post('/updateStatus','OrderController@update')->name('updateStatus');

    Route::get('/detailPesanan/{id}','OrderController@detailPesanan');

});

Route::group(['middleware'=>['auth','checkrole:user']],function(){

    Route::get('/cart','CartController@index')->name('cart');

    Route::post('/cart/store','CartController@store')->name('storecart');

    Route::delete('/cart/delete/{id}','CartController@delete')->name('cartdelete');

    Route::patch('/cart/{id}','CartController@update')->name('cartupdate');

    Route::get('/order','OrderController@index')->name('order');

    Route::get('/orderList','OrderController@orderList')->name('orderList');

    Route::post('/order/store','OrderController@store')->name('orderStore');

    Route::get('/detailOrder/{id}','OrderController@detail')->name('detailOrder');

    Route::post('/paymentConfirmation','payment_confirmationController@store')->name('paymentConfirmationStore');
});





