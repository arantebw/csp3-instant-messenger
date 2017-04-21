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

Route::get('/logged-out', function () {
    return view('logged_out');
});

// Dashboard
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/{team}', 'DashboardController@index');
Route::get('/dashboard/{team}/{channel}', 'DashboardController@index');

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
Route::get('/teams/{team}', 'TeamsController@show');
Route::get('/teams/{team}/set', 'TeamsController@set');

// Members
Route::get('/members/create', 'RegistrationsController@create');
Route::post('/members', 'RegistrationsController@store');
Route::get('/members/{member}', 'RegistrationsController@show');
Route::get('/members/{member}/edit', 'RegistrationsController@edit');
Route::put('/members/{member}', 'RegistrationsController@update');
Route::delete('/members/{member}', 'RegistrationsController@destroy');

// Channels
Route::get('/channels/create', 'ChannelsController@create');
Route::post('/channels', 'ChannelsController@store');
Route::get('/channels/{channel}', 'ChannelsController@show');
Route::get('/channels/{channel}/set', 'ChannelsController@set');

// Direct messages
Route::get('/dashboard/{team}/{user1}/chats/{user2}', 'DirectMessagesController@chats');
