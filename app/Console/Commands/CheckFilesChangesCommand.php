<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckFilesChangesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:changes:check {--limit=} {--offset=} {--update=}';

	protected $limit = 100;

	protected $offset = 0;

	protected $update = false;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

	protected $fileChangesCount = 0;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    if( $this->option('limit') ){
		    $this->limit = (int)$this->option('limit');
	    }

	    if( $this->option('offset') ){
		    $this->offset = (int)$this->option('offset');
	    }

	    if( $this->option('update') ){
		    $this->update = (bool)$this->option('update');
	    }

	    DB::table('events')
	      ->select('id', 'file', 'status')
	      ->orderBy('id')
	      ->skip($this->offset)
	      ->chunk( $this->limit , function ($events) {
		      $bar = $this->output->createProgressBar( count( $events ) );
		      $bar->start();
		      foreach ( $events as $event ) {
			      $this->checkTimestamp( Event::find( $event->id ) );
			      $bar->advance();
		      }
		      $this->offset += count( $events );
		      $this->info( PHP_EOL . 'Offset: ' . $this->offset );
		      $bar->finish();
	      });

	    $this->info(PHP_EOL . 'Changes detected : ' . $this->fileChangesCount );
    }

	public function checkTimestamp( Event $event )
	{
		$this->info(PHP_EOL . 'Check file: '. $event->file );

		if( Storage::disk('live_stats')->exists($event->file) ){

			$file_timestamp = Storage::disk('live_stats')->lastModified($event->file);
			$file_timestamp = Carbon::createFromTimestampUTC($file_timestamp)->toDateTimeString();

			if( $file_timestamp != $event->file_timestamp || $this->update){
				$this->fileChangesCount++;
				$this->updateStatus($event,Event::STATUS_QUEUE);
				/**
				 *  or call stats:live without id for parse all files with status QUEUE
				 * in handle func end
				 */
				$this->call('stats:live', [
					'event' => $event->id,
					'--limit' => '100',
					'--offset' => '0'
				]);
			}

		} else {
			$this->updateStatus($event,Event::STATUS_NOT_FOUND);
		}
	}

	private function updateStatus(Event $event, $status): void
	{
		$event->status = $status;
		$event->save();
	}
}
