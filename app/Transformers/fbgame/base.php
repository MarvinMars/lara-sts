<?php

namespace App\Transformers\fbgame;
use App\Transformers\Transformer;

class base extends Transformer
{
    public function transform(array $team)
    {
        return [
            'name' => $team['name'],
            'rank' => isset($team['rank'])?$team['rank']:'',
            'record' => isset($team['record'])?$team['record']:'',
            'periods' => $team['linescore'],
            'stats' => [
                'totoff_plays' =>  isset($team['totals']['totoff_plays']) ? $team['totals']['totoff_plays'] : 0,
                'totoff_yards' =>  isset($team['totals']['totoff_yards']) ? $team['totals']['totoff_yards'] : 0,
                'totoff_avg' =>  isset($team['totals']['totoff_avg']) ? $team['totals']['totoff_avg'] : 0,
            ]
        ];
    }
}
