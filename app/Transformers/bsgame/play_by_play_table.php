<?php

namespace App\Transformers\bsgame;
use App\Transformers\Transformer;

class play_by_play_table extends Transformer
{
    public function transform(array $play)
    {
        return $play['inning'];
    }
}
