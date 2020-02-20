<?php

namespace App\Transformers\bbgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class game extends Transformer
{
    public function transform(array $game)
    {
        $teams = [];
        if(isset($game['team'])){
            foreach($game['team'] as $team){
                $teams[$team['vh']] = $team['name'];
            }
        }
        if(isset($game['plays']['period'])){
            $new_scores = [];

            foreach ( $game['plays']['period'] as $period) {
                foreach ( $period['special'] as $stats) {
                    if(isset($stats['vh']) && isset($period['number'])){
                        $new_scores[$stats['vh']][$period['number']] = $stats;
                    }
                }

            }
            $game['teams'] = $teams ;
            $game['individual'] = $new_scores;
        }

        return $game;
    }
}
