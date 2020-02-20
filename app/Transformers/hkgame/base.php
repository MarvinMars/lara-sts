<?php

namespace App\Transformers\hkgame;
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
            'stats' => []
        ];
    }
}
