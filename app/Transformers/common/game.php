<?php

namespace App\Transformers\common;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class game extends Transformer
{
    public function transform(array $game)
    {
        return $game;
    }
}
