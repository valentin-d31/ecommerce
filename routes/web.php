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

use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('welcome');
});

/* Admin Routes */
Route::group(['middleware' => ['auth']], function () {
Route::get('/produits', 'AdminProfileController@index')->name('produits.index');
Route::delete('/delete/{Id}', 'AdminProfileController@destroy')->name('produits.destroy');
});
/* Product Routes */
Route::get('/boutique', 'ProductController@index')->name('products.index');
Route::get('/boutique/{slug}', 'ProductController@show')->name('products.show');
Route::get('/search', 'ProductController@search')->name('products.search');

/* Cart Routes */
Route::group(['middleware' => ['auth']], function () {
    Route::get('/panier', 'CartController@index')->name('cart.index');
    Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
    Route::patch('/panier/{rowId}', 'CartController@update')->name('cart.update');
    Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
});

/* Checkout Routes */
Route::group(['middleware' => ['auth']], function () {
    Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
    Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
    Route::get('/merci', 'CheckoutController@thankYou')->name('checkout.thankYou');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
