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
    Route::get('/attribute', ['as' => 'controller::attributeValue::index', 'uses' => 'AttributeValueController@index']);
    Route::get('/attribute-value', ['as' => 'controller::attribute::index', 'uses' => 'AttributeController@index']);
    Route::get('/manufacturer', ['as' => 'controller::manufacturer::index', 'uses' => 'ManufacturerController@index']);
    Route::get('/category', ['as' => 'controller::category::index', 'uses' => 'CategoryController@index']);
    Route::get('/blog', ['as' => 'controller::blog::index', 'uses' => 'BlogController@index']);
    Route::get('/email', ['as' => 'controller::email::index', 'uses' => 'EmailController@index']);
    Route::get('/inoutput', ['as' => 'controller::inoutput::index', 'uses' => 'InoutputController@index']);
    Route::get('/news/dialog', 'NewsController@tinymceImageDialog');
    Route::post('/news/dialog', 'NewsController@tinymceImageDialog');
    Route::post('/news/upload', 'NewsController@tinymceImageUpload');
});
Route::group(['namespace' => 'Frontend'], function(){
    Route::get('/', ['as' => 'frontend::home', 'uses' => 'HomeController@index']);
});
