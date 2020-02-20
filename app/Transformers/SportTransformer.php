<?php

namespace App\Transformers;

use App\Models\Sport;

class SportTransformer extends Transformer
{
    public function transform(Sport $season)
    {
        return [
            'id'         => $season->id,
            'title'      => $season->title,
            'is_visible' => $season->is_visible,
        ];
    }
}
