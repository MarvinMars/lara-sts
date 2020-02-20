<?php

namespace App\Transformers\bbgame;

use App\Transformers\bbgame\game;
use App\Transformers\common\info_table;
use App\Transformers\bbgame\base;
use App\Transformers\bbgame\play_by_play_table;
use App\Transformers\common\stats;
use App\Transformers\Transformer;

class index extends Transformer
{
    protected $availableIncludes = [
        'info','base','stats','play_by_play'
    ];

    protected $defaultIncludes = [
        'game'
    ];

    public function transform(array $game)
    {
        return [] ;
    }

    public function includeInfo(array $game)
    {
        $data =  $game['venue'] ? $game['venue'] : [];
        return $this->item($data, new info_table());
    }

    public function includeBase(array $game)
    {
        $data =  $game['team'] ? $game['team'] : [];
        return $this->collection($data, new base());
    }

    public function includeStats(array $game)
    {
        $data =  $game['team'] ? $game['team'] : [];
        return $this->collection($data, new stats());
    }

    public function includePlayByPlay(array $game)
    {
        return $this->item($game, new play_by_play_table());
    }

    public function includeGame(array $game)
    {
        return $this->item($game, new game());
    }
}
