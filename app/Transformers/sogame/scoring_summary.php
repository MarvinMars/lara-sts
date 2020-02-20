<?php

namespace App\Transformers\sogame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class scoring_summary extends Transformer
{
    public function transform(array $scores)
    {
        if(isset($scores['score'])){
            $new_scores = [];
            if(is_array(collect($scores['score'])->first())){
                foreach ( $scores['score'] as $score) {
                    $new_scores[] = $score;
                }
            } else {
                $new_scores[] = $scores['score'];
            }
            $scores['score'] = $new_scores ;
        }

        return $scores;
    }
}
