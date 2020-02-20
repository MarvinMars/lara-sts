<?php
namespace App\Transformers\sogame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class stats extends Transformer
{
    public function transform(array $team)
    {
        $data = [];
        if(isset($team['player'])){
            foreach ($team['player'] as $player) {
                if  ($player['uni'] == 'TM'){
                    continue;
                }
               $data[] = [
                   'pos' => isset($player['pos']) ? $player['pos'] : '',
                   'uni' => isset($player['uni']) ? $player['uni'] : '',
                   'name' => isset($player['name']) ? $player['name'] : '',
                   'sh' => isset($player['shots']['sh']) ? $player['shots']['sh'] : 0,
                   'sog' => isset($player['shots']['sog']) ? $player['shots']['sog'] : 0,
                   'g' => isset($player['shots']['g']) ? $player['shots']['g'] : 0,
                   'a' => isset($player['shots']['g']) ? $player['shots']['a'] : 0,
               ];
            }
        }

        return [
            'name' => isset($team['name'])? $team['name'] : '',
            'rank' => isset($team['rank'])? $team['rank'] : '',
            'stats' => $data,
            'total' =>  [
                'sh' => isset($team['totals']['shots']['sh']) ? $team['totals']['shots']['sh'] : 0,
                'sog' => isset($team['totals']['shots']['sog']) ? $team['totals']['shots']['sog'] : 0,
                'g' => isset($team['totals']['shots']['g']) ? $team['totals']['shots']['g'] : 0,
                'a' => isset($team['totals']['shots']['g']) ? $team['totals']['shots']['a'] : 0,
            ]
        ];
    }
}
