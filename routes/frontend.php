<?php

Route::group([
    'middleware' => [
        'page-cache',
    ],
], function () {
    Route::get('/', 'StatsController@index');

    Route::get('stats/event/{event}', [
        'as' => 'event',
        'uses' => 'StatsController@live',
    ])
        ->where('event', '[0-9]+');

    Route::get('stats/{stats_player}/{stats_season?}', [
        'as' => 'player.stats',
        'uses' => 'StatsController@byPlayerSeason',
    ])
        ->where('stats_player', '[0-9]+')
        ->where('stats_season', '[0-9]+');

    Route::get('error', function () {
        throw new Exception('Message', 500);
    });
});