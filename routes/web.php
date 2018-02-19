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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['auth']], function () {
    // users
    Route::get('/users', 'UsersController@index')->name('users')->middleware('admin');
    Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit')->middleware('admin');
    Route::patch('/users/{id}', 'UsersController@update')->name('users.update')->middleware('admin');
    Route::delete('/users/{id}', 'UsersController@destroy')->name('users.destroy')->middleware('admin');

    //categories
    Route::get('/categories/create', 'CategoriesController@create')->name('categories.create')->middleware('admin');
    Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');
    Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::patch('/categories/{id}', 'CategoriesController@update')->name('categories.update');
    Route::delete('/categories/{id}', 'CategoriesController@destroy')->name('categories.destroy')->middleware('admin');

    //movies
    Route::get('/movies/create', 'MoviesController@create')->name('movies.create');
    Route::post('/movies/store', 'MoviesController@store')->name('movies.store');
    Route::get('/movies/{id}/edit', 'MoviesController@edit')->name('movies.edit');
    Route::patch('/movies/{id}', 'MoviesController@update')->name('movies.update');
    Route::delete('/movies/{id}', 'MoviesController@destroy')->name('movies.destroy')->middleware('admin');;

    //actors
    Route::get('/actors/create', 'ActorsController@create')->name('actors.create');
    Route::post('/actors/store', 'ActorsController@store')->name('actors.store');
    Route::get('/actors/{id}/edit', 'ActorsController@edit')->name('actors.edit');
    Route::patch('/actors/{id}', 'ActorsController@update')->name('actors.update');
    Route::delete('/actors/{id}', 'ActorsController@destroy')->name('actors.destroy')->middleware('admin');;

    //images
    Route::post('/movies/store/{id}', 'ImagesController@storeMovieImage')->name('store.movie.image');
    Route::post('/featured', 'ImagesController@make_featured')->name('featured.image');
    Route::post('/actors/store/{id}', 'ImagesController@storeActorImage')->name('store.actor.image');
    Route::delete('/images/{id}', 'ImagesController@destroy')->name('delete.image');
});

// categories
Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/categories/{id}', 'CategoriesController@show')->name('categories.show');


// movies
Route::get('/movies', 'MoviesController@index')->name('movies');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

// actors
Route::get('/actors', 'ActorsController@index')->name('actors');
Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
