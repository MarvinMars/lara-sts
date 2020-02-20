<?php

namespace App\Services\Stats\Traits\Football;

trait InterceptionsTrait
{
    public function interceptionsTouchdowns(bool $format = true)
    {
        return $this->sum('ir', 'td', $format);
    }

    public function interceptionsLong(bool $format = true)
    {
        return $this->sum('ir', 'long', $format);
    }

    public function interceptionsYds(bool $format = true)
    {
        return $this->sum('ir', 'yds', $format);
    }
}