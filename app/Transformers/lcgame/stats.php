<?php

namespace App\Transformers\lcgame;
use App\Transformers\Transformer;
use Illuminate\Support\Arr;
use App\Transformers\common\player;

class stats extends Transformer
{
    protected $defaultIncludes = [
        'player'
    ];

    public function transform(array $team)
    {
        $totals = [
            'shots' => isset( $team['totals']['shots'] )? $team['totals']['shots'] : [],
            'penalty' => isset( $team['totals']['penalty'] )? $team['totals']['penalty'] : [],
        ];

        $team['totals'] = $totals;
        unset($totals);
        return $team;
    }

    public function includePlayer(array $team)
    {
        $players = $team['player'];

        return $this->collection($players, new player);
    }
}
