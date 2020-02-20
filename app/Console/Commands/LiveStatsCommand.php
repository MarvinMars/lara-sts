<?php

namespace App\Console\Commands;

use App\CustomTypesForParser\XMLcopy;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Parser;
use DB;
use Carbon\Carbon;

class LiveStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:live {event?} {--limit=} {--offset=}';

    protected $limit = 100;

    protected $offset = 0;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $event_id = $this->argument('event');

        if( !$event_id ){
            DB::table('events')
                ->select('id', 'file', 'status')
                ->where('status', Event::STATUS_QUEUE )
                ->orderBy('id')
                ->skip( $this->offset )
                ->chunk( $this->limit , function ($events){
                    $bar = $this->output->createProgressBar(count($events));
                    $bar->start();
                    foreach ($events as $event) {
                        $this->parseFile( Event::find($event->id) );
                        $bar->advance();
                    }
                    $this->offset += count($events);
                    $this->info(PHP_EOL . 'Offset: ' . $this->offset );
                    $bar->finish();
            });
        } else {
            $event = Event::find($event_id);

            if( !$event ) {
                $this->info(PHP_EOL . 'Event #' . $event_id . ' not found');
            } else {
                $this->parseFile( $event );
            }
        }

        return true;
    }

    public function parseFile(Event $event)
    {
	    $directory = 'live_stats';

        $this->info(PHP_EOL . 'Event #'. $event->id . ' start');

        $this->updateStatus($event,Event::STATUS_IN_PROGRESS);

        $file = $event->file;

        if( $file && Storage::disk($directory)->exists($file) ){

            $xml = Storage::disk($directory)->get($file);
            $xml = Parser::parse($xml, new XMLcopy());
            $time = Storage::disk($directory)->lastModified($file);

            unset($file);

            if( $data = $xml->first() ){
                $result = $this->gameTransformer($data , $xml->keys()->first());
	            $update_result =  $event->update([
		            'file_timestamp' => $time,
		            'parse_result' => json_encode($result),
	            ]);

                if( $update_result ){
	                $this->updateStatus($event,Event::STATUS_PROCESSED);
                } else {
	                $this->updateStatus($event,Event::STATUS_PROCESSED);
                }

            } else {
                $this->updateStatus($event,Event::STATUS_ERROR);
                $this->error(PHP_EOL . 'Event #'. $event->id .' Parser error');
            }
        } else {
            $this->error(PHP_EOL . 'Event #'. $event->id .' File not found ');
            $this->updateStatus($event,Event::STATUS_NOT_FOUND);
        }

        $this->info('Event #'. $event->id . ' finished');
    }

    public function gameTransformer($data, $sport)
    {
        $fractal = new Manager();
	    $tables = [ 'info','base','stats','play_by_play' ];
        $sport_transformer = sprintf("\App\Transformers\%s\index", $sport);

        $fractal->parseIncludes($tables);

        $resource = new Item($data, new $sport_transformer());
        $array = $fractal->createData($resource)->toArray();

        $array['stats'] = [];

        if (!empty($array['data']['base']['data'][0]['stats'])) {
            $array['stats'] = collect($array['data']['base']['data'][0]['stats'])->keys()->toArray();
        }

        $array['sport'] = $sport;
        return $array;
    }

    private function updateStatus(Event $event, $status): void
    {
        $event->status = $status;
        $event->save();
    }
}
