<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeamRequest as StoreRequest;
use App\Http\Requests\TeamRequest as UpdateRequest;
use App\Models\Team;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

class TeamCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Team');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/team');
        $this->crud->setEntityNameStrings('team', 'teams');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();

        // ------ CRUD FIELDS

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Title',
        ]);

        $this->crud->addColumn([
            'name' => 'code',
            'label' => 'NCAA Id'
        ]);

        $this->crud->addColumn([
            'name' => 'shortcode',
            'label' => 'Code'
        ]);

        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => trans('stats.created_at'),
        ]);

        $this->crud->orderBy('title');

        $this->crud->denyAccess(['update', 'create', 'delete']);
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

    public function teamOptions()
    {
        $term = $this->request->input('term');
        $options = Team::where('title', 'like', '%' . $term . '%')->get();

        return $options->pluck('title', 'id');
    }
}
