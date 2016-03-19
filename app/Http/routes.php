<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','Main@home')->name('home'); 	
Route::get('/add', 'Main@add');
Route::post('/add', 'Main@insert');
Route::get('/zadatak/{id}','Main@showTask')->name('showTask');
Route::post('/zadatak/{id}/finish', 'Main@finishTask')->name('finishTask');
Route::post('/zadatak/{id}/open', 'Main@openTask')->name('openTask');
Route::post('/zadatak/delete','Main@deleteTask')->name('deleteTask');
Route::get('/lang/{lang}','Main@changeLanguage')->name('changeLang');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
