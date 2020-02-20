<?php

namespace App\Transformers\bbgame;
use App\Transformers\Transformer;

class base extends Transformer
{
    public function transform(array $team)
    {
        $fgpct = isset($team['totals']['stats']['fgpct'])? $team['totals']['stats']['fgpct']/100 : 0;
        $fg3pct = isset($team['totals']['stats']['fgpct'])? $team['totals']['stats']['fg3pct']/100 : 0;
        $ftpct = isset($team['totals']['stats']['fgpct'])? $team['totals']['stats']['ftpct']/100 : 0;

        return  [
            'name'                      => $team['name'],
            'periods'                   => $team['linescore'],
            'stats' => [
                'fgpct'                => round( $fgpct, 3,PHP_ROUND_HALF_EVEN),
                'fg3pct'               => round( $fg3pct, 3,PHP_ROUND_HALF_EVEN),
                'ftpct'                => round( $ftpct, 3,PHP_ROUND_HALF_EVEN),
                'treb'                 => isset($team['totals']['stats']['treb'])? $team['totals']['stats']['treb'] : 0,
                'to'                   => isset($team['totals']['stats']['to'])? $team['totals']['stats']['to'] : 0,
                'stl'                  => isset($team['totals']['stats']['stl'])? $team['totals']['stats']['stl'] : 0,
            ]
        ];
    }
}
