<?php

namespace App\Transformers\bbgame;
use App\Transformers\Transformer;

class play_by_play_table extends Transformer
{
    public function transform(array $game)
    {
        $teams = [];
        if(isset($game['team'])) {
            foreach ($game['team'] as $team){
                $teams[$team['vh']] = $team['id'];
            }
            $game['plays']['teams'] = $teams;
        }

        return  $game['plays'];
    }
}
