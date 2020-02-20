<?php

namespace App\Jobs;

use App\Models\Import;
use App\Models\ImportLog;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class StoreImportLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    private $logs;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Import $model
     * @param \Illuminate\Support\Collection $logs
     */
    public function __construct(Import $model, Collection $logs)
    {
        $this->model = $model;
        $this->logs = $logs->map(function (array $values) {
            $values['import_id'] = $this->model->id;
            $values['type'] = array_has($values, 'type') ? array_get($values, 'type') : 'info';
            $values['content'] = array_has($values, 'content') ? array_get($values, 'content') : '';
            $values['created_at'] = array_has($values, 'created_at') ? array_get($values, 'created_at') : Carbon::now();
            $values['updated_at'] = array_has($values, 'updated_at') ? array_get($values, 'updated_at') : Carbon::now();
            return $values;
        });
    }

    /**
     * Saving log to the database with specified date format.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->logs->toArray() as $record) {
            $logModel = new ImportLog();
            $logModel->setDateFormat('Y-m-d H:i:s.u')->fill($record);
            $logModel->save();
        }
    }
}
