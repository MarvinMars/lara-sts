<?php

namespace App\Transformers;

use App\Models\Season;

class SeasonTransformer extends Transformer
{
    public function transform(Season $season)
    {
        return [
            'id'         => $season->id,
            'title'      => $season->title,
            'is_visible' => $season->is_visible,
        ];
    }
}
