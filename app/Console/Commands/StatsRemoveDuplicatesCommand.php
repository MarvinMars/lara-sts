<?php

namespace App\Console\Commands;

use App\Models\Player;
use Illuminate\Console\Command;

class StatsRemoveDuplicatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:remove_duplicates {--F|force : Force remove without question}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove player duplicates';

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
     * @return mixed
     */
    public function handle()
    {
        $playerDuplicates = Player::selectRaw('checkname, team_id, COUNT(*) duplicates')
            ->groupBy(['checkname', 'team_id'])
            ->havingRaw('duplicates > 1')
            ->get();

        $this->info(sprintf('Found %d duplicates', count($playerDuplicates)));

        foreach ($playerDuplicates as $playerDuplicate) {
            $limit = (int)($playerDuplicate->duplicates - 1);

            if ($limit <= 0) {
                continue;
            }

            $players = Player::whereCheckname($playerDuplicate->checkname)
                ->whereTeamId($playerDuplicate->team_id)
                ->whereDoesntHave('hideBlocks')->limit($limit)
                ->orderByDesc('created_at')
                ->get();

            foreach ($players as $player) {
                if ($this->option('force')) {
                    $isDelete = true;
                } else {
                    $isDelete = $this->confirm(sprintf('Delete %s with id %s and created date %s?',
                        $player->name . ' - ' . $player->checkname, $player->id, $player->created_at), false);
                }


                if ($isDelete === false) {
                    $this->info('Skipping');
                    continue;
                }

                if ($player->delete()) {
                    $this->info('Player deleted');
                } else {
                    $this->warn('Player does not deleted');
                }
            }
        }
    }
}
