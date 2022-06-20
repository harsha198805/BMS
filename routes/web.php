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
Route::get('/books', 'TaskController@index')->name('books.index');
Route::get('/books/create', 'TaskController@create')->name('books.create');
Route::post('/books/store', 'TaskController@store')->name('books.store');
Route::get('/books/{id}', 'TaskController@show')->name('books.show');
Route::get('/books/{id}/edit', 'TaskController@edit')->name('books.edit');
Route::put('/books/{id}/update', 'TaskController@update')->name('books.update');
Route::delete('/books/{id}/destroy', 'TaskController@destroy')->name('books.destroy');
});

