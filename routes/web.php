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
Auth::routes();
Route::post('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => 'system', 'namespace' => 'System', 'middleware' => 'custom'], function () {
    Route::get('/product', ['as' => 'controller::product::index', 'uses' => 'ProductController@index']);
    Route::get('/setting', ['as' => 'controller::setting::index', 'uses' => 'SettingController@index']);
    Route::get('/manufacturer', ['as' => 'controller::manufacturer::index', 'uses' => 'ManufacturerController@index']);
    Route::get('/category', ['as' => 'controller::category::index', 'uses' => 'CategoryController@index']);
    Route::get('/blog', ['as' => 'controller::blog::index', 'uses' => 'BlogController@index']);
    Route::get('/email', ['as' => 'controller::email::index', 'uses' => 'EmailController@index']);
});