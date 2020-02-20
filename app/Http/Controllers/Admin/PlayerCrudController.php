<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlayerHideOnScreenRequest;
use App\Http\Requests\PlayerPlayerTypeRequest;
use App\Http\Requests\PlayerRequest as StoreRequest;
use App\Http\Requests\PlayerRequest as UpdateRequest;
use App\Models\Player;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

class PlayerCrudController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Player::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/player');
        $this->crud->setEntityNameStrings('player', 'players');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'name',
            'label' => trans('stats.name'),
            'type' => 'text',
            'allows_null' => false,
            'tab' => trans('stats.generic'),
        ]);

        $this->crud->addField([
            'name' => 'checkname',
            'label' => trans('stats.checkname'),
            'type' => 'text',
            'tab' => trans('stats.additional'),
        ]);

        $this->crud->addField([
            'name' => 'uni',
            'label' => 'Uni',
            'type' => 'text',
            'tab' => trans('stats.additional'),
        ]);

        $this->crud->addField([
            'name' => 'code',
            'label' => 'Code',
            'type' => 'text',
            'tab' => trans('stats.additional'),
        ]);

        $this->crud->addField([
            'name' => 'year',
            'label' => 'Year',
            'type' => 'text',
            'tab' => trans('stats.additional'),
        ]);

        $this->crud->addField([
            'name' => 'gp',
            'label' => 'GP',
            'type' => 'number',
            'attributes' => [
                'step' => 1,
            ],
            'tab' => trans('stats.additional'),
        ]);

        $this->crud->addField([
            'name' => 'uni',
            'label' => 'Uni',
            'type' => 'number',
            'tab' => trans('stats.additional'),
        ]);

        $this->crud->addField([
            'label' => trans_choice('stats.sports', 1),
            'type' => "select2_from_ajax",
            'name' => 'sport_id',
            'entity' => 'sport',
            'attribute' => 'title',
            'model' => "App\Models\Sport",
            'data_source' => route('api.sports.list'),
            'placeholder' => trans_choice('stats.select_sports', 1),
            'minimum_input_length' => 2,
            'tab' => trans('stats.generic'),
        ]);

        $this->crud->addField([
            'label' => trans('stats.seasons'),
            'type' => "select2_from_ajax_multiple",
            'name' => 'seasons',
            'entity' => 'seasons',
            'attribute' => 'title',
            'model' => 'App\Models\Season',
            'data_source' => route('api.seasons.list'),
            'placeholder' => trans('stats.select_seasons'),
            'minimum_input_length' => 2,
            'pivot' => true,
            'tab' => trans('stats.generic'),
        ]);

        $this->crud->addField([
            'label' => trans_choice('stats.teams', 1),
            'type' => "select2_from_ajax",
            'name' => 'team_id',
            'entity' => 'team',
            'attribute' => 'title',
            'model' => 'App\Models\Team',
            'data_source' => route('api.teams.list'),
            'placeholder' => trans_choice('stats.select_teams', 1),
            'minimum_input_length' => 2,
            'tab' => trans('stats.generic'),
        ]);


        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'model_function',
            'function_name' => 'getExternalUrlLink',
            'limit' => 1000,
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('name', 'like', '%' . $searchTerm . '%');
            },
        ]);

        $this->crud->addColumn([
            'name' => 'player_type_id',
            'label' => 'Player Type',
            'type' => 'view',
            'view' => 'player.partial._player_type_select',
        ]);

        $this->crud->addColumn([
            'label' => trans_choice('stats.teams', 1),
            'type' => 'select',
            'name' => 'team_id', // the method that defines the relationship in your Model
            'entity' => 'team', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Models\Team", // foreign key model
        ]);

        $this->crud->addColumn([
            'label' => trans('stats.sports'),
            'type' => 'select',
            'name' => 'sport_id', // the method that defines the relationship in your Model
            'entity' => 'sport', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Models\Sport", // foreign key model
        ]);

        $this->crud->addColumn([
            'label' => trans('stats.seasons'),
            'type' => 'select_multiple',
            'name' => 'seasons', // the method that defines the relationship in your Model
            'entity' => 'seasons', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Models\Season", // foreign key model
        ]);

        $this->crud->addColumn([
            'name' => 'games_played',
            'type' => 'model_function',
            'function_name' => 'getGamesPlayedAttribute',
            'label' => 'Games Played',
        ]);

        $this->crud->orderBy('name');

        $this->crud->enableDetailsRow();

        $this->crud->allowAccess('details_row');

        $this->crud->denyAccess(['update', 'create']);


        $this->crud->addFilter([
            'name' => 'team_id',
            'type' => 'select2_ajax',
            'label' => trans_choice('stats.teams', 1),
            'placeholder' => 'Pick a team name',
        ],
            route('backend.team.ajax.team_options'),
            function ($value) {
                $this->crud->addClause('where', 'team_id', $value);
            });

        $this->crud->addFilter([
            'name' => 'sport_id',
            'type' => 'select2_ajax',
            'label' => trans_choice('stats.sports', 1),
            'placeholder' => 'Pick a sport name',
        ],
            route('backend.sport.ajax.sport_options'),
            function ($value) {
                $this->crud->addClause('where', 'sport_id', $value);
            });

        $this->crud->addFilter([
            'name' => 'season_id',
            'type' => 'select2_ajax',
            'label' => trans_choice('stats.seasons', 1),
            'placeholder' => 'Pick a season',
        ],
            route('backend.season.ajax.season_options'),
            function ($value) {
                $this->crud->query = $this->crud->query->whereHas('seasons', function ($query) use ($value) {
                    $query->where('season_id', $value);
                });
            });

    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Backpack\CRUD\Exception\AccessDeniedException
     */
    public function showDetailsRow($id)
    {
        $this->crud->hasAccessOrFail('details_row');

        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;

        return view('player.partial._detail_row', $this->data);
    }


    /**
     * Save hide stat blocks.
     *
     * @param int $playerId
     * @param \App\Http\Requests\PlayerHideOnScreenRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveHideStat(int $playerId, PlayerHideOnScreenRequest $request)
    {
        /** @var Player $player */
        $player = Player::findOrFail($playerId);

        $response = [
            'type' => 'error',
            'message' => sprintf('Unable to save blocks for player %s', $player->name),
        ];

        if ($player->hideBlocks()->sync($request->get('blocks', []))) {
            $response = [
                'type' => 'success',
                'message' => sprintf('Blocks saved for player %s', $player->name),
            ];
        }

        $player->clearCache();

        return response()->json($response);
    }


    /**
     * Save player type.
     *
     * @param int $playerId
     * @param \App\Http\Requests\PlayerPlayerTypeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePlayerType(int $playerId, PlayerPlayerTypeRequest $request)
    {
        /** @var Player $player */
        $player = Player::findOrFail($playerId);

        $response = [
            'type' => 'error',
            'message' => sprintf('Unable to save player type for player %s', $player->name),
        ];

        $player->player_type_id = $request->get('player_type_id', null);

        if ($player->save()) {
            $response = [
                'type' => 'success',
                'message' => sprintf('Player type saved for player %s', $player->name),
            ];
        }

        $player->clearCache();

        return response()->json($response);
    }


}
