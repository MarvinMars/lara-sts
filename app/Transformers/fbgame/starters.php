<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class starters extends Transformer
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
                if(
                isset($player['opos'])) {
                    $data['offensive'][] = [
                        'uni' => isset($player['uni'])?$player['uni']:'',
                        'name' => $name,
                        'pos' => $player['opos']
                    ];
                }

                if(isset($player['dpos'])){
                    $data['defensive'][] = [
                        'uni' => isset($player['uni'])?$player['uni']:'',
                        'name' => $name,
                        'pos' => $player['dpos']
                    ];
                }

            }
        }
        $team['starters'] = $data;
        unset($data);
        return $team;
    }
}