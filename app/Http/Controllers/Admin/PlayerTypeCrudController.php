<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlayerTypeRequest as StoreRequest;
use App\Http\Requests\PlayerTypeRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

/**
 * Class PlayerTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PlayerTypeCrudController extends CrudController {
	public function setup() {
		/*
		|--------------------------------------------------------------------------
		| CrudPanel Basic Information
		|--------------------------------------------------------------------------
		*/
		$this->crud->setModel( 'App\Models\PlayerType' );
		$this->crud->setRoute( config( 'backpack.base.route_prefix' ) . '/playertype' );
		$this->crud->setEntityNameStrings( 'Player Type', 'Player Types' );

		/*
		|--------------------------------------------------------------------------
		| CrudPanel Configuration
		|--------------------------------------------------------------------------
		*/

//		$this->crud->setFromDb();

		$this->crud->addField( [
			'label' => 'Name',
			'name'  => 'name',
			'type'  => 'text',
		] );


		$this->crud->addField( [
			'label'     => 'Show Blocks',
			'type'      => 'select2_multiple',
			'name'      => 'sportBlocks', // the method that defines the relationship in your Model
			'entity'    => 'sportBlocks', // the method that defines the relationship in your Model
			'attribute' => 'title_with_type', // foreign key attribute that is shown to user
			'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
		] );

		// Columns

		$this->crud->addColumn( [
			'label' => 'Name',
			'name'  => 'name',
			'type'  => 'text',
		] );

		$this->crud->addColumn( [
			'label'     => 'Blocks',
			'type'      => 'select_multiple',
			'name'      => 'sportBlocks', // the method that defines the relationship in your Model
			'entity'    => 'sportBlocks', // the method that defines the relationship in your Model
			'attribute' => 'title_with_type', // foreign key attribute that is shown to user
			'model'     => "App\Models\SportBlock", // foreign key model
		] );

		// add asterisk for fields that are required in PlayerTypeRequest
		$this->crud->setRequiredFields( StoreRequest::class, 'create' );
		$this->crud->setRequiredFields( UpdateRequest::class, 'edit' );
	}

	public function store( StoreRequest $request ) {
		// your additional operations before save here
		$redirect_location = parent::storeCrud( $request );
		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry
		return $redirect_location;
	}

	public function update( UpdateRequest $request ) {
		// your additional operations before save here
		$redirect_location = parent::updateCrud( $request );
		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry
		return $redirect_location;
	}
}
