<?php

namespace App\Transformers\sogame;
use App\Transformers\Transformer;

class base extends Transformer
{
    public function transform(array $team)
    {
        $shots = 0;
        $saves = 0;
        $corners = 0;
        $fouls = 0;

        foreach ($team['linescore']['lineprd'] as $period) {
            if(isset($period['shots']) && !empty($period['shots'])){
                $shots += $period['shots'];
            }
            if(isset($period['saves']) && !empty($period['saves'])){
                $saves += $period['saves'];
            }
            if(isset($period['corners']) && !empty($period['corners'])){
                $corners += $period['corners'];
            }
            if(isset($period['fouls']) && !empty($period['fouls'])){
                $fouls += $period['fouls'];
            }
        }

        return [
            'name' => $team['name'],
            'periods' => $team['linescore'],
            'stats' => [
                'shots' => $shots,
                'saves' => $saves,
                'corners' => $corners,
                'fouls' => $fouls,
            ]
        ];
    }
}
