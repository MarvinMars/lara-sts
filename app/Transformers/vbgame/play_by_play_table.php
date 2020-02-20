<?php

namespace App\Transformers\vbgame;
use App\Transformers\Transformer;

class play_by_play_table extends Transformer
{
    public function transform(array $game)
    {
        $teams = [];
        if(isset($game['team'])) {

            foreach ($game['team'] as $team){
                $teams[$team['vh']] = $team['id'];
            }


            if( isset( $game['plays'] ) ){

                foreach ( $game['plays']['game'] as  $key_per => $per){

                    if( isset( $per['play'] ) ){

                        foreach ( $per['play'] as $key_play => $play) {

                            foreach ( $teams as $team ) {

                                if( isset( $play['text'] ) ) {

                                    if ( strstr($play['text'], $team.' ' )) {
                                        $play['team'] = $team;
                                    }elseif(isset($play['point'])){
                                        $play['team'] = $play['point'];
                                    }else{
                                        $play['team'] = '';
                                    }

                                }

                                $per['play'][$key_play] = $play;
                            }
                        }
                    }

                    $game['plays']['game'][$key_per] = $per;
                }
            }
            $game['plays']['teams'] = $teams;
        }
        return $game['plays'];
    }
}
