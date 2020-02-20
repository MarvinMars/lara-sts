<?php

namespace App\Classes\Stats\Sports\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait CloneQuery
{
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @param array $args
     * @return Builder
     */
    public function _getQuery(...$args)
    {
        if ($this->query instanceof Builder) {
            return clone $this->query;
        } elseif ($this->query instanceof Collection) {
            return $this->query;
        }

        $this->query = collect();

        return $this->query;
    }
}
