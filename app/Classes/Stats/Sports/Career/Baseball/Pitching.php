<?php

namespace App\Classes\Stats\Sports\Career\Baseball;

use App\Classes\Stats\Sports\Career\AbstractCareer;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Season;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;


/**
 * Class Pitching
 * @package App\Classes\Stats\Sports\Career\Soccer
 */
class Pitching extends AbstractCareer
{
    /**
     * @var Season
     */
    private $season;

    /**
     * Pitching constructor.
     *
     * @param DatabaseCollection $queryResult
     * @param Player $player
     * @param Season|null $season
     */
    public function __construct(DatabaseCollection $queryResult, Player $player, Season $season = null)
    {
        $this->season = $season;
        parent::__construct($queryResult, $player);
    }

    //ERA = 9 × Earned Runs Allowed / Innings Pitched
    public function era()
    {
        $er = $this->er();
        $ip = $this->ip();

        if ((float)$ip > 0) {
            return ((9 * $er) / $ip);
        }

        return 0;
    }

    public function w_l()
    {
        return number_format($this->winOrLoss('win')) . '-' . number_format($this->winOrLoss('loss'));
    }

    /**
     * Get the win record based on values.
     *
     * @param string $key
     * @return float
     */
    public function winOrLoss(string $key = 'win')
    {
        $result = 0;
        /** @var PlayerValue $playerValue */
        $playerValue = PlayerValue::select(['raw_value'])
            ->leftJoin('games', 'games.id', '=', 'player_values.game_id')
            ->whereHas('game', function (Builder $query) {
                $query->whereHas('seasons', function (Builder $query) {
                    $query->where('id', '=', $this->season->id);
                });
            })
            ->where('player_id', '=', $this->player->id)
            ->where('group', '=', 'pitching')
            ->whereIn('key', ['win', 'loss'])
            ->orderByDesc('games.date')
            ->first();

        if ($playerValue) {
            $value = $playerValue->raw_value;

            $values = explode('-', $value);

            if (is_array($values)) {
                switch ($key) {
                    case 'win':
                        $result = array_first($values);
                        break;
                    case 'loss':
                        $result = array_last($values);
                        break;
                }
            }
        }

        return (float)$result;

    }

    public function app_gs()
    {
        return number_format($this->appear()) . '-' . number_format($this->gs());
    }

    public function appear()
    {
        return $this->_sumByGroupKey('pitching', 'appear');
    }

    public function gs()
    {
        return $this->_sumByGroupKey('pitching', 'gs');
    }

    public function cg()
    {
        return $this->_sumByGroupKey('pitching', 'cg');
    }

    public function sho()
    {
        return $this->_sumByGroupKey('pitching', 'sho');
    }

    public function sv()
    {
        return $this->_sumByGroupKey('pitching', 'save');
    }

    public function ip()
    {
        return $this->_sumByGroupKey('pitching', 'ip');
    }

    public function h()
    {
        return $this->_sumByGroupKey('pitching', 'h');
    }

    public function r()
    {
        return $this->_sumByGroupKey('pitching', 'r');
    }

    public function er()
    {
        return $this->_sumByGroupKey('pitching', 'er');
    }

    public function bb()
    {
        return $this->_sumByGroupKey('pitching', 'bb');
    }

    public function so()
    {
        return $this->_sumByGroupKey('pitching', 'so');
    }

    public function _2b()
    {
        return $this->_sumByGroupKey('pitching', 'double');
    }

    public function _3b()
    {
        return $this->_sumByGroupKey('pitching', 'triple');
    }

    public function hr()
    {
        return $this->_sumByGroupKey('pitching', 'hr');
    }

    public function ab()
    {
        return $this->_sumByGroupKey('pitching', 'ab');
    }

    //Batting Average = Total number of hits / Total number of at bats
    public function b_avg()
    {
        $hits = $this->h();
        $atBats = $this->ab();

        return ((float)$atBats > 0) ? ($hits / $atBats) : 0.000;
    }

    public function wp()
    {
        return $this->_sumByGroupKey('pitching', 'wp');
    }

    public function hbp()
    {
        return $this->_sumByGroupKey('pitching', 'hbp');
    }

    public function bk()
    {
        return $this->_sumByGroupKey('pitching', 'bk');
    }

    public function sfa()
    {
        return $this->_sumByGroupKey('pitching', 'sfa');
    }

    public function sha()
    {
        return $this->_sumByGroupKey('pitching', 'sha');
    }
}
