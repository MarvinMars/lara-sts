<?php

namespace App\Transformers\hkgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class power_play_summary extends Transformer
{
    public function transform(array $teams)
    {
        $power_play = [];

        foreach ($teams as $team) {
            if( isset($team['linescore']['lineprd'] )){
                foreach ( $team['linescore']['lineprd'] as $prd) {
                    $power_play[$team['id']][] = [
                        'prd' => isset($prd['prd']) ? $prd['prd'] : '' ,
                        'elapsed' => isset($prd['pmin']) ? $prd['pmin']: '' ,
                        'shots' => isset($prd['shots']) ? $prd['shots'] : '' ,
                        'ppg' => isset($prd['ppg']) ? $prd['ppg'] : '' ,
                    ];
                }
            }
        }
        return $power_play;
    }
}
