<?php

namespace App\Services\Stats\Tables\Softball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class Fielding
 * @package App\Services\Stats\Tables\IceHockey
 */
class Fielding extends AbstractTable
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
            $this->c(),
            $this->po(),
            $this->a(),
            $this->e(),
            $this->fldPercent(),
            $this->dp(),
            $this->sba(),
            $this->csb(),
            $this->pb(),
            $this->ci(),
        ];
    }

    public function c()
    {
        return $this->sum('fielding', 'c');
    }

    public function po()
    {
        return $this->sum('fielding', 'po');
    }

    public function a()
    {
        return $this->sum('fielding', 'a');
    }

    public function e()
    {
        return $this->sum('fielding', 'e');
    }

    /**
     * Number of attempts that resulted in an out compared to the number of total attempts.
     * Formula: (Putouts + Assists) / (Putouts + Assists + Errors)
     *
     * @return float|int
     */
    public function fldPercent()
    {
        $left = $this->po() + $this->a();
        $right = $this->po() + $this->a() + $this->e();

        $result = ((float)$right > 0 ? ($left / $right) : 0);

        return number_format($result, 3);
    }

    public function dp()
    {
        return $this->sum('fielding', 'indp');
    }

    public function sba()
    {
        return $this->sum('fielding', 'sba');
    }

    public function csb()
    {
        return $this->sum('fielding', 'csb');
    }

    public function pb()
    {
        return $this->sum('fielding', 'pb');
    }

    public function ci()
    {
        return $this->sum('fielding', 'ci');
    }
}