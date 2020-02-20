<?php

namespace App\Services\Stats\Tables\Basketball;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Basketball\GameAndCareerTrait;
use App\Services\Stats\Traits\CareerQueryTrait;

class CareerTable extends AbstractTable
{
    use CareerQueryTrait, GameAndCareerTrait;

    public function build(): array
    {
        return [
            $this->gp(),
            $this->minutes(),                           /* min */
            $this->fieldGoalsMade(),                    /* fgm */
            $this->fieldGoalAttempts(),                 /* fga */
            $this->fieldGoalPercent(),                  /* fgmApct */
            $this->threePointFieldGoalsMade(),          /* threeFgM */
            $this->threePointFieldGoalAttempts(),       /* threeFgA */
            $this->threePointFieldGoalsPercent(),       /* threeFgApct */
            $this->freeThrowsMade(),                    /* ftmM */
            $this->freeThrowAttempts(),                 /* ftmA */
            $this->freeThrowsPercent(),                 /* ftmAPct */
            $this->offRebounds(),                       /* off */
            $this->defRebounds(),                       /* def */
            $this->totalRebounds(),                     /* total */
            $this->pf(),
            $this->assists(),                           /* ast */
            $this->turnovers(),                         /* to */
            $this->blocks(),                            /* blk */
            $this->steals(),                            /* stl */
            $this->points(),                            /* pts */
        ];
    }
}