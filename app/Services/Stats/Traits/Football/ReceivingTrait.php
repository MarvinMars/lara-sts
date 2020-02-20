<?php

namespace App\Services\Stats\Traits\Football;

trait ReceivingTrait
{
    public function receivingAtt()
    {
        return $this->sum('rcv', 'att');
    }

    public function receivingYds(bool $format = true)
    {
        return $this->sum('rcv', 'yds', $format);
    }

    public function receivingTd()
    {
        return $this->sum('rcv', 'td');
    }

    public function receivingLong()
    {
        return $this->max('rcv', 'long');
    }

    public function receivingNo(bool $format = true)
    {
        return $this->sum('rcv', 'no', $format);
    }

    public function receivingAvg()
    {
        $yds = $this->receivingYds(false);
        $no = $this->receivingNo(false);

        $result = ((float)$no > 0 ? ($yds / $no) : 0);

        return number_format($result, 1);
    }

    public function receivingAvgG()
    {
        $yds = $this->receivingYds(false);
        $gp = $this->gp();

        $result = ((float)$gp > 0 ? ($yds / $gp) : 0);

        return number_format($result, 1);
    }
}