<?php

namespace App\Transformers\sogame;

use App\Transformers\sogame\team;
use App\Transformers\Transformer;
use App\Transformers\sogame\base;
use App\Transformers\sogame\ejections;
use App\Transformers\common\info_table;
use App\Transformers\sogame\scoring_summary;
use App\Transformers\sogame\play_by_play_table;
use App\Transformers\sogame\goalie_stats;
use App\Transformers\sogame\stats;

class index extends Transformer
{
    protected $availableIncludes = [
        'info','base','stats','play_by_play'
    ];

    protected $defaultIncludes = [
        'scoring_summary',
        'ejections',
        'team',
        'goalie_stats'
    ];

    public function transform(array $game)
    {
        return [] ;
    }

    public function includeInfo(array $game)
    {
        $data = $game['venue'] ?  $game['venue'] : [];

        return $this->item($data, new info_table());
    }

    public function includeBase(array $game)
    {
        $data = $game['team'] ?  $game['team'] : [];

        return $this->collection($data, new base());
    }

    public function includeStats(array $game)
    {
        $data = $game['team'] ?  $game['team'] : [];
        return $this->collection($data, new stats());
    }

    public function includePlayByPlay(array $game)
    {
        return $this->item($game, new play_by_play_table());
    }

    public function includeScoringSummary(array $game)
    {
        $data = $game['scores'] ?  $game['scores'] : [];
        return $this->item($data, new scoring_summary());
    }

    public function includeEjections(array $game)
    {
        $data = isset($game['penalties']) ? $game['penalties'] : [];
        return $this->item($data, new ejections());
    }

    public function includeTeam(array $game)
    {
        $data = $game['team'] ?  $game['team'] : [];
        return $this->item($data, new team());
    }

    public function includeGoalieStats(array $game)
    {
        $data = $game['team'] ?  $game['team'] : [];
        return $this->collection($data, new goalie_stats());
    }
}
