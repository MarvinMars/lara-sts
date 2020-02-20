<?php

namespace App\Classes\Stats\Sports\BaseballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;
use Illuminate\Database\Eloquent\Builder;

class Fielding extends AbstractGame
{
    public function c()
    {
        return $this->_getQuery('fielding', 'c');
    }

    public function po()
    {
        return $this->_getQuery('fielding', 'po');
    }

    public function a()
    {
        return $this->_getQuery('fielding', 'a');
    }

    public function e()
    {
        return $this->_getQuery('fielding', 'e');
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

        return ((float)$right > 0 ? ($left / $right) : 0);
    }

    public function dp()
    {
        return $this->_getQuery('fielding', 'indp');
    }

    public function sba()
    {
        return $this->_getQuery('fielding', 'sba');
    }

    public function csb()
    {
        return $this->_getQuery('fielding', 'csb');
    }

    public function pb()
    {
        return $this->_getQuery('fielding', 'pb');
    }

    public function ci()
    {
        return $this->_getQuery('fielding', 'ci');
    }


    public function getValues()
    {
        // TODO: Implement getValues() method.
    }
}
