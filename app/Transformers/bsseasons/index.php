<?php

namespace App\Transformers\bsseasons;

use App\Transformers\bbgame\game;
use App\Transformers\common\info_table;
use App\Transformers\bbgame\base;
use App\Transformers\bbgame\play_by_play_table;
use App\Transformers\common\stats;
use App\Transformers\Transformer;

class index extends Transformer
{
    public function transform(array $season)
    {
        return $season ;
    }
}
