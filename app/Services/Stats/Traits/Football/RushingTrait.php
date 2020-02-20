<?php

namespace App\Services\Stats\Traits\Football;

trait RushingTrait
{

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function rushingAtt(bool $format = true)
    {
        return $this->sum('rush', 'att', $format);
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function rushingYds(bool $format = true)
    {
        return $this->sum('rush', 'yds', $format);
    }

    /**
     * @return float|string
     */
    public function rushingTd()
    {
        return $this->sum('rush', 'td');
    }

    /**
     * @param bool $format
     *
     * @return int
     */
    public function rushingLong(bool $format = true)
    {
        return $this->max('rush', 'long', $format) ?? 0;
    }


    /**
     * @return string
     */
    public function rushingAvgA()
    {
        $yds = $this->rushingYds(false);
        $att = $this->rushingAtt(false);

        $result = ((float)$att > 0 ? ($yds / $att) : 0);

        return number_format($result, 3);
    }

    /**
     * @return string
     */
    public function rushingAvgG()
    {
        $yds = $this->rushingYds(false);
        $gp = $this->gp();

        $result = ((float)$gp > 0 ? ($yds / $gp) : 0);

        return number_format($result, 1);
    }

    /**
     * @return float|string
     */
    public function rushingGain()
    {
        return $this->sum('rush', 'gain');
    }

    /**
     * @return float|string
     */
    public function rushingLoss()
    {
        return $this->sum('rush', 'loss');
    }
}