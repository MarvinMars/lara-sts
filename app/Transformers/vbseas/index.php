<?php

namespace App\Transformers\vbseas;
use App\Transformers\season;
use App\Transformers\Transformer;


class index extends Transformer
{
    use season;

    protected $available_categories = ['attack','set','serve','defense','block','misc'];

    public function transform(array $season)
    {
        $team = isset($season['team']['id'])? $season['team']['id'] : null;

        foreach ( $season['matches']['match'] as $game_key => $game ) {
            $this->setValues($game['gameid'], $team, $this->available_categories);
            $season['matches']['match'][$game_key]['totals'] = $this->getTotals();
            $season['highs'] = $this->getHighs();
        }

        $season['keys'] = $this->getKeys();

        return $season;
    }
}
