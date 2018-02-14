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

// categories
Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');
Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('categories.edit');
Route::patch('/categories/{id}', 'CategoriesController@update')->name('categories.update');
Route::get('/categories/{id}', 'CategoriesController@show')->name('categories.show');
Route::delete('/categories/{id}', 'CategoriesController@destroy')->name('categories.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
