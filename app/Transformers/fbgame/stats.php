<?php

namespace App\Transformers\fbgame;
use App\Transformers\fbgame\defensive;
use App\Transformers\fbgame\offensive;
use App\Transformers\fbgame\special;
use App\Transformers\fbgame\team;
use App\Transformers\fbgame\starters;
use App\Transformers\fbgame\participation;
use App\Transformers\Transformer;
use Illuminate\Support\Arr;
use App\Transformers\common\player;

class stats extends Transformer
{
    protected $defaultIncludes = [
        'offensive',
        'defensive',
        'special',
        'team_stats',
        'drive_chart',
        'starters',
        'participation'
    ];


    public function transform(array $game)
    {
        return [];
    }

    public function includeOffensive(array $game)
    {
        return $this->collection($game['team'], new offensive());
    }

    public function includeDefensive(array $game)
    {
        return $this->collection($game['team'], new defensive());
    }

    public function includeSpecial(array $game)
    {
        return $this->item($game, new special());
    }

    public function includeTeamStats(array $game)
    {
        return $this->item($game, new team());
    }

    public function includeDriveChart(array $game)
    {
        return $this->item($game, new drive_chart());
    }

    public function includeStarters(array $game)
    {
        return $this->collection($game['team'], new starters());
    }

    public function includeParticipation(array $game)
    {
        return $this->collection($game['team'], new participation());
    }

}
