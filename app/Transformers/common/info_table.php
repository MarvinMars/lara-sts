<?php

namespace App\Transformers\common;
use App\Transformers\Transformer;

class info_table extends Transformer
{

    public function transform(array $venue)
    {
        return [
            'time'      => isset($venue['start']) ? $venue['start'] : '',
            'attend'    => isset($venue['attend']) ? $venue['attend'] : '',
            'site'      => isset($venue['site']) ? $venue['site'] : '',
            'arena'     => isset($venue['arena']) ? $venue['arena'] : '',
            'visid'     => isset($venue['visid']) ? $venue['visid'] : '',
            'homeid'    => isset($venue['homeid']) ? $venue['homeid'] : '',
            'referees'  => isset($venue['officials']['official']) ? $venue['officials']['official'] : '',
        ];
    }
}
