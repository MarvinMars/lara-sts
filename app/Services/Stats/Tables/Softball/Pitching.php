<?php

namespace App\Services\Stats\Tables\Softball;


use App\Models\PlayerValue;
use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Pitching
 * @package App\Services\Stats\Tables\IceHockey
 */
class Pitching extends AbstractTable
{
    use CareerQueryTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->era(),
            $this->w_l(),
            $this->app_gs(),
            $this->cg(),
            $this->sho(),
            $this->sv(),
            $this->ip(),
            $this->h(),
            $this->r(),
            $this->er(),
            $this->bb(),
            $this->so(),
            $this->_2b(),
            $this->_3b(),
            $this->hr(),
            $this->ab(),
            $this->b_avg(),
            $this->wp(),
            $this->hbp(),
            $this->bk(),
            $this->sfa(),
            $this->sha(),
        ];
    }

    //ERA = 9 × Earned Runs Allowed / Innings Pitched
    public function era()
    {
        $result = 0;
        $er = $this->er(false);
        $ip = $this->ip(false);

        if ((float)$ip > 0) {
            $result = ((9 * $er) / $ip);
        }

        return number_format($result, 2);
    }

    public function w_l()
    {
        if (!$this->season) {
            return '--';
        }

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
        return $this->appear() . '-' . $this->gs();
    }

    public function appear()
    {
        return $this->sum('pitching', 'appear');
    }

    public function gs()
    {
        return $this->sum('player', 'gs');
    }

    public function cg()
    {
        return $this->sum('pitching', 'cg');
    }

    public function sho()
    {
        return $this->sum('hitting', 'sho');
    }

    public function sv()
    {
        return $this->sum('hitting', 'save');
    }

    public function ip(bool $format = true)
    {

        if ($format === true) {
            $format = function ($value) {
                return number_format($value, 1);
            };
        }
        return $this->sum('pitching', 'ip', $format);
    }

    public function h(bool $format = true)
    {
        return $this->sum('pitching', 'h', $format);
    }

    public function r()
    {
        return $this->sum('pitching', 'r');
    }

    public function er(bool $format = true)
    {
        return $this->sum('pitching', 'er', $format);
    }

    public function bb()
    {
        return $this->sum('pitching', 'bb');
    }

    public function so()
    {
        return $this->sum('pitching', 'so');
    }

    public function _2b()
    {
        return $this->sum('pitching', 'double');
    }

    public function _3b()
    {
        return $this->sum('pitching', 'triple');
    }

    public function hr()
    {
        return $this->sum('hitting', 'hr');
    }

    public function ab(bool $format = true)
    {
        return $this->sum('hitting', 'ab', $format);
    }

    //Batting Average = Total number of hits / Total number of at bats
    public function b_avg()
    {
        $hits = $this->h(false);
        $atBats = $this->ab(false);

        return ($atBats > 0) ? number_format(($hits / $atBats), 3) : 0.000;
    }

    public function wp()
    {
        return $this->sum('pitching', 'wp');
    }

    public function hbp()
    {
        return $this->sum('pitching', 'hbp');
    }

    public function bk()
    {
        return $this->sum('pitching', 'bk');
    }

    public function sfa()
    {
        return $this->sum('pitching', 'sfa');
    }

    public function sha()
    {
        return $this->sum('pitching', 'sha');
    }
}