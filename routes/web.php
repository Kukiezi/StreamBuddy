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
Route::get('/news', 'NewsController@index');
Route::get('/about', 'AboutController@index');
Route::get('/news/{slug}', 'NewsController@newsView');
Route::get('/game/{game}', 'GameController@index');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/privacy', 'AboutController@privacy');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');





Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
