<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'as' => 'backend.',
    'middleware' => ['web', backpack_middleware(), 'setTheme:backend'],
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::get('season/ajax/season_options', [
            'as' => 'season.ajax.season_options',
            'uses' => 'SeasonCrudController@seasonOptions',
        ]
    );
    CRUD::resource('season', 'SeasonCrudController');

    Route::get('sport/ajax/sport_options', [
            'as' => 'sport.ajax.sport_options',
            'uses' => 'SportCrudController@sportOptions',
        ]
    );
    CRUD::resource('sport', 'SportCrudController');
    Route::post('player/ajax/hide_stat/{playerId}', [
        'as' => 'player.ajax.hide_stat.save',
        'uses' => 'PlayerCrudController@saveHideStat',
    ]);
    Route::post('player/ajax/player_type/{playerId}', [
        'as' => 'player.ajax.player_type.save',
        'uses' => 'PlayerCrudController@savePlayerType',
    ]);
    CRUD::resource('player', 'PlayerCrudController');
    CRUD::resource('playertype', 'PlayerTypeCrudController');
    CRUD::resource('game', 'GameCrudController');
    Route::get('team/ajax/team_options', [
            'as' => 'team.ajax.team_options',
            'uses' => 'TeamCrudController@teamOptions',
        ]
    );
    CRUD::resource('team', 'TeamCrudController');
    CRUD::resource('import', 'ImportCrudController');
    CRUD::resource('event', 'EventCrudController');

    Route::get('import/download/{id}', [
        'uses' => 'ImportCrudController@download',
        'as ' => 'crud.import.download'
    ]);

    Route::get('cachePurge', [
        'as' => 'cache_purge',
        'uses' => 'PurgeCacheController@index',
    ]);
});