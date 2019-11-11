<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/topGames', 'Streamer\StreamerController@getTopGames');
Route::get('/streams', 'Streamer\StreamerController@getStreams');
Route::get('/youtube', 'Streamer\StreamerController@getYoutubeStreams');
Route::get('/games', 'Streamer\StreamerController@getGames');
Route::post('/loadMore', 'Streamer\StreamerController@loadMoreStreams');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
