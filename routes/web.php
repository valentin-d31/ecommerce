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
    return redirect('/home');
})->middleware('role:admin');
Route::group(['middleware' => ['auth']], function () {

/* Admin Routes */
    Route::get('/admin/dashboard', 'Admin\MainController@index')->name('admin.index')->middleware('App\Http\Middleware\Admin');

    /** Users */
    Route::get('/admin/users', 'Admin\UserController@index')->name('admin.users.index')->middleware('App\Http\Middleware\Admin');
    Route::get('/admin/users/{id}', 'Admin\UserController@show')->name('admin.users.show')->middleware('App\Http\Middleware\Admin');
    Route::delete('/admin/users/{id}', 'Admin\UserController@destroy')->name('admin.users.destroy')->middleware('App\Http\Middleware\Admin');
    Route::post('/admin/users/', 'Admin\UserController@store')->name('admin.users.add')->middleware('App\Http\Middleware\Admin');
    Route::get('/form/user/', 'Admin\UserController@form')->name('form.user')->middleware('App\Http\Middleware\Admin');
    Route::get('/form/user/update/{id}', 'Admin\UserController@formUpdate')->name('form.update.user')->middleware('App\Http\Middleware\Admin');
    Route::put('update/user/{id}', 'Admin\UserController@update')->name('admin.users.update')->middleware('App\Http\Middleware\Admin');

    /** Products */
    Route::get('/admin/products', 'Admin\ProductController@index')->name('admin.products.index')->middleware('App\Http\Middleware\Admin');
    Route::get('/admin/products/{id}', 'Admin\ProductController@show')->name('admin.products.show')->middleware('App\Http\Middleware\Admin');
    Route::delete('/admin/products/{id}', 'Admin\ProductController@destroy')->name('admin.products.destroy')->middleware('App\Http\Middleware\Admin');
    Route::get('/form/product/', 'Admin\ProductController@form')->name('form.product')->middleware('App\Http\Middleware\Admin');
    Route::get('/form/product/update/{id}', 'Admin\ProductController@formUpdate')->name('form.update.product')->middleware('App\Http\Middleware\Admin');
    Route::post('add/product', 'Admin\ProductController@store')->name('admin.products.add')->middleware('App\Http\Middleware\Admin');
    Route::put('update/product/{id}', 'Admin\ProductController@update')->name('admin.products.update')->middleware('App\Http\Middleware\Admin');


});

/* Route utilisateurs */
Route::get('/orders', 'User\MainController@index')->name('user.orders.index');

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
    Route::post('/coupon', 'CartController@storeCoupon')->name('cart.store.coupon');
    Route::delete('/coupon', 'CartController@destroyCoupon')->name('cart.destroy.coupon');
});

/* Checkout Routes */
Route::group(['middleware' => ['auth']], function () {
    Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
    Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
    Route::get('/merci', 'CheckoutController@thankYou')->name('checkout.thankYou');
});

/**
 * User informations
 */
Route::get('/account', 'User\UserController@edit')->name('user.edit');
Route::put('/account/update', 'User\UserController@update')->name('user.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
