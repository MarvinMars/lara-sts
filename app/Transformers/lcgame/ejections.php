<?php

namespace App\Transformers\lcgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class ejections extends Transformer
{
    public function transform(array $penalties)
    {
        if( isset($penalties['pen']) ){
            $new_pens = [];
            if( is_array( collect($penalties['pen'] )->first()) ){
                foreach ( $penalties['pen'] as $pen) {
                    $new_pens[] = $pen;
                }
            }else {
                $new_pens[] = $penalties['pen'];
            }
            $penalties['pen'] = $new_pens ;
        }

        return $penalties;
    }
}
