<?php

namespace App\Services\Stats\Tables\Soccer;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class GameByGame
 * @package App\Services\Stats\Tables\Soccer
 */
class GameByGame extends AbstractTable
{

    use GameByGameQueryTrait;

    protected function build(): array
    {
        return [
            $this->gp(),                                 /* GP */
            $this->goals(),                              /* G */
            $this->assists(),                            /* A */
            $this->points(),                             /* PTS */
            $this->shots(),                              /* SH */
            $this->shotsPercent(),                       /* G/SH */
            $this->shotsOnGoal(),                        /* SOG */
            $this->shotsOnGoalPercent(),                 /* SOG% */
            $this->gWins(),                              /* GW */
            $this->minutes(),                            /* MIN */
        ];
    }

    private function goals(bool $format = true)
    {
        return $this->sum('shots', 'g', $format);
    }

    private function assists()
    {
        return $this->sum('shots', 'a');
    }

    private function points()
    {
        return $this->sum('shots', 'ps');
    }

    private function shots(bool $format = true)
    {
        return $this->sum('shots', 'sh', $format);
    }

    private function shotsPercent()
    {
        $g = $this->goals(false);
        $sh = $this->shots(false);

        $result = ( (float)$sh && $g) ? ($g / $sh) : 0;

        return number_format($result, 3);
    }

    private function shotsOnGoal(bool $format = true)
    {
        return $this->sum('shots', 'sog', $format);
    }

    private function shotsOnGoalPercent()
    {
        $g = $this->goals(false);
        $sog = $this->shotsOnGoal(false);
        $result = 0;

        if ((float)$sog > 0) {
            $result = (($sog && $g) ? ($g / $sog) : 0);
        }

        return number_format($result, 3);
    }

    private function gWins()
    {
        return $this->sum('goaltype', 'gw');
    }

    private function minutes(bool $format = true)
    {
        return $this->sum('misc', 'minutes', $format);
    }
}
