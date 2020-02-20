<?php
namespace App\Transformers\hkgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class goalkeeping extends Transformer
{
    public function transform(array $team)
    {
        $data = [];
        if (isset($team['player'])){
            foreach ($team['player'] as $player) {
                if  ($player['uni'] == 'TM'){
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

                if( isset($player['goalie']) && $name) {
                    $data[] = [
                        'uni' => $player['uni'],
                        'name' => $name,
//                        'dec' => $name,
                        'minutes' => isset($player['goalie']['minutes']) ? $player['goalie']['ga'] : '',
                        'ga' => isset($player['goalie']['ga']) ? $player['goalie']['ga'] : '',
                        'eng' => isset($player['goalie']['eng']) ? $player['goalie']['eng'] : '',
                        'savebyprd' => !empty($player['goalie']['savebyprd']) ? explode(',' , $player['goalie']['savebyprd'] ) : [],
                        'total' => isset($player['goalie']['saves']) ? $player['goalie']['saves'] : '',
                    ];
                }
            }
        }

        $total = [];

        if( isset($team['totals']['goalie'])) {
            $total = [
                'ga' => isset($team['totals']['goalie']['ga']) ? $team['totals']['goalie']['ga'] : '',
                'eng' => isset($team['totals']['goalie']['eng']) ? $team['totals']['goalie']['eng'] : '',
                'savebyprd' => !empty($team['totals']['goalie']['savebyprd']) ? explode(',', $team['totals']['goalie']['savebyprd']) : [],
                'total' => isset($team['totals']['goalie']['saves']) ? $team['totals']['goalie']['saves'] : '',
            ];
        }

        $team = [
            'vh'        => $team['vh'],
            'id'        => $team['id'],
            'name'      => $team['name'],
            'goalkeeping'   => $data,
            'total'     => $total,
        ];

        return $team;
    }
}