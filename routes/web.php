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

// Dashboard
Route::get('/dashboard', 'DashboardController@index');

// Group messages
Route::post('/message/create', 'GroupMessagesController@store');
Route::get('/message/{message}', 'GroupMessagesController@show');
Route::get('/message/{message}/edit', 'GroupMessagesController@edit');
Route::put('/message/{message}', 'GroupMessagesController@update');
Route::delete('/message/{message}', 'GroupMessagesController@destroy');

// Comments
Route::post('/comment/{message}/create', 'ThreadsController@store');
Route::get('/comment/{comment}', 'ThreadsController@show');
Route::get('/comment/{comment}/edit', 'ThreadsController@edit');
Route::put('/comment/{comment}', 'ThreadsController@update');
Route::delete('/comment/{comment}', 'ThreadsController@destroy');

// Teams
Route::get('/teams/create', 'TeamsController@create');
Route::post('/teams', 'TeamsController@store');

// Members
Route::get('/members/create', 'RegistrationsController@create');
Route::post('/members', 'RegistrationsController@store');
