<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GameRequest as StoreRequest;
use App\Http\Requests\GameRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

class GameCrudController extends CrudController
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
        $this->crud->setModel('App\Models\Game');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/game');
        $this->crud->setEntityNameStrings('game', 'games');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'label' => '#',
            'name' => 'id'
        ]);

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'label' => 'ID',
            'name' => 'gameid'
        ]);

        $this->crud->addColumn([
            'label' => 'Date',
            'name' => 'gamedate',
        ]);

        $this->crud->addColumn([
            'label' => 'Start time',
            'name' => 'start',
            'type' => 'datetime',
            'format' => 'g:i A',
        ]);

        $this->crud->addColumn([
            'label' => 'Stadium',
            'name' => 'stadium',
        ]);

        $this->crud->addColumn([
            'label' => 'Site',
            'name' => 'site',
        ]);

        $this->crud->addColumn([
            'label' => 'Opponent',
            'name' => 'opponent_name'
        ]);

        $this->crud->addColumn([
            'label' => 'Sport',
            'type' => 'select',
            'name' => 'sport_id', // the method that defines the relationship in your Model
            'entity' => 'sport', // the method that defines the relationship in your Model
            'attribute' => "title", // foreign key attribute that is shown to user
            'model' => "App\Models\Sport", // foreign key model
        ]);

        $this->crud->addColumn([
            'label' => 'Seasons',
            'type' => 'select_multiple',
            'name' => 'seasons', // the method that defines the relationship in your Model
            'entity' => 'seasons', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Models\Season", // foreign key model
        ]);

        $this->crud->enableExportButtons();

        $this->crud->denyAccess(['update', 'create']);

        $this->crud->addFilter(
            [
                'name' => 'sport_id',
                'type' => 'select2_ajax',
                'label' => 'Sport',
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

        $this->crud->addFilter(
            [
                'type' => 'date',
                'name' => 'date',
                'label' => 'Date'
            ], false,
            function ($value) {
                $this->crud->addClause('where', 'date', '=', $value);
            });
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
