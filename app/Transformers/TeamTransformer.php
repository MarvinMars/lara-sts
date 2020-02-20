<?php

namespace App\Transformers;

use App\Models\Team;

class TeamTransformer extends Transformer
{
    public function transform(Team $model)
    {
        return [
            'id'        => $model->id,
            'title'     => $model->title,
            'code'      => $model->code,
            'shortcode' => $model->shortcode,
        ];
    }
}
