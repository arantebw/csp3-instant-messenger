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

Route::get('/dashboard', 'DashboardController@index');
Route::post('/message/create', 'GroupMessagesController@store');
Route::get('/message/{message}', 'GroupMessagesController@show');
Route::post('/comment/{message}/create', 'ThreadsController@store');
Route::get('/comment/{comment}', 'ThreadsController@show');