<?php

namespace App\Services\Stats\Repositories;

use Countable;
use Iterator;

/**
 * Class Repository.
 */
class Repository extends \Illuminate\Config\Repository implements Iterator, Countable
{
    /**
     * Repository constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }


    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function getData(string $key, $default = null)
    {
        return array_get($this->items, $key, $default);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function toEncodedArray(): array
    {
        return array_map(function (string $value) {
            return urlencode($value);
        }, $this->items);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * @return int|mixed
     */
    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->items[$this->position]);
    }
}
