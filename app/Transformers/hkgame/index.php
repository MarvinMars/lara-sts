<?php

namespace App\Transformers\hkgame;

use App\Transformers\Transformer;

use App\Transformers\hkgame\base;
use App\Transformers\common\info_table;
use App\Transformers\hkgame\scoring_summary;
use App\Transformers\hkgame\power_play_summary;
use App\Transformers\hkgame\penalty_summary;

use App\Transformers\hkgame\stats;

use App\Transformers\hkgame\play_by_play_table;

class index extends Transformer
{
    protected $availableIncludes = [
        'info','base','stats','play_by_play'
    ];

    protected $defaultIncludes = [
        'scoring_summary',
        'power_play_summary',
        'penalty_summary',
    ];

    public function transform(array $game)
    {
        return [];
    }

    public function includeInfo(array $game)
    {
        $data = $game['venue'] ? $game['venue'] : [];

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
        return $this->item($game, new play_by_play_table());
    }

    public function includeScoringSummary(array $game)
    {
        $data =  $game['scores'] ? $game['scores'] : [];
        return $this->item($data, new scoring_summary());
    }

    public function includePowerPlaySummary(array $game)
    {
        $data =  $game['team'] ? $game['team'] : [];
        return $this->item($data, new power_play_summary());
    }

    public function includePenaltySummary(array $game)
    {
        $data =  $game['penalties'] ? $game['penalties'] : [];
        return $this->item($data, new penalty_summary());
    }
}
