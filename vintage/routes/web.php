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
    return view('welcome');
});

// Resources
Route::resource('products', 'ProductController');
Route::resource('products/{product}/images', 'ImageController');
Route::resource('products/{product}/tags', 'TagController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Routes for tests
Route::view('/app', 'layouts.app');
Route::get('image-view','ImageController@index');
Route::post('image-view','ImageController@store');
Route::get('upload-image','ImageController@index');
Route::post('upload-image',['as'=>'image.upload','uses'=>'ImageController@uploadImages']);
