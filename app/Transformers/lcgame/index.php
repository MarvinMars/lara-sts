<?php

namespace App\Transformers\lcgame;
use App\Transformers\lcgame\play_by_play_table;
use App\Transformers\lcgame\stats;
use App\Transformers\lcgame\scoring_summary;
use App\Transformers\lcgame\team;
use App\Transformers\lcgame\ejections;
use App\Transformers\lcgame\goalie_stats;
use App\Transformers\Transformer;
use App\Transformers\lcgame\base;
use App\Transformers\common\info_table;

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
        $data =  $game['scores'] ? $game['scores'] : [];
        return $this->item($data, new play_by_play_table());
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
