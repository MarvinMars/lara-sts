<?php

Route::group(['prefix' => 'seasons', 'as' => 'seasons.'], function () {
    Route::get('/', ['as' => 'list', 'uses' => 'SeasonsController@index']);
    Route::get('/{id}', ['as' => 'show', 'uses' => 'SeasonsController@show',]);
});

Route::group(['prefix' => 'sports', 'as' => 'sports.'], function () {
    Route::get('/', ['as' => 'list', 'uses' => 'SportsController@index',]);
    Route::get('/{id}', ['as' => 'show', 'uses' => 'SportsController@show',]);
});

Route::group(['prefix' => 'games', 'as' => 'games.'], function () {
    Route::get('/', ['as' => 'list', 'uses' => 'GamesController@index',]);
    Route::get('/{id}', ['as' => 'show', 'uses' => 'GamesController@show',]);
});

Route::group(['prefix' => 'teams', 'as' => 'teams.'], function () {
    Route::get('/', ['as' => 'list', 'uses' => 'TeamsController@index',]);
    Route::get('/{id}', ['as' => 'show', 'uses' => 'TeamsController@show',]);
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/parser', 'GameParserController@index');
    Route::get('/roster', 'RosterController@search');
    Route::post('/parser/upload', 'GameParserController@indexUpload');
});
Route::get('/game/{game_parser}', 'GameParserController@show');
Route::post('/login', 'UserController@login')->name('login');
