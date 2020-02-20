<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventRequest as StoreRequest;
use App\Http\Requests\EventRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Illuminate\Support\Facades\Auth;
/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Event');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings('event', 'events');

	    $this->crud->addColumn([
		    'name' => 'Watch',
		    'label' => 'Watch',
		    'type' => 'model_function',
		    'function_name' => 'getWatchIcon',
		    'limit' => 100,
	    ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'location',
            'label' => 'Location',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'file',
            'label' => 'File',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'venue',
            'label' => 'Venue',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'label' => 'Sport',
            'type' => "select2_from_ajax",
            'name' => 'sport_id',
            'entity' => 'sport',
            'attribute' => 'title',
            'model' => "App\Models\Sport",
            'data_source' => route('api.sports.list'),
            'placeholder' => trans_choice('stats.select_sports', 1),
            'minimum_input_length' => 2,
        ]);

        $this->crud->addField([
            'label' => 'Home Team',
            'type' => "select2_from_ajax",
            'name' => 'home_team_id',
            'entity' => 'home_team',
            'attribute' => 'title',
            'model' => 'App\Models\Team',
            'data_source' => route('api.teams.list'),
            'placeholder' => trans_choice('stats.select_teams', 1),
            'minimum_input_length' => 2,
        ]);

        $this->crud->addField([
            'label' => 'Away Team',
            'type' => "select2_from_ajax",
            'name' => 'away_team_id',
            'entity' => 'away_team',
            'attribute' => 'title',
            'model' => 'App\Models\Team',
            'data_source' => route('api.teams.list'),
            'placeholder' => trans_choice('stats.select_teams', 1),
            'minimum_input_length' => 2,
        ]);

        $this->crud->addField([
            'name' => 'file',
            'label' => 'File Name',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'event_time',
            'label' => 'Event time',
            'type' => 'time',
        ]);

        $this->crud->addField([
            'name' => 'event_date',
            'label' => 'Event date',
            'type' => 'date_picker',
        ]);


        $this->crud->addField([
            'name' => 'is_completed',
            'label' => 'Is Completed',
            'type' => 'checkbox'
        ]);

        $this->crud->addField([
            'name' => 'is_archived',
            'label' => 'Is Archived',
            'type' => 'checkbox'
        ]);

        $this->crud->addField([
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'hidden',
            'attributes' => [
                'disabled' => 'disabled',
            ]
        ]);

        $this->crud->addField([
            'name' => 'file_timestamp',
            'label' => 'file_timestamp',
            'type' => 'hidden',
            'attributes' => [
                'disabled'=>'disabled',
            ]
        ]);

        $this->crud->addField([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'hidden',
            'default' => '2',
        ]);

	    $this->crud->addField([
		    'name' => 'parse_result',
		    'label' => 'Parse result',
		    'type' => 'hidden',
	    ]);

        $this->crud->addColumn([
            'label' => 'Home',
            'type' => 'select',
            'name' => 'home_team_id', // the method that defines the relationship in your Model
            'entity' => 'home_team', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Models\Team", // foreign key model
        ]);

        $this->crud->addColumn([
            'label' => 'Away',
            'type' => 'select',
            'name' => 'away_team_id', // the method that defines the relationship in your Model
            'entity' => 'away_team', // the method that defines the relationship in your Model
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
		    'name' => 'status',
		    'label' => trans('stats.status'),
		    'type' => 'model_function',
		    'function_name' => 'getStatusLabel',
		    'limit' => 100,
	    ]);
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in EventsRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        $request->request->add(['user_id' => Auth::id()]);
//        dd($request->all());
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $request->request->add(['user_id' => Auth::id()]);
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
