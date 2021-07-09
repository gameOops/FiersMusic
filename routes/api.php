<?php

use App\Http\Controllers\Api\PlaylistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function () {
    Route::post('/playlist', [PlaylistController::class, 'getPlaylist']);
    Route::post('/download', 'PlaylistController@getPlaylists');
    Route::post('/allPlay', 'PlaylistController@allPlay');
    Route::post('/selectAll', 'PlaylistController@selectAll');
    Route::post('/selectArtist', 'ArtistController@getArtist');
    Route::post('/selectTracks', 'ArtistController@selectTracks');
    Route::post('/searchTrack', 'SearchController@searchTrack');
    Route::post('/searchAlbum', 'SearchController@searchAlbum');
    Route::post('/addNew', 'PlaylistController@addNew');
    Route::post('/addNewTrack', 'PlaylistController@addNewTrack');
    Route::post('/makeImage', 'PlaylistController@makeImage');
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/user', 'UserController@getInfo');
    Route::post('/userId', 'UserController@getInfoId');
});
