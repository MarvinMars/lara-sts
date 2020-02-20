<?php

namespace App\Classes\Stats\Sports\Basketball;

use App\Classes\Stats\Sports\Career\Basketball\Summary;
use App\Classes\Stats\Sports\SportClass;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Season;

/**
 * Class Career
 * @package App\Classes\Stats\Sports
 */
class Career extends SportClass
{
    /**
     * Career constructor.
     * @param Player $player
     * @param Season $season
     */
    public function __construct(Player $player, Season $season = null)
    {
        parent::__construct($player, null, $season);
    }

    public function summary()
    {
        $model = new Summary($this->_getQuery(), $this->player);

        return [
            number_format($model->gp()),
            $model->min(),
            $model->totalFgm(),
            $model->totalFga(),
            number_format($model->totalPct(), 1) . '%',
            $model->tpFgm(),
            $model->tpFga(),
            number_format($model->tpPct(), 1) . '%',
            $model->ftFtm(),
            $model->ftFta(),
            number_format($model->ftPct(), 1) . '%',
            $model->rebOff(),
            $model->rebDef(),
            $model->rebTot(),
            $model->pf(),
            $model->ast(),
            $model->to(),
            $model->blk(),
            $model->stl(),
            $model->pts(),
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function _getQuery()
    {
        return PlayerValue::remember(10)->wherePlayerId($this->player->id)
            ->whereHas('game', function ($query) {
                $query->whereHas('seasons', function ($query) {
                    $query->where('id', '=', $this->season->id);
                });
            })->get();
    }


}
