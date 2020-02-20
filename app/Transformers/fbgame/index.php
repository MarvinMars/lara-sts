<?php

namespace App\Transformers\fbgame;

use App\Transformers\fbgame\play_by_play_table;
use App\Transformers\fbgame\stats;
use App\Transformers\fbgame\scoring_summary;
use App\Transformers\Transformer;
use App\Transformers\fbgame\base;
use App\Transformers\common\info_table;

class index extends Transformer
{
    protected $availableIncludes = [
        'info','base','stats','play_by_play'
    ];

    protected $defaultIncludes = [
        'scoring_summary'
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
        return $this->item($game, new stats());
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
}
