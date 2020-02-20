<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImportRequest as StoreRequest;
use App\Http\Requests\ImportRequest as UpdateRequest;
use App\Models\Import;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use ZipStream\ZipStream;

/**
 * Class ImportCrudController
 * @package App\Http\Controllers\Admin
 */
class ImportCrudController extends CrudController
{
    /**
     * Setup the CRUD.
     *
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel('App\Models\Import');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/import');
        $this->crud->setEntityNameStrings(trans_choice('stats.import_files', 1),
            trans_choice('stats.import_files', 2));

        $this->crud->addField([
            'label' => trans('stats.sport'),
            'type' => "select2_from_ajax",
            'name' => 'sport_id',
            'entity' => 'sport',
            'attribute' => 'title',
            'model' => 'App\Models\Sport',
            'data_source' => route('api.sports.list'),
            'placeholder' => trans('stats.select_sport'),
            'minimum_input_length' => 2,
        ]);
        $this->crud->addField([
            'label' => trans('stats.season'),
            'type' => "select2_from_ajax",
            'name' => 'season_id',
            'entity' => 'season',
            'attribute' => 'title',
            'model' => 'App\Models\Season',
            'data_source' => route('api.seasons.list'),
            'placeholder' => trans('stats.select_season'),
            'minimum_input_length' => 2,
        ]);

        $this->crud->addField([
            'name' => 'files',
            'label' => trans_choice('stats.files', 2),
            'type' => 'upload_multiple',
            'upload' => true,
            'disk' => 'import',
        ]);

        $this->crud->addColumn([
            'label' => trans('stats.sport'),
            'type' => 'select',
            'name' => 'sport_id',
            'entity' => 'sport',
            'attribute' => 'title',
            'model' => "App\Models\Sport",
        ]);

        $this->crud->addColumn([
            'label' => trans('stats.season'),
            'type' => "select",
            'name' => 'season_id',
            'entity' => 'season',
            'attribute' => 'title',
            'model' => "App\Models\Season",
        ]);

        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Uploaded at',
        ]);

        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('stats.status'),
            'type' => 'model_function',
            'function_name' => 'getStatusLabel',
            'limit' => 100,
        ]);

        $this->crud->addColumn([
            'name' => 'files_count',
            'label' => 'Num. files',
        ]);

        $this->crud->addButtonFromView('line', 'download', 'download', 'beginning');
        $this->crud->denyAccess(['update']);
        $this->crud->orderBy('created_at', 'desc');
        $this->crud->setListView('backend.crud.import.list');

        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
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

    /**
     * Download ZIP archive of the files.
     *
     * @param int $id
     *
     * @throws \ZipStream\Exception\FileNotFoundException
     * @throws \ZipStream\Exception\FileNotReadableException
     */
    public function download(int $id)
    {
        /** @var Import $importModel */
        $importModel = Import::findOrFail($id);

        $storage = \Storage::disk('import');

        $zip = new ZipStream(sprintf('stats_import_%d_%s.zip', $importModel->id,
            $importModel->created_at->format('m-d-Y')));

        foreach ($importModel->files as $file) {
            if ($storage->has($file)) {
                $zip->addFileFromPath(basename($file), $storage->path($file));
            }
        }
        $zip->finish();
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

        return view('import.partial._detail_row', $this->data);
    }
}
