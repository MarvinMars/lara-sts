<?php

namespace App\Transformers\hkgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class scoring_summary extends Transformer
{
    public function transform(array $scores)
    {
        if(isset($scores['score'])){
            $teams = [];
            $new_scores = [];

            foreach ( $scores['score'] as $score) {
                if( isset( $score['vh'] ) && isset( $score['id'] )) {
                    $teams[$score['vh']] = $score['id'];
                }
                $new_scores[] = $score;
            }

            $teams = collect($teams)->unique();
            $scores['score'] = $new_scores ;
            $scores['teams'] = $teams ;
        }

        return $scores;
    }
}
