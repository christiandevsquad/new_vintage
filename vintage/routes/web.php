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

// New methods added in controllers
// Route::post('products/csvToArray', 'ProductController@csvToArray');
Route::post('products/importCsv', 'ProductController@importCsv');
Route::get('products/importCsv', 'ProductController@importCsv');

// Resources
Route::resource('products', 'ProductController');
Route::resource('products/{product}/images', 'ImageController');
Route::resource('products/{product}/tags', 'TagController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Routes for tests