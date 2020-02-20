<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class special extends Transformer
{
    public function transform(array $game)
    {
        $data = [];
        $teams = [];
        foreach ($game['team'] as $team) {
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
                        isset($player['punt'])
                        && $name
                    ){
                        $data['punt'][] = [
                            'uni' => $player['uni'],
                            'name' => $name,
                            "no" => isset($player['punt']['no']) ? $player['punt']['no'] : '-',
                            "yds" => isset($player['punt']['yds']) ? $player['punt']['yds'] : '-',
                            'long' => isset($player['punt']['long']) ? $player['punt']['long'] : '-',
                            'inside20' => isset($player['punt']['inside20']) ? $player['punt']['inside20'] : '-',
                            'avg' => isset($player['punt']['avg']) ? $player['punt']['avg'] : '-',
                            'plus50' => isset($player['punt']['plus50']) ? $player['punt']['plus50'] : '-',
                            'tb' => isset($player['punt']['tb']) ? $player['punt']['tb'] : '-',
                        ];
                    }

                    if(
                    (
                        isset($player['pr'])
                        ||  isset($player['ir'])
                        ||  isset($player['rcv'])
                    )
                        && $name
                    ){
                        $data['all_returns'][] = [
                            'uni' => $player['uni'],
                            'name' => $name,

                            "pr_no" => isset($player['pr']['no']) ? $player['pr']['no'] : '-',
                            "pr_yds" => isset($player['pr']['yds']) ? $player['pr']['yds'] : '-',
                            'pr_long' => isset($player['pr']['long']) ? $player['pr']['long'] : '-',
                            'pr_tb' => isset($player['pr']['tb']) ? $player['pr']['tb'] : '-',

                            "rcv_no" => isset($player['rcv']['no']) ? $player['rcv']['no'] : '-',
                            "rcv_yds" => isset($player['rcv']['yds']) ? $player['rcv']['yds'] : '-',
                            'rcv_long' => isset($player['rcv']['long']) ? $player['rcv']['long'] : '-',
                            'rcv_tb' => isset($player['rcv']['tb']) ? $player['rcv']['tb'] : '-',

                            "ir_no" => isset($player['ir']['no']) ? $player['ir']['no'] : '-',
                            "ir_yds" => isset($player['ir']['yds']) ? $player['ir']['yds'] : '-',
                            'ir_long' => isset($player['ir']['long']) ? $player['ir']['long'] : '-',
                            'ir_tb' => isset($player['ir']['tb']) ? $player['ir']['tb'] : '-',
                        ];
                    }

                    if(
                        isset($game['fgas'])
                        && isset($game['fgas']['fga'])
                        && isset($game['fgas']['fga'][0])
                        && !empty($game['fgas']['fga'])
                        && $name
                    ){
                        if(is_array($game['fgas']['fga'][0])){
                            $fga = collect($game['fgas']['fga'])->groupBy('team')->toArray();
                            if(isset($fga[$team['id']])){
                                $fga = $fga[$team['id']];
                            }else{
                                $fga = [];
                            }
                            $data['field_goals'] =$fga;
                        } else {
                            if(isset( $game['fgas']['fga']['team']) && $game['fgas']['fga']['team'] == $team['id']){
                                $fga = $game['fgas']['fga'];
                            }else{
                                $fga = [];
                            }
                            $data['field_goals'][] = $fga;
                        }
                    }
                }
            }

            $teams[] = [
                'vh'        => $team['vh'],
                'id'        => $team['id'],
                'name'      => $team['name'],
                'special'   => $data,
            ];
        }

        return $teams;
    }
}