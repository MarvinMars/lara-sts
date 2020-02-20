<?php

namespace App\Services\Stats\Tables;


use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException;
use App\Services\Stats\Repositories\Repository;
use Cache;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class AbstractTable
 * @package App\Services\Stats\Tables
 */
abstract class AbstractTable
{
    const CACHE_TAGS = [
        'stats_tables'
    ];

    /**
     * Cache time in seconds.
     *
     * @var int
     */
    protected $cache_time = 86400 * 7;

    /**
     * All items in one array.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Current player.
     *
     * @var Player
     */
    protected $player;

    /**
     * Current season or null.
     *
     * @var Season|null
     */
    protected $season;

    /**
     * Current game or null.
     *
     * @var Game
     */
    protected $game;

    /**
     * Return raw repository.
     *
     * @var bool
     */
    protected $raw = false;

    /**
     * Current active query method.
     *
     * @var Builder
     */
    protected $query_method;

    /**
     * AbstractTable constructor.
     *
     * @param Player $player
     * @param Season|null $season
     * @param Game|null $game
     * @param bool $raw
     *
     * @throws QueryMethodDoesNotDefinedException
     */
    public function __construct(Player $player, Season $season = null, Game $game = null, bool $raw = false)
    {
        $this->player = $player;
        $this->season = $season;
        $this->game = $game;
        $this->raw = $raw;
        $this->setQueryMethod('query');
        $this->setItems();
    }

    /**
     * Return repository for specific table;
     *
     * @return Repository
     */
    public final function getRepository(): Repository
    {
        return new Repository($this->items);
    }

    /**
     * Return columns for the table.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [];
    }

    /**
     * Clone original query and return it.
     *
     * @param string $group
     * @param array $keys
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function getQuery(string $group, array $keys)
    {
        return call_user_func([$this, $this->query_method])
            ->where('group', '=', $group)
            ->whereIn('key', $keys);
    }

    /**
     * Return first value for specified group and key.
     *
     * @param string $group
     * @param string|array $key
     *
     * @return Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public final function first(string $group, $key)
    {
        if (is_string($key)) {
            $key = array_wrap($key);
        }

        return $this->getQuery($group, $key)->first();
    }

    /**
     * Return all values for specified group and key.
     *
     * @param string $group
     * @param $key
     *
     * @return Collection
     */
    public final function all(string $group, $key)
    {
        if (is_string($key)) {
            $key = array_wrap($key);
        }

        return $this->getQuery($group, $key)->get();
    }

    /**
     * Return summary values for the specified group and key.
     *
     * Format allow bool to convert it with the number_format as default,
     * Closure function to convert it by manual and array to convert it with the function.
     * In array you must provide parameters
     *
     * @param string $group
     * @param string|array $key
     * @param bool|Closure|array
     * @param string $sum_column
     *
     * @return float|string
     */
    public final function sum(string $group, $key, $format = true, string $sum_column = 'value')
    {
        if (is_string($key)) {
            $key = array_wrap($key);
        }
        $response = $this->getQuery($group, $key)->sum($sum_column);

        if (!$this->raw) {
            if (is_bool($format) && $format === true) {
                $response = number_format($response);
            } elseif ($format instanceof Closure) {
                $response = $format($response);
            }
        }

        return $response;
    }

    public final function count(string $group, $key)
    {
        if (is_string($key)) {
            $key = array_wrap($key);
        }

        return $this->getQuery($group, $key)->count('id');
    }

    /**
     * Get max value for specified key and group.
     *
     * @param string $group
     * @param string $key
     *
     * @param bool $format
     *
     * @return mixed
     */
    public final function max(string $group, string $key, $format = true)
    {
        $response = $this->getQuery($group, [$key])->max('value');

        if (!$this->raw) {
            if (is_bool($format) && $format === true) {
                $response = number_format($response);
            } elseif ($format instanceof Closure) {
                $response = $format($response);
            }
        }

        return $response;
    }

    /**
     * Return number of the played games for the player and for the current season.
     *
     * @return int
     */
    public final function gp(): int
    {
        return $this->query()
            ->select('game_id')
            ->where('key', '=', 'gp')
            ->where('value', '=', 1)
            ->groupBy('game_id')
            ->get('game_id')
            ->count();
    }

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     */
    protected abstract function build(): array;

    /**
     * Query must return prepared builder for the next queries.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected abstract function query(): Builder;

    /**
     * Clone the instance.
     *
     * @return \App\Services\Stats\Tables\AbstractTable
     */
    public final function clone()
    {
        return clone $this;
    }

    /**
     * Set the season.
     *
     * @param \App\Models\Season $season
     *
     * @return $this
     */
    public final function setSeason(Season $season)
    {
        $this->season = $season;

        return $this->setItems();
    }

    /**
     * Set the game.
     *
     * @param \App\Models\Game $game
     *
     * @return $this
     */
    public final function setGame(Game $game)
    {
        $this->game = $game;

        return $this->setItems();
    }


    /**
     * Set the current active query method.
     *
     * @param string $method
     *
     * @return AbstractTable
     * @throws QueryMethodDoesNotDefinedException
     */
    public final function setQueryMethod(string $method): self
    {
        if (!method_exists($this, $method)) {
            throw new QueryMethodDoesNotDefinedException(sprintf('[%s] does not defined in [%s]', $method, __CLASS__));
        }
        $this->query_method = $method;

        return $this;
    }

    /**
     * Set the items and cache the results if it needed.
     */
    public final function setItems(): self
    {
        $key = sha1(serialize($this));

        $items = [];

        if (Cache::tags(self::CACHE_TAGS)->has($key) && !\App::isLocal()) {
            $maybeItems = Cache::tags(self::CACHE_TAGS)->get($key);

            if (is_array($maybeItems)) {
                $items = $maybeItems;
            }
        }
        $this->items = $items ?: $this->build();

        try {
            Cache::tags(self::CACHE_TAGS)->set($key, $this->items, $this->cache_time);
        } catch (InvalidArgumentException $e) {
            \Log::critical(sprintf('Can not set the cache %s: %s', $key, $e->getMessage()));
        }

        return $this;
    }

}
