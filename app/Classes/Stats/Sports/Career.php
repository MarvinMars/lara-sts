<?php

namespace App\Classes\Stats\Sports;

use App\Classes\Stats\Sports\Career\Baseball\Pitching;
use App\Classes\Stats\Sports\Career\Soccer\SoccerStats;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return array
     */
    public function goalkeepingStatsValues()
    {
        $careerStats = new SoccerStats($this->getCollection(), $this->player);

        return [
            number_format($careerStats->gp()),
            number_format($careerStats->min()),
            number_format($careerStats->ga()),
            number_format($careerStats->gaAvg()),
            number_format($careerStats->sv()),
            number_format($careerStats->svPercent(), 3),
            number_format($careerStats->sho()),
            number_format($careerStats->sf()),
        ];
    }

    public function soccerScoringStatsValues()
    {
        $careerStats = new SoccerStats($this->getCollection(), $this->player);

        return [
            number_format($careerStats->gp()),
            number_format($careerStats->gs()),
            number_format($careerStats->g()),
            number_format($careerStats->a()),
            number_format($careerStats->pts()),
            number_format($careerStats->sh()),
            number_format($careerStats->shPercent(), 3),
            number_format($careerStats->sog()),
            number_format($careerStats->sogPercent(), 3),
            number_format($careerStats->gw()),
            number_format($careerStats->pkAtt()),
            number_format($careerStats->min()),
        ];
    }

    /**
     * @return array
     */
    public function baseballPitchingValues()
    {
        $model = new Pitching($this->getCollection(), $this->player);

        return [
            number_format($model->era(), 2),
            $model->w_l(),
            $model->app_gs(),
            number_format($model->cg()),
            number_format($model->sho()),
            number_format($model->sv()),
            number_format($model->ip(), 1),
            number_format($model->h()),
            number_format($model->r()),
            number_format($model->er()),
            number_format($model->bb()),
            number_format($model->so()),
            number_format($model->_2b()),
            number_format($model->_3b()),
            number_format($model->hr()),
            number_format($model->ab()),
            number_format($model->b_avg(), 3),
            number_format($model->wp()),
            number_format($model->hbp()),
            number_format($model->bk()),
            number_format($model->sfa()),
            number_format($model->sha()),
        ];
    }

    /**
     * @return Collection
     */
    protected function getCollection()
    {
        return $this->getOriginalQuery()->get();
    }

    /**
     * Return original query
     *
     * @return mixed
     */
    public function getOriginalQuery()
    {
        $query = PlayerValue::wherePlayerId($this->player->id);

        if ($this->season instanceof Season) {
            $query = $query->whereHas('game', function ($query) {
                $query->whereHas('seasons', function ($query) {
                    $query->where('id', '=', $this->season->id);
                });
            });
        }

        return clone $query;
    }


}
