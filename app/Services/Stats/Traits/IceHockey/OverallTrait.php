<?php

namespace App\Services\Stats\Traits\IceHockey;

trait OverallTrait
{
    /**
     * Goals: total number of goals the player has scored in the current season.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function goals(bool $format = true)
    {
        return $this->sum('shots', 'g', $format);
    }

    /**
     *  Assists: number of goals the player has assisted in the current season.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function assist(bool $format = true)
    {
        return $this->sum('shots', 'a', $format);
    }

    /**
     * Goals + Assists
     *
     * @return float|string
     */
    private function pts()
    {
        return number_format($this->goals(false) + $this->assist(false));
    }

    /**
     *  Shots: total number of shots taken on net in the current season.
     *
     * @param bool $format
     *
     * @return float|string
     *
     */
    private function shots(bool $format = true)
    {
        return $this->sum('shots', 'sh', $format);
    }

    /**
     * Shots on Goal Percentage.
     *
     * @return string
     */
    private function shotsPct()
    {
        $result = 0;
        $sh = $this->shots(false);
        $g = $this->goals(false);

        if ((float)$sh > 0) {
            $result = ((float)$g / $sh);
        }

        return number_format($result, 3);
    }

    /**
     * Plus Minus.
     *
     * @return float|string|string
     */
    private function plusMinus()
    {
        $plusMinus = $this->sum('misc', 'plusminus');

        if ($plusMinus > 0) {
            return '+' . $plusMinus;
        }

        return $plusMinus;
    }

    /**
     * Penalty minutes count.
     *
     * @return string
     */
    private function penaltyMin()
    {
        $penCount = $this->penalties(true);
        $min = $this->sum('penalty', 'minutes');

        return $penCount . '-' . $min;
    }

    /**
     * Penalties count.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function penalties(bool $format = true)
    {
        return $this->sum('penalty', 'count', $format);
    }

    /**
     * Minors.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function minors(bool $format = true)
    {
        return $this->sum('penalty', 'minor', $format);
    }

    /**
     * Penalty majors.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function majors(bool $format = true)
    {
        return $this->sum('penalty', 'major', $format);
    }

    /**
     * Penalties others.
     *
     * @return float|string
     */
    private function penaltyOthers()
    {
        return $this->sum('penalty', ['misc10', 'miscgame', 'miscgross', 'match']);
    }

    /**
     * Power play goals: number of goals the player has scored while his team was on the power play.
     *
     * @return float|string
     */
    private function powerPlayGoals()
    {
        return $this->sum('goaltype', 'pp');
    }

    /**
     * Empty net goals: number of goals scored on an empty net.
     *
     * @return float|string
     */
    private function emptyNetGoals()
    {
        return $this->sum('goaltype', 'en');
    }

    /**
     * Game-winning goals: number of game-winning goals the player has scored
     * (a goal is considered game winning when the team would win the game without scoring any more goals, for example, the winning team's third goal in a 5–2 win).
     *
     * @return float|string
     */
    private function gameWinningGoals()
    {
        return $this->sum('goaltype', 'gw');
    }

    /**
     * Game-tying goals: number of game-tying (that is, the last goal scored in a tie game) goals the player has scored.
     *
     * @return float|string
     */
    private function gameTyingGoals()
    {
        return $this->sum('goaltype', 'gt');
    }

    /**
     * @return float|string
     */
    private function unassistedGoal()
    {
        return $this->sum('goaltype', 'ua');
    }

    /**
     * Short-handed goals
     *
     * @return mixed
     */
    private function shortHandedGoals()
    {
        return $this->sum('goaltype', 'sh');
    }

    /**
     * Blocked shots.
     *
     * @return float|string
     */
    private function blockedShots()
    {
        return $this->sum('misc', 'blk');
    }

    /**
     * @return float|string
     */
    private function faceLost()
    {
        return $this->sum('misc', 'facelost');
    }

    /**
     * @return float|string
     */
    private function faceWon()
    {
        return $this->sum('misc', 'facewon');
    }
}
