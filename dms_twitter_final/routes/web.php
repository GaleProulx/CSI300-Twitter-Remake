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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/timeline/{action_type}', 'UserActionController@index')->name('timeline');
Route::get('/tweet', 'UserActionController@create')->name('tweet');
Route::get('/follow', 'UserActionController@index_follow')->name('index_follow');
Route::get('/handle/{handle}', 'UserActionController@index_user')->name('index_user');

Route::post('/publish', 'UserActionController@store')->name('post');
Route::post('/favorite', 'UserActionController@favorite')->name('favorite');
Route::post('/retweet', 'UserActionController@retweet')->name('retweet');
Route::post('/follow', 'UserActionController@follow')->name('follow');
