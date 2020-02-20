<?php

namespace App\Transformers\vbgame;
use App\Transformers\vbgame\play_by_play_table;
use App\Transformers\common\stats;
use App\Transformers\Transformer;
use App\Transformers\vbgame\base;
use App\Transformers\common\game;
use App\Transformers\common\info_table;

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

    public function includeGame(array $game)
    {
        return $this->item($game, new game());
    }

    public function includeBase(array $game)
    {
        $data =  $game['team'] ? $game['team'] : [];
        return $this->collection($data, new base());
    }


    public function includePlayByPlay(array $game)
    {
        return $this->item($game, new play_by_play_table());
    }

    public function includeStats(array $game)
    {
        $data =  $game['team'] ? $game['team'] : [];
        return $this->collection($data, new stats());
    }
}
