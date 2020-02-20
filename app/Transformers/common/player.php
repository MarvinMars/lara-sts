<?php

namespace App\Transformers\common;
use App\Transformers\Transformer;
use Illuminate\Support\Arr;

class player extends Transformer
{
    public function transform(array $player)
    {
        if( isset($player['name']) ){
            $name = $player['name'];
        } elseif ( isset($player['checkname']) ) {
            $name = $player['checkname'];
        } elseif ( isset($player['shortname']) ) {
            $name = $player['shortname'];
        } else {
            $name = ' ';
        }

        $player['name'] = $name;

        return $player;
    }
}
