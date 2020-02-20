<?php

namespace App\Transformers\hkgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;
use App\Transformers\hkgame\goalkeeping;
use App\Transformers\hkgame\shots_by_period;
use App\Transformers\hkgame\faceoff;

class stats extends Transformer
{
    protected $defaultIncludes = [
        'faceoff',
        'shots_by_period',
        'goalkeeping'
    ];

    public function transform(array $game)
    {
        return [];
    }

    public function includeFaceoff(array $game)
    {
        return $this->collection($game['team'], new faceoff());
    }

    public function includeShotsByPeriod(array $game)
    {
        return $this->collection($game['team'], new shots_by_period());
    }

    public function includeGoalkeeping(array $game)
    {
        return $this->collection($game['team'], new goalkeeping());
    }
}
