<?php

namespace App\Transformers\hkgame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class penalty_summary extends Transformer
{
    public function transform(array $pens)
    {
        if(isset($pens['pen'])){
            return $pens['pen'];
        }else{
            return [];
        }
    }
}
