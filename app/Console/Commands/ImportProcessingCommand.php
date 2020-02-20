<?php

namespace App\Console\Commands;

use App\Classes\Import\Exceptions\GameAlreadyExistsException;
use App\Classes\Import\Exceptions\IsNotGameFileException;
use App\Classes\Import\Exceptions\MissingTeamException;
use App\Classes\Import\Exceptions\WrongFileFormatException;
use App\Classes\Import\Factories\ImportFactory;
use App\Jobs\StoreImportLogJob;
use App\Models\Import;
use Artisan;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Nathanmac\Utilities\Parser\Exceptions\ParserException;

class ImportProcessingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:processing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processing with not yet imported items';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \Nathanmac\Utilities\Parser\Facades\Exceptions\ParserException
     */
    public function handle(): void
    {
        $toImportModels = Import::whereStatus(Import::STATUS_UPLOADED)->get();


        $this->info(sprintf('Got %d models', $toImportModels->count()));

        foreach ($toImportModels as $toImportModel) {
            /** @var Import $toImportModel */
            $toImportModel = Import::whereStatus(Import::STATUS_UPLOADED)
                ->where('id', '=', $toImportModel->id)
                ->first();

            if (!$toImportModel) {
                $this->info('Status changed. Skipping.');
                continue;
            }

            $hasAnyException = false;

            /**
             * Clear all logs before start.
             */
            $toImportModel->logs()->delete();

            foreach ($toImportModel->files as $file) {
                try {
                    $this->updateStatus($toImportModel, Import::STATUS_IMPORTING);
                    $importFactory = ImportFactory::import($toImportModel);
                    $importFactory->setFile($file)
                        ->read()
                        ->processing();
                } catch (FileNotFoundException $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_FILE_NOT_FOUND);
                } catch (IsNotGameFileException $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_IS_NOT_GAME);
                } catch (WrongFileFormatException $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_WRONG_FILE);
                } catch (ParserException $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_WRONG_FILE);
                } catch (MissingTeamException $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_MISSING_TEAM);
                } catch (GameAlreadyExistsException $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_GAME_EXISTS);
                } catch (Exception $e) {
                    $hasAnyException = $this->log($toImportModel, $file, $e, Import::STATUS_ERROR);
                }
            }

            $this->updateStatus($toImportModel,
                $hasAnyException ? Import::STATUS_DONE_WITH_ERRORS : Import::STATUS_DONE);
            Artisan::call('page-cache:clear');
            $this->info('Done');
        }
    }

    /**
     * Log error to the database.
     *
     * @param \App\Models\Import $model
     * @param string $file
     * @param \Exception $exception
     * @param int $status
     *
     * @return bool
     */
    private function log(Import $model, string $file, Exception $exception, int $status): bool
    {
        $this->error(sprintf('Error: %s in file %s line %s', $exception->getMessage(), $exception->getFile(),
            $exception->getLine()));
        $this->updateStatus($model, $status);
        $this->writeLog($model, $file, $exception);

        return true;
    }

    /**
     * Update status of the import.
     *
     * @param \App\Models\Import $importItem
     * @param $status
     */
    private function updateStatus(Import $importItem, int $status): void
    {
        $importItem->status = $status;
        $importItem->save();
    }

    /**
     * Write log to the import model.
     *
     * @param \App\Models\Import $model
     * @param string $file
     * @param \Exception $exception
     */
    private function writeLog(Import $model, string $file, Exception $exception): void
    {
        $message = sprintf('FILE: %s ERROR OCCURRED: %s', $file, $exception->getMessage());
        $logs = collect()->push(
            [
                'type' => 'error',
                'content' => $message,
            ]);
        dispatch(new StoreImportLogJob($model, $logs));
    }
}
