<?php

namespace App\Classes\Stats\Sports\Career;

use App\Classes\Stats\Sports\Traits\CloneQuery;
use App\Models\Player;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;

abstract class AbstractCareer
{
    use CloneQuery;

    protected $player;
    protected $queryResult;

    /**
     * AbstractFootballGame constructor.
     * @param Collection $queryResult
     * @param Player $player
     */
    public function __construct(DatabaseCollection $queryResult, Player $player)
    {
        $this->queryResult = $queryResult;
        $this->player = $player;
    }

    /**
     * Game played
     *
     * @return int
     */
    public function gp()
    {
        return $this->queryResult
            ->where('key', '=', 'gp')
            ->where('value', '=', 1)
            ->groupBy('game_id')->count();
    }


    /**
     * @param array ...$args
     * @return DatabaseCollection|static
     */
    public function _groupQuery(...$args)
    {
        if ($args && is_array($args)) {
            return $this->queryResult->whereIn('group', $args);
        } else {
            return $this->queryResult;
        }
    }

    /**
     * @param $group
     * @param $key
     * @return float
     */
    public function _sumByGroupKey($group, $key)
    {
        return (float)$this->queryResult->where('group', '=', $group)
            ->where('key', '=', $key)
            ->sum('value');
    }

    /**
     * @param $group
     * @param $key
     * @return float
     */
    public function _maxByGroupKey($group, $key)
    {
        return (float)$this->queryResult
            ->where('group', '=', $group)
            ->where('key', '=', $key)
            ->max('value');
    }
}
