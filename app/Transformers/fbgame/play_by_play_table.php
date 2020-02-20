<?php

namespace App\Transformers\fbgame;
use App\Transformers\Transformer;

class play_by_play_table extends Transformer
{
    public function transform(array $play)
    {
        return $play['qtr'];
    }
}
