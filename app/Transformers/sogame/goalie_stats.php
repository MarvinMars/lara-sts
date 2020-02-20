<?php

namespace App\Transformers\sogame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class goalie_stats extends Transformer
{
    public function transform(array $team)
    {
        $data = [];

        if(isset($team['player'])){
            foreach ($team['player'] as $player) {
                if  ($player['uni'] == 'TM' || !isset($player['pos']) || $player['pos'] != 'gk'){
                    continue;
                }
                $data[] = [
                    'pos' => isset($player['pos']) ? $player['pos'] : '',
                    'uni' => isset($player['uni']) ? $player['uni'] : '',
                    'name' => isset($player['name']) ? $player['name'] : '',
                    'minutes' => isset($player['goalie']['minutes']) ? $player['goalie']['minutes'] : 0,
                    'ga' => isset($player['goalie']['ga']) ? $player['goalie']['ga'] : 0,
                    'saves' => isset($player['goalie']['saves']) ? $player['goalie']['saves'] : 0,
                ];
            }
        }

        return [
            'name' => isset($team['name'])? $team['name'] : '',
            'rank' => isset($team['rank'])? $team['rank'] : '',
            'stats' => $data,
            'total' =>  [
                'minutes' => isset($team['totals']['goalie']['minutes']) ? $team['totals']['goalie']['minutes'] : 0,
                'ga' => isset($team['totals']['goalie']['ga']) ? $team['totals']['goalie']['ga'] : 0,
                'saves' => isset($team['totals']['goalie']['saves']) ? $team['totals']['goalie']['saves'] : 0,
            ]
        ];
    }
}
