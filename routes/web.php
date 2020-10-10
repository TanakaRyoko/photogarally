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

Route::get('/', 'AlbumController@index');
Route::get('/albums','AlbumController@index');
Route::get('/albums/create','AlbumController@create')->name('album-create');
Route::post('/albums/store','AlbumController@store')->name('album-store');
Route::get('/albums/{id}','AlbumController@show')->name('album-show');

Route::get('/photo/create/{albumId}', 'PhotoController@create')->name('photo-create');
Route::post('/photos/store', 'PhotoController@store')->name('photo-store');
Route::get('/photos/{id}', 'PhotoController@show')->name('photo-show');
Route::delete('/photos/{id}', 'PhotoController@destroy')->name('photo-destroy');