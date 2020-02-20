<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class participation extends Transformer
{
    public function transform(array $team)
    {
        $data = [];
        if (isset($team['player'])){
            foreach ($team['player'] as $player) {
                if ($player['uni'] == 'TM') {
                    continue;
                }

                if( isset($player['name']) ){
                    $name = $player['name'];
                } elseif ( isset($player['checkname']) ) {
                    $name = $player['checkname'];
                } elseif ( isset($player['shortname']) ) {
                    $name = $player['shortname'];
                } else {
                    $name = ' ';
                }

                $data[] = [
                    'uni' => $player['uni'],
                    'name' => $name
                ];

            }
        }
        $team['participation'] = $data;
        unset($data);
        return $team;
    }
}