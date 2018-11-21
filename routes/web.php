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
    return view('signin');
});

Route::get('test', function()
{
    dd(Config::get('mail'));
});

Auth::routes();

Route::get('/home', 'ListController@index')->name('home');
Route::post('delete','ListController@delete');
Route::post('create','ListController@create');
Route::get('search','ListController@search');
Route::get('users','ListController@users');
Route::get('users_list/{id}','ListController@users_list');

Route::get('/google/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/facebook/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/facebook/callback', 'SocialAuthFacebookController@callback');