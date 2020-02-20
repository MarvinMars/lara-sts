<?php

namespace App\Transformers\bsgame;

use App\Transformers\bsgame\play_by_play_table;
use App\Transformers\bsgame\scoring_summary;
use App\Transformers\bsgame\stats;
use App\Transformers\common\game;
use App\Transformers\Transformer;
use App\Transformers\bsgame\base;
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
        $data =  $game['plays'] ? $game['plays'] : [];
        return $this->item($data, new play_by_play_table());
    }

    public function includeScoringSummary(array $game)
    {
        $data =  $game['scores'] ? $game['scores'] : [];
        return $this->item($data, new scoring_summary());
    }

    public function includeGame(array $game)
    {
        return $this->item($game, new game());
    }
}
