<?php

namespace App\Console\Commands;

use App\Http\Controllers\Frontend\StatsController;
use App\Models\Player;
use Illuminate\Console\Command;
use Illuminate\View\View;

/**
 * Class StatsPlayersBuildCommand
 * @package App\Console\Commands
 */
class StatsPlayersBuildCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:players:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build players tables in the background.';

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
     * @throws \Throwable
     */
    public function handle()
    {
        foreach (Player::whereHas('seasons')->get() as $player) {
            $this->info(sprintf('Building player %s cache', $player->id));
            try {
                $view = app(StatsController::class)->byPlayerSeason($player, null);

                if ($view instanceof View) {
                    $view->render();
                }
                $this->info(__('Build stats for the player :name (:url)', [
                    'name' => $player->name,
                    'url' => route('frontend.player.stats', [
                        'player' => $player->id,
                    ]),
                ]));
            } catch (\Exception $e) {
                logger('Unable build the cache for the player', [
                    'error' => $e,
                    'player' => $player
                ]);
                $this->error(__('Unable build the cache for the player :name with error :error. URL: :url', [
                    'url' => route('frontend.player.stats', [
                        'player' => $player->id,
                    ]),
                    'name' => $player->name,
                    'error' => $e->getMessage(),
                    'line' => $e->getLine(),
                ]));
            }
        }
    }
}
