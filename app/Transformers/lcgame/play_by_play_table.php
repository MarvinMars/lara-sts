<?php

namespace App\Transformers\lcgame;
use App\Transformers\Transformer;

class play_by_play_table extends Transformer
{
    public function transform(array $play)
    {
        return $play['score'];
    }
}
