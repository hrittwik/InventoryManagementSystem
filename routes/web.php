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

Route::get('/', function () {
    return view('dashboard')->with('menu', $menu='');
});

/* Product Routes */
Route::get('/product', 'ProductController@index');
Route::get('/product/GetAll', 'ProductController@GetAll');
Route::get('/product/CheckUniqueShortName', 'ProductController@CheckUniqueShortName');
Route::post('/product/store', 'ProductController@store');
Route::patch('/product/update', 'ProductController@update');
Route::delete('/product/delete', 'ProductController@destroy');

/* Vendor Routes */
Route::get('/vendor', 'VendorController@index');
Route::get('/vendor/GetAll', 'VendorController@GetAll');
Route::get('/vendor/CheckUniqueName', 'VendorController@CheckUniqueName');
Route::post('/vendor/store', 'VendorController@store');
Route::patch('/vendor/update', 'VendorController@update');
Route::delete('/vendor/delete', 'VendorController@destroy');

/* Purchase Routes */
Route::get('/purchase', 'PurchaseController@index');

/* Unit Routes */
Route::get('/unit', 'UnitController@index');
Route::get('/unit/GetAll', 'UnitController@GetAll');
Route::get('/unit/CheckUniqueShortName', 'UnitController@CheckUniqueShortName');
Route::post('/unit/store', 'UnitController@store');
Route::patch('/unit/update', 'UnitController@update');
Route::delete('/unit/delete', 'UnitController@destroy');

/* api methods */
Route::group(['prefix' => 'api'], function () {
    Route::get('/vendor/GetAll/', 'VendorController@getAll');
});
