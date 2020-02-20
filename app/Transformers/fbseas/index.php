<?php

namespace App\Transformers\fbseas;

use App\Transformers\season;
use App\Transformers\Transformer;

class index extends Transformer
{

    use season;

    protected $available_categories = ['shots','penalty','misc','goalie'];

    public function transform(array $season)
    {
        $team = isset($season['team']['id'])? $season['team']['id'] : null;
        foreach ( $season['games']['game'] as $game_key => $game ) {
            $this->setValues($game['gameid'], $team, $this->available_categories);
            $season['games']['game'][$game_key]['totals'] = $this->getTotals();
            $season['highs'] = $this->getHighs();
        }

        $season['keys'] = $this->getKeys();

        return $season;
    }
}
