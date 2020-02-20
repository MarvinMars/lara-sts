<?php

namespace App\Classes\Stats\Sports;

use App\Models\Game;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

class SportClass
{

    protected $player;
    protected $game;
    protected $season;
    protected $namespace;

    protected static $instance;

    public function __construct(Player $player, Game $game = null, Season $season = null)
    {
        $this->player = $player;
        $this->game = $game;
        $this->season = $season;
    }

    /**
     * Get an instance of the class.
     *
     * @param Player $player
     * @param Game|null $game
     * @param Season|null $season
     * @return $this
     */
    public static function instance(Player $player, Game $game = null, Season $season = null)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($player, $game, $season);
        }

        return self::$instance;
    }

    /**
     * @param string $method
     * @return array
     */
    public function get(string $method)
    {
        $value = [];

        try {
            $value = $this->$method();
        } catch (\Exception $e) {
            \Log::critical(sprintf("Message: %s\n File: %s\n Line: %s\n Trace: %s", $e->getMessage(), $e->getFile(),
                $e->getLine(), $e->getTraceAsString()));
        }

        return $value;
    }

    public function __call($name, $attributes)
    {
        $isTotal = false;
        if (starts_with($name, 'total')) {
            $isTotal = true;
            $name = str_after($name, 'total');
        }
        $class = $this->namespace . studly_case($name);

        if (class_exists($class)) {
            if ($isTotal) {
                $class = new $class($this->_getSeasonQuery());
            } else {
                $class = new $class($this->_getQuery());
            }

            return $class->getValues();
        }

        return [];
    }

    /**
     * @return Collection
     */
    protected function _getQuery()
    {
        return PlayerValue::remember(10)->wherePlayerId($this->player->id)->whereGameId($this->game->id)->get();
    }

    /**
     * @return Collection
     */
    protected final function _getSeasonQuery()
    {
        return PlayerValue::remember(10)->wherePlayerId($this->player->id)->whereHas('game', function ($query) {
            $query->whereHas('seasons', function ($subQuery) {
                $subQuery->whereId($this->season->id);
            });
        })->get();
    }
}
