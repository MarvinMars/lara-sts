<?php

namespace App\Services\Stats\Traits\Football;

trait ScoringTrait
{
    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function scoringTd(bool $format = true)
    {
        return $this->sum('scoring', 'td', $format);
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function scoringRush(bool $format = true)
    {
        return $this->sum('rush', 'yds', $format);
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function scoringRec(bool $format = true)
    {
        return $this->sum('rcv', 'yds', $format);
    }

    /**
     * @return float|string
     */
    public function scoringRet()
    {
        return $this->sum('punt', 'no');
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function scoringFg(bool $format = true)
    {
        return $this->sum('scoring', 'fg', $format);
    }

    /**
     * @return float|string
     */
    public function scoringPat()
    {
        return $this->sum('scoring', 'patkick');
    }

    /**
     * @return float|string
     */
    public function scoringTwoPt()
    {
        return $this->sum('punt', 'plus50');
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function scoringTot(bool $format = true)
    {
        $result = $this->scoringRec(false) + $this->scoringRush(false);

        return $format === true ? number_format($result) : $result;
    }

    /**
     * @return float|int
     */
    public function scoringAvgG()
    {
        $tot = $this->scoringTot(false);
        $gp = $this->gp();

        $result = ((float)$gp > 0 ? ($tot / $gp) : 0);

        return number_format($result, 1);
    }

    /**
     * https://en.wikipedia.org/wiki/American_football_rules#Scoring
     * http://www.ncaa.org/playing-rules/football-rules-game
     *
     * @return string
     */
    public function scoringPoints()
    {
        $ponts = 0;
        $ponts += $this->scoringTd(false) * 6;
        $ponts += $this->scoringFg(false) * 3;

        return number_format($ponts);
    }
}