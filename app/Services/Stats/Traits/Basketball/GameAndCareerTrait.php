<?php
namespace App\Services\Stats\Traits\Basketball;


trait GameAndCareerTrait
{
    /**
     * @XML_field - min
     * @deprecated_param - min
     *
     * The total number of minutes a player is in the game.
     * To track this accurately you must make substitutions at the correct clock time.
     *
     * @return mixed
     */
    private function minutes()
    {
        return $this->sum('stats', 'min');
    }

    /**
     * @XML_field - to
     * @deprecated_param - to
     * the number of turnovers
     *
     * @return mixed
     */
    private function turnovers()
    {
        return $this->sum('stats', 'to');
    }

    /**
     * @XML_field - ast
     * @deprecated_param - ast
     * the number of assists
     *
     * @return mixed
     */
    private function assists()
    {
        return $this->sum('stats', 'ast');
    }

    /**
     * @XML_field - stl
     *
     * the number of steals by a defensive player or team
     *
     * @return mixed
     */
    private function steals()
    {
        return $this->sum('stats', 'stl');
    }

    /**
     * @XML_field - tp
     * @deprecated_param - tp
     * @return mixed
     */
    private function points()
    {
        return $this->sum('stats', 'tp');
    }

    /**
     * @XML_field - pf
     *
     *
     * @return mixed
     */
    private function pf()
    {
        return $this->sum('stats', 'pf');
    }

    /**
     * @XML_field - blk
     * @deprecated_param - blk
     * (Blk)
     * the number of blocks by a defensive player or team
     *
     * @return mixed
     */
    private function blocks()
    {
        return $this->sum('stats', 'blk');
    }

    /**
     * @XML_field - fgm
     *
     * the total number of field goals made, FG = 2Pt + 3Pt
     *
     * @param bool $format
     * @return mixed
     */
    private function fieldGoalsMade(bool $format = true)
    {
        return $this->sum('stats', 'fgm',$format);
    }

    /**
     * @XML_field - fga
     *
     * the total number of field goals attempted, FGA = 2PtA + 3PtA
     *
     * @param bool $format
     * @return mixed
     */
    private function fieldGoalAttempts(bool $format = true)
    {
        return $this->sum('stats', 'fga',$format);
    }

    /**
     * @deprecated_param - fgmApct
     *
     * the percentage of 3 point shot made, FG% = (FG / FGA) x 100
     *
     * @param bool $format
     * @return mixed
     */
    private function fieldGoalPercent(bool $format = true)
    {
        $fgm = $this->fieldGoalsMade(false);
        $fga = $this->fieldGoalAttempts(false);
        $result = (float)$fga > 0 ? (($fgm / $fga) * 100) : 0;

        return ($format ? number_format($result,2).'%' : $result);
    }

    /**
     * @XML_field - fga3
     * @deprecated_param - threeFgA
     *
     * the number of 3 point shot attempts
     *
     * @param bool $format
     * @return mixed
     */
    private function threePointFieldGoalAttempts(bool $format = true)
    {
        return $this->sum('stats', 'fga3',$format);
    }

    /**
     * @XML_field fgm3
     *
     * @deprecated_param threeFgM
     * the total number of field goals made, FG = 2Pt + 3Pt
     *
     * @param bool $format
     * @return mixed
     */
    private function threePointFieldGoalsMade(bool $format = true)
    {
        return $this->sum('stats', 'fgm3',$format);
    }

    /**
     * the percentage of 3 point shot made, FG% = (FG / FGA) x 100
     * @deprecated_param threeFgApct
     *
     * @param bool $format
     * @return mixed
     */
    private function threePointFieldGoalsPercent(bool $format = true)
    {
        $fgm = $this->threePointFieldGoalsMade(false);
        $fga = $this->threePointFieldGoalAttempts(false);
        $result = (float)$fga > 0 ? (($fgm / $fga) * 100) : 0;

        return ($format ? number_format($result,2).'%'  : $result);
    }

    /**
     * @XML_field - ftm
     * @deprecated_param ftmM
     *
     * the number of free throws made
     * (FT)
     *
     * @param bool $format
     * @return mixed
     */
    private function freeThrowsMade(bool $format = true)
    {
        return $this->sum('stats', 'ftm', $format);
    }

    /**
     * @XML_field - fta
     * @deprecated_param ftmA
     *
     * the number of free throw attempts
     * (FTA)
     *
     * @param bool $format
     * @return mixed
     */
    private function freeThrowAttempts(bool $format = true)
    {
        return $this->sum('stats', 'fta', $format);
    }

    /**
     * @deprecated_param ftmAPct
     *
     * the percentage of free throws made, FT% = (FT / FTA) x 100
     * (FT%)
     *
     * @param bool $format
     * @return mixed
     */
    private function freeThrowsPercent(bool $format = true)
    {
        $ftm = $this->freeThrowsMade(false);
        $fta = $this->freeThrowAttempts(false);

        $result = (float)$fta > 0  ? (($ftm / $fta) * 100) : 0;

        return ($format ? number_format($result,2).'%'  : $result);
    }

    /**
     * @XML_field - oreb
     * @deprecated_param off
     * (OReb)
     *
     * the number of offensive rebounds
     *
     * @param bool $format
     * @return mixed
     */
    private function offRebounds(bool $format = true)
    {
        return $this->sum('stats', 'oreb', $format);
    }

    /**
     * @XML_field - dreb
     * @deprecated_param def
     * (DReb)
     *
     * the number of defensive rebounds
     *
     * @return mixed
     */
    private function defRebounds(bool $format = true)/* def */
    {
        return $this->sum('stats', 'dreb', $format);
    }

    /**
     * @deprecated_param total
     * (Reb)
     *
     * the total number of rebounds, Total Reb = Off Reb + Def Reb
     *
     * @param bool $format
     * @return mixed
     */
    private function totalRebounds(bool $format = true)
    {
        $result = $this->offRebounds(false) + $this->defRebounds(false);
        return ($format ?  number_format($result) : $result);
    }

}