<?php
namespace App\Services\Stats\Tables\Basketball;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

class HighsTable extends AbstractTable
{
    use HighsQueryTrait;

    public function build(): array
    {
        $highs = [
            'points',                                       /* tp */
            'minutes',                                      /* min */
            'fieldGoalsMade',                               /* fgm */
            'fieldGoalAttempts',                            /* fga */
            'threePointFieldGoalsMade',                     /* fgm3 */
            'threePointFieldGoalAttempts',                  /* fga3 */
            'freeThrowsMade',                               /* ftm */
            'freeThrowAttempts',                            /* fta */
            'defRebounds',                                  /* dreb */
            'offRebounds',                                  /* oreb */
            'assists',                                      /* ast */
            'blocks',                                       /* blk */
            'steals',                                       /* stl */
        ];

        $result = [];

        foreach ($highs as $rush) {
            $rushValue = $this->get($rush);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function points()
    {
        return $this->first('stats', 'tp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function minutes()
    {
        return $this->first('stats', 'min');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function fieldGoalsMade()
    {
        return $this->first('stats', 'fgm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function fieldGoalAttempts()
    {
        return $this->first('stats', 'fga');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function threePointFieldGoalsMade()
    {
        return $this->first('stats', 'fgm3');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function threePointFieldGoalAttempts()
    {
        return $this->first('stats', 'fga3');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function freeThrowsMade()
    {
        return $this->first('stats', 'ftm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function freeThrowAttempts()
    {
        return $this->first('stats', 'fta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function defRebounds()
    {
        return $this->first('stats', 'dreb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function offRebounds()
    {
        return $this->first('stats', 'oreb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function assists()
    {
        return $this->first('stats', 'ast');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function blocks()
    {
        return $this->first('stats', 'blk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function steals()
    {
        return $this->first('stats', 'stl');

    }
}