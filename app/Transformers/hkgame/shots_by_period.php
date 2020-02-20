<?php
namespace App\Transformers\hkgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class shots_by_period extends Transformer
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


                $facewon = isset($player['misc']['facewon'])? $player['misc']['facewon'] : 0;
                $facelost = isset($player['misc']['facelost'])? $player['misc']['facelost'] : 0;

                if( $facewon || $facelost ) {
                    $fo = $facewon.'-'.($facelost + $facewon);
                }else{
                    $fo = '-';
                }

                $count = isset($player['penalty']['count'])? $player['penalty']['count'] : 0;
                $minor = isset($player['penalty']['minor'])? $player['penalty']['minor'] : 0;

                if( $count || $minor ) {
                    $pen = $count.'-'.($count + $minor);
                }else{
                    $pen = '-';
                }

                unset($facewon,$facelost,$count,$minor);

                if( isset($player['shots']) && $name) {
                    $data[] = [
                        'uni' => $player['uni'],
                        'name' => $name,
                        'pos' => isset($player['pos'])? $player['pos'] : '',
                        'g' => isset($player['shots']['g']) ? $player['shots']['g'] : 0,
                        'a' => isset($player['shots']['a']) ? $player['shots']['a'] : 0,
                        'shotbyprd' => !empty($player['shots']['shotbyprd']) ? explode(',' , $player['shots']['shotbyprd'] ) : [],
                        'total' => isset($player['shots']['sh']) ? $player['shots']['sh'] : 0,
                        'plusminus' => isset($player['misc']['plusminus']) ? $player['misc']['plusminus'] : 0,
                        'fo' => $fo,
                        'pen' => $pen,
                    ];
                }
            }
        }

        unset($fo,$pen);

        $total = [];

        if( isset($team['totals'])) {
            $facewon = isset($team['totals']['misc']['facewon'])? $team['totals']['misc']['facewon'] : 0;
            $facelost = isset($team['totals']['misc']['facelost'])? $team['totals']['misc']['facelost'] : 0;

            if( $facewon || $facelost ) {
                $fo = $facewon.'-'.($facelost + $facewon);
            }else{
                $fo = '-';
            }

            $count = isset($team['totals']['penalty']['count'])? $team['totals']['penalty']['count'] : 0;
            $minor = isset($team['totals']['penalty']['minor'])? $team['totals']['penalty']['minor'] : 0;

            if( $count || $minor ) {
                $pen = $count.'-'.($count + $minor);
            }else{
                $pen = '-';
            }

            unset($facewon,$facelost,$count,$minor);

            $total = [
                'g' => isset($team['totals']['shots']['g']) ? $team['totals']['shots']['g'] : 0,
                'a' => isset($team['totals']['shots']['a']) ? $team['totals']['shots']['a'] : 0,
                'shotbyprd' => !empty($team['totals']['shots']['shotbyprd']) ? explode(',' , $team['totals']['shots']['shotbyprd'] ) : [],
                'total' => isset($team['totals']['shots']['sh']) ? $team['totals']['shots']['sh'] : 0,
                'plusminus' => isset($team['totals']['misc']['plusminus']) ? $team['totals']['misc']['plusminus'] : 0,
                'fo' => $fo,
                'pen' => $pen,
            ];
        }


        $team = [
            'rank'      => isset($team['rank']) ? $team['rank'] : '',
            'vh'        => $team['vh'],
            'id'        => $team['id'],
            'name'      => $team['name'],
            'shots_by_period'   => $data,
            'total'     => $total,
        ];

        return $team;
    }
}
