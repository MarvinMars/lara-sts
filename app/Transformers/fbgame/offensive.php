<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class offensive extends Transformer
{
    public function transform(array $team)
    {
//        Passing - pass
//        Rushing - rush
//        Receiving - rcv

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

                if(
                    isset($player['pass'])
                    && $name
                ){
                    $data['passing']['players'][] = [
                        'uni' => $player['uni'],
                        'name' => $name,
                        'comp' => isset($player['pass']['comp'])? $player['pass']['comp']:0,
                        'att' => isset($player['pass']['att'])? $player['pass']['att']:0,
                        'int' => isset($player['pass']['int'])? $player['pass']['int']:0,
                        'yds' => isset($player['pass']['yds'])? $player['pass']['yds']:0,
                        'td' => isset($player['pass']['td'])? $player['pass']['td']:0,
                        'long' => isset($player['pass']['long'])? $player['pass']['long']:0,
                        'sacks' => isset($player['pass']['sacks'])? $player['pass']['sacks']:0,
                    ];
                }

                if(
                    isset($player['rush'])
                    && $name
                ){
                    $data['rushing']['players'][] = [
                        'uni' => $player['uni'],
                        'name' => $name,
                        'att' => isset($player['rush']['att'])? $player['rush']['att']:0,
                        'gain' => isset($player['rush']['gain'])? $player['rush']['gain']:0,
                        'yds' => isset($player['rush']['yds'])? $player['rush']['yds']:0,
                        'td' => isset($player['rush']['td'])? $player['rush']['td']:0,
                        'long' => isset($player['rush']['long'])? $player['rush']['long']:0,
                        'loss' => isset($player['rush']['loss'])? $player['rush']['loss']:0,
                    ];
                }

                if(
                    isset($player['rcv'])
                    && $name
                ){
                    $data['receiving']['players'][] = [
                        'uni' => $player['uni'],
                        'name' => $name,
                        'no' => isset($player['rcv']['no'])? $player['rcv']['no']:0,
                        'yds' => isset($player['rcv']['yds'])? $player['rcv']['yds']:0,
                        'td' => isset($player['rcv']['td'])? $player['rcv']['td']:0,
                        'long' => isset($player['rcv']['long'])? $player['rcv']['long']:0,
                    ];
                }
            }

            $data['passing']['total'] = isset($team['totals']['pass']) ? $team['totals']['pass']: [];
            $data['rushing']['total'] = isset($team['totals']['rush']) ? $team['totals']['rush']: [];
            $data['receiving']['total'] = isset($team['totals']['rcv']) ? $team['totals']['rcv']: [];
        }

        $team = [
            'vh'        => $team['vh'],
            'id'        => $team['id'],
            'name'      => $team['name'],
            'rank'      => isset($team['rank']) ? $team['rank'] : '',
            'offensive'   => $data,
        ];

        return $team;
    }
}