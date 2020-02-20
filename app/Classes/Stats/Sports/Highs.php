<?php

namespace App\Classes\Stats\Sports;

use App\Classes\Stats\Sports\Highs\BaseballHighs;
use App\Classes\Stats\Sports\Highs\BasketballHighs;
use App\Classes\Stats\Sports\Highs\FootballHighs;
use App\Classes\Stats\Sports\Highs\SoccerHighs;
use App\Classes\Stats\Sports\Highs\LacrosseHighs;
use App\Classes\Stats\Sports\Highs\VolleyballHighs;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Season;

class Highs extends SportClass
{

    public function __construct(Player $player, Season $season)
    {
        parent::__construct($player, null, $season);
    }


    public function footballValues()
    {
        $footballHighs = new FootballHighs($this->_getQuery());

        $rushs = [
            'rushingYards',
            'longestRush',
            'rushingTouchdowns',
            'receptionYards',
            'longestReception',
            'receivingTouchdowns',
            'passingYards',
            'longestPass',
            'passingTouchdowns',
        ];

        $result = [];

        foreach ($rushs as $rush) {
            $rushValue = $footballHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;

    }

    public function volleyballValues()
    {
        $volleyballHighs = new VolleyballHighs($this->_getQuery());

        $rushs = [
            'kills',
            'assists',
            'points',
            'aces',
            'digs',
            'totalBlocks',
        ];

        $result = [];

        foreach ($rushs as $rush) {
            $rushValue = $volleyballHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;

    }

    public function baseballValues()
    {
        $baseballHighs = new BaseballHighs($this->_getQuery());

        $highs = [
            'hits',
            'doubles',
            'triples',
            'homeRuns',
            'runsScored',
            'runsBattedIn',
            'basesStolen',
            'assist',
            'putouts',
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $baseballHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    public function baseballPitchingValues()
    {
        $baseballHighs = new BaseballHighs($this->_getQuery());

        $highs = [
            'inningPitched',
            'strikeouts'
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $baseballHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    /* @deprecated  */
    public function basketballValues()
    {
        $baseballHighs = new BasketballHighs($this->_getQuery());

        $highs = [
            'points',
            'minutes',
            'fieldGoalsMade',
            'fieldGoalAttempts',
            'threePointFieldGoalsMade',
            'threePointFieldGoalAttempts',
            'freeThrowsMade',
            'freeThrowAttempts',
            'defRebounds',
            'offRebounds',
            'assists',
            'blocks',
            'steals',
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $baseballHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }


    public function soccerValues()
    {
        $soccerHighs = new SoccerHighs($this->_getQuery());


        $highs = [
            'shots',
            'shotsOnGoal',
            'goals',
            'assists',
            'minutes',
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $soccerHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    public function soccerGoalkeepingValues()
    {
        $soccerHighs = new SoccerHighs($this->_getQuery());

        $highs = [
            'shotsFaced',
            'saves',
            'goalsAllowed',
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $soccerHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    public function lacrosseValues()
    {
        $soccerHighs = new LacrosseHighs($this->_getQuery());


        $highs = [
            'shots',
            'shotsOnGoal',
            'goals',
            'assists',
            'minutes',
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $soccerHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    public function lacrosseGoalkeepingValues()
    {
        $soccerHighs = new LacrosseHighs($this->_getQuery());

        $highs = [
            'shotsFaced',
            'saves',
            'goalsAllowed',
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $soccerHighs->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function _getQuery()
    {
        $query = PlayerValue::remember(10)
            ->select([
                \DB::raw('MAX(value) as aggregate'),
                'game_id',
                'player_id',
            ])->wherePlayerId($this->player->id)
            ->whereHas('game', function ($query) {
                $query->whereHas('seasons', function ($query) {
                    $query->where('id', '=', $this->season->id);
                });
            })->limit(1)->groupBy(['game_id', 'player_id'])->with('game',
                'player')->orderByDesc('aggregate');

        return $query;
    }
}
