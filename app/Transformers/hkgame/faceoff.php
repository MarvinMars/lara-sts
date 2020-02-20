<?php
namespace App\Transformers\hkgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class faceoff extends Transformer
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

                if(
                    isset($player['misc'])
                    && $name
                    && isset($player['misc']['facewon'])
                    && isset($player['misc']['facelost'])
                    && (!empty($player['misc']['facewon']) || !empty($player['misc']['facelost']))
                ){
                    $data[] = [
                        'uni' => $player['uni'],
                        'name' => $name,
                        "facewon" => $player['misc']['facewon'],
                        "facelost" => $player['misc']['facelost'],
                    ];
                }
            }
        }

        $team = [
            'vh'        => $team['vh'],
            'id'        => $team['id'],
            'name'      => $team['name'],
            'faceoff'   => $data,
            'total'     => isset($team['totals']['misc']) ? $team['totals']['misc']: [],
        ];

        return $team;
    }
}