<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']],function(){
Route::get('/books', 'BookController@index')->name('books.index');
Route::get('/books/create', 'BookController@create')->name('books.create');
Route::post('/books/store', 'BookController@store')->name('books.store');
Route::get('/books/{id}', 'BookController@show')->name('books.show');
Route::get('/books/{id}/edit', 'BookController@edit')->name('books.edit');
Route::put('/books/{id}/update', 'BookController@update')->name('books.update');
Route::delete('/books/{id}/destroy', 'BookController@destroy')->name('books.destroy');
});

