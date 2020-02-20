<?php

namespace App\Transformers\hkgame;
use App\Transformers\Transformer;

class play_by_play_table extends Transformer
{
    public function transform(array $game)
    {
        $teams = [];
        if(isset($game['team'])) {

          foreach ($game['team'] as $team){
              $teams[] = $team['id'];
          }

          if( isset( $game['plays'] ) ){

            foreach ( $game['plays']['period'] as  $key_per => $per){

                if( isset( $per['play'] ) ){

                    foreach ( $per['play'] as $key_play => $play) {

                        foreach ( $teams as $team ) {

                            if( isset( $play['text'] ) ) {


                                if ( strstr($play['text'], ' '.$team.' ' ) || stristr($play['text'], $team.'.' )) {
                                    $play['team'] = $team;

                                    if ( strstr($play['text'], 'GOAL' )) {
                                        $play['goal'] = $team;
                                    }
                                }

                                $per['play'][$key_play] = $play;
                            }
                        }
                    }
                }

                $game['plays']['period'][$key_per] = $per;
            }
          }
          $game['plays']['teams'] = $teams;
        }

        return $game['plays'];
    }
}
