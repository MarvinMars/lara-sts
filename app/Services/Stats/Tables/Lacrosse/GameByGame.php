<?php

namespace App\Services\Stats\Tables\Lacrosse;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class GameByGame
 * @package App\Services\Stats\Tables\Lacrosse
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
            $this->fpg(),
            $this->fps(),
            $this->minutes(),                            /* MIN */
            $this->groundBalls(),
            $this->ct(),
//            $this->fo(),
//            $this->foPercent(),
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
        $points = (int)$this->goals() + (int)$this->assists();
        return  $points ;
    }

    private function shots(bool $format = true)
    {
        return $this->sum('shots', 'sh', $format);
    }

    private function shotsPercent()
    {
        $g = $this->goals(false);
        $sh = $this->shots(false);

        return number_format(( (float)$sh > 0 ? ($g / $sh) : 0), 3);
    }

    private function shotsOnGoal(bool $format = true)
    {
        return $this->sum('shots', 'sog', $format);
    }

    private function shotsOnGoalPercent()
    {
        $sh = $this->shots(false);
        $sog = $this->shotsOnGoal(false);

        return number_format(( (float)$sh > 0 ? ($sog / $sh) : 0), 3);
    }

    private function gWins()
    {
        return $this->sum('goaltype', 'gw');
    }

    public function fpg()
    {
        return $this->sum('goaltype', 'freepos');
    }

    public function fps()
    {
        return $this->sum('shots', 'freepos');
    }

    private function minutes(bool $format = true)
    {
        return $this->sum('misc', 'minutes', $format);
    }

    public function groundBalls(bool $format = true)
    {
        return $this->sum('misc', 'gb', $format);
    }

    public function ct(bool $format = true)
    {
        return $this->sum('misc', 'ct', $format);
    }


    public function facewon(bool $format = true)
    {
        return $this->sum('misc', 'facewon', $format);
    }

    public function facelost(bool $format = true)
    {
        return $this->sum('misc', 'facelost', $format);
    }

    public function fo()
    {
        $facewon = $this->facewon();
        $facelost = $this->facewon();
        $fo = $facewon ? $facewon : 0 .'-'.  $facelost ? $facelost : 0;
        unset($facewon,$facelost);

        return $fo;
    }

    public function foPercent()
    {
        $facewon = $this->facewon();
        $g = $this->goals();

        $result = (( (float)$facewon > 0) ? ($g / $facewon) : 0);

        return number_format($result, 3);
    }
}
