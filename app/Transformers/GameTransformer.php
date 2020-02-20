<?php

namespace App\Transformers;

use App\Models\Game;

class GameTransformer extends Transformer
{
    public function transform(Game $game)
    {
        return [
            'id'          => $game->id,
            'title'       => $game->title,
            'oppcode'     => $game->oppcode,
            'oppid'       => $game->oppid,
            'oppname'     => $game->oppname,
            'site'        => $game->site,
            'stadium'     => $game->stadium,
            'quarters'    => $game->quarters,
            'ownscore'    => $game->ownscore,
            'oppscore'    => $game->oppscore,
            'attend'      => $game->attend,
            'leaguegame'  => $game->leaguegame,
            'neutralgame' => $game->neutralgame,
            'nitegame'    => $game->nitegame,
            'postseason'  => $game->postseason,
            'homeaway'    => $game->homeaway,
            'is_visible'  => $game->is_visible,
            'number'      => $game->number,
        ];
    }
}
