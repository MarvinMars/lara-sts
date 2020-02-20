<?php

namespace App\Classes\Stats\Sports\Traits;

trait TotalQuery
{
    public function _totalQuery(...$args)
    {
        $query = clone $this->query;

        if (is_array($args) && sizeof($args) === 2) {
            $query->where('group', '=', $args[0])->where('key', '=', $args[1]);
        }

        return (float)$query->sum('value');
    }

    public function _totalMaxQuery(... $args)
    {
        $query = clone $this->query;

        if (is_array($args) && sizeof($args) === 2) {
            $query->where('group', '=', $args[0])->where('key', '=', $args[1]);
        }

        return (float)$query->max('value');
    }
}
