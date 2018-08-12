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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('threads/create', 'ThreadsController@create')
    ->middleware('auth')
    ->name('threads.create');
Route::get('threads/{channel?}', 'ThreadsController@index')->name('threads.index');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::post('threads', 'ThreadsController@store')
    ->middleware('auth')
    ->name('threads.store');
Route::post('threads/{thread}/replies', 'RepliesController@store')
    ->middleware('auth')
    ->name('replies.store');

