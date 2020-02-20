<?php

namespace App\Services\Stats\Tables\Softball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class Hitting
 * @package App\Services\Stats\Tables\IceHockey
 */
class Hitting extends AbstractTable
{
    use GameByGameQueryTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->gs(),
            $this->ab(),
            $this->r(),
            $this->h(),
            $this->rbi(),
            $this->twoB(),
            $this->threeB(),
            $this->hr(),
            $this->bb(),
            $this->ibb(),
            $this->sb(),
            $this->sba(),
            $this->cs(),
            $this->hbp(),
            $this->sh(),
            $this->sf(),
            $this->gdp(),
            $this->k(),
            number_format($this->player->getAvg($this->season, $this->game, 'hitting'), 3)
        ];
    }

    public function gs()
    {
        return $this->sum('player', 'gs');
    }

    public function ab()
    {
        return $this->sum('hitting', 'ab');
    }

    public function r()
    {
        return $this->sum('hitting', 'r');
    }

    public function h()
    {
        return $this->sum('hitting', 'h');
    }

    public function rbi()
    {
        return $this->sum('hitting', 'rbi');
    }

    public function twoB()
    {
        return $this->sum('hitting', 'double');
    }

    public function threeB()
    {
        return $this->sum('hitting', 'triple');
    }

    public function hr()
    {
        return $this->sum('hitting', 'hr');
    }

    public function bb()
    {
        return $this->sum('hitting', 'bb');
    }

    public function ibb()
    {
        return $this->sum('hitting', 'ibb');
    }

    public function sb()
    {
        return $this->sum('hitting', 'sb');
    }

    public function sba()
    {
        return $this->sum('hitting', 'sba');
    }

    public function cs()
    {
        return $this->sum('hitting', 'cs');
    }

    public function hbp()
    {
        return $this->sum('hitting', 'hbp');
    }

    public function sh()
    {
        return $this->sum('hitting', 'sh');
    }

    public function sf()
    {
        return $this->sum('hitting', 'sf');
    }

    public function gdp()
    {
        return $this->sum('hitting', 'gdp');
    }

    public function k()
    {
        return $this->sum('hitting', 'so');
    }


}