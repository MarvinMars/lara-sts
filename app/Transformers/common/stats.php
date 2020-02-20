<?php

namespace App\Transformers\common;
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
        return $team;
    }

    public function includePlayer(array $team)
    {
        $data =  $team['player'] ? $team['player'] : [];
        return $this->collection($data, new player);
    }
}
