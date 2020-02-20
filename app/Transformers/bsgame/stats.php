<?php

namespace App\Transformers\bsgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class stats extends Transformer
{
    protected $defaultIncludes = [
        'player'
    ];

    public function transform(array $team)
    {
        return $team;
    }

    public function includePlayer(array $team)
    {
        $players = $team['player'];

        return $this->collection($players, new player);
    }
}
