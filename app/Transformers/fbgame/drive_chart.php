<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class drive_chart extends Transformer
{
    public function transform(array $game)
    {
        $data = [];
        $teams = [];
        if(isset($game['team'])) {

            foreach ($game['team'] as $team){
                $teams[] = $team['id'];
            }

            if( isset( $game['drives'] ) ){

                foreach ( $game['drives']['drive'] as $drive){
                    $data['all'][] = $drive;
                    if(isset($drive['team'])){
                        $data[$drive['team']][] = $drive;
                    }
                }
            }
        }

        return [
            'teams' => $teams,
            'stats' => $data
        ];
    }
}