<?php

namespace App\Classes\Stats\Sports\Highs;

/**
 * Class BasketballHighs
 * @package App\Classes\Stats\Sports\Highs
 */
class BasketballHighs extends AbstractHighs
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function points()
    {
        return $this->_getQuery('stats', 'tp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function minutes()
    {
        return $this->_getQuery('stats', 'min');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function fieldGoalsMade()
    {
        return $this->_getQuery('stats', 'fgm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function fieldGoalAttempts()
    {
        return $this->_getQuery('stats', 'fga');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function threePointFieldGoalsMade()
    {
        return $this->_getQuery('stats', 'fgm3');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function threePointFieldGoalAttempts()
    {
        return $this->_getQuery('stats', 'fga3');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function freeThrowsMade()
    {
        return $this->_getQuery('stats', 'ftm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function freeThrowAttempts()
    {
        return $this->_getQuery('stats', 'fta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function defRebounds()
    {
        return $this->_getQuery('stats', 'dreb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function offRebounds()
    {
        return $this->_getQuery('stats', 'oreb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function assists()
    {
        return $this->_getQuery('stats', 'ast');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function blocks()
    {
        return $this->_getQuery('stats', 'blk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function steals()
    {
        return $this->_getQuery('stats', 'stl');

    }
}
