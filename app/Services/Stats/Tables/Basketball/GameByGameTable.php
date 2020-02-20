<?php
namespace App\Services\Stats\Tables\Basketball;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;
use App\Services\Stats\Traits\Basketball\GameAndCareerTrait;

/**
 * Class GameByGame
 * @package App\Services\Stats\Tables\Basketball
 */
class GameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, GameAndCareerTrait;

    public function build(): array
    {
        return [
            $this->points(),                                     /* pts */
            $this->minutes(),                                    /* min */
            $this->fgm_fga(),
            $this->fieldGoalPercent(),                           /* fgmApct */
            $this->threeFgM_threeFgA(),
            $this->threePointFieldGoalsPercent(),                /* threeFgApct */
            $this->ftm_fta(),
            $this->freeThrowsPercent(),                          /* ftmAPct */
            $this->offRebounds(),                                /* off */
            $this->defRebounds(),                                /* def */
            $this->totalRebounds(),                              /* total */
            $this->pf(),                                         /* pf */
            $this->assists(),                                    /* ast */
            $this->turnovers(),                                  /* to */
            $this->blocks(),                                     /* blk */
            $this->steals(),                                     /* stl */
        ];
    }

    /**
     * fgm -  fga
     */
    private function fgm_fga(){
        return $this->fieldGoalsMade() . ' - ' . $this->fieldGoalAttempts();
    }

    /**
     *
     * threeFgM - threeFgA
     */
    private function threeFgM_threeFgA(){
        return $this->threePointFieldGoalsMade() . ' - ' . $this->threePointFieldGoalAttempts();
    }
    /**
     * ftmM - ftmA
     */
    private function ftm_fta(){
        return $this->freeThrowsMade() . ' - ' . $this->freeThrowAttempts();
    }
}
