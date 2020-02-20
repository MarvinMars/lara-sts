<?php

namespace App\Transformers\vbgame;
use App\Transformers\Transformer;

class base extends Transformer
{
    public function transform(array $team)
    {
        $periods = [
            'score' => $team['linescore']['score'],
            'lineprd' => []
        ];
        foreach ($team['linescore']['linegame'] as $period) {
            $periods['lineprd'][] = [
                'prd'=> $period['game'],
                'score' =>$period['points'],
            ];
        }
        return [
            'name'  => $team['name'],
            'periods' => $periods,
            'stats' => [
                'k' => isset($team['totals']['attack']['k']) ? $team['totals']['attack']['k'] : 0,
                'e' => isset($team['totals']['attack']['e']) ? $team['totals']['attack']['e'] : 0,
                'ta' => isset($team['totals']['attack']['ta']) ? $team['totals']['attack']['ta'] : 0,
                'pct' => isset($team['totals']['attack']['pct']) ? $team['totals']['attack']['pct'] : 0,
            ]
        ];
    }
}
