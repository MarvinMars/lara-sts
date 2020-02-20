<?php

namespace App\Services\Stats\Traits\Football;

trait PassingTrait
{
    public function passingCmp(bool $format = true)
    {
        return $this->sum('pass', 'comp', $format);
    }

    public function passingAtt(bool $format = true)
    {
        return $this->sum('pass', 'att', $format);
    }

    public function passingInt(bool $format = true)
    {
        return $this->sum('pass', 'int', $format);
    }

    public function passingPercent()
    {
        $cmp = $this->passingCmp(false);
        $att = $this->passingAtt(false);

        if ((float)$att > 0) {
            return number_format(($cmp / $att) * 100, 2) . '%';
        } else {
            return '0%';
        }
    }

    public function passingYds(bool $format = true)
    {
        return $this->sum('pass', 'yds', $format);
    }

    public function passingTd(bool $format = true)
    {
        return $this->sum('pass', 'td', $format);
    }

    public function passingLong()
    {
        return $this->max('pass', 'long');
    }

    public function passingAvgP()
    {
        $yds = $this->passingYds(false);
        $att = $this->passingAtt(false);

        $result = ((float)$att > 0 ? ($yds / $att) : 0);

        return number_format($result, 2);
    }

    public function passingAvgG()
    {
        $yds = $this->passingYds(false);
        $gp = $this->gp();

        $result = ((float)$gp > 0 ? ($yds / $gp) : 0);

        return number_format($result, 2);
    }

    /**
     * @return int
     *
     * @formula [ { (8.4 * yards) + (330 * touchdowns) - (200 * interceptions) + (100 * completions) } / attempts ]
     */
    public function passingEffic()
    {
        $att = $this->passingAtt(false);

        $effic = 0;

        if ((float)$att > 0) {
            $effic = ((8.4 * $this->passingYds(false) + (330 * $this->passingTd(false)) - (200 * $this->passingInt(false)) + (100 * $this->passingCmp(false))) / $att);
        }


        return number_format($effic, 2);
    }
}