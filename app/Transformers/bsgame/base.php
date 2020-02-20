<?php

namespace App\Transformers\bsgame;
use App\Transformers\Transformer;

class base extends Transformer
{
    public function transform(array $team)
    {
        $periods = [
            'score' => 0,
            'lineprd' => []
        ];

        foreach ($team['linescore']['lineinn'] as $period) {
            $periods['lineprd'][] = [
                'prd'=> $period['inn'],
                'score' =>$period['score'],
            ];

            if(isset($period['score']) && !empty($period['score'])){
                $periods['score'] +=  (int) $period['score'];
            }
        }

        return [
            'name' => $team['name'],
            'periods' => $periods,
            'stats' => [
                'ab' => isset($team['totals']['hitting']['ab']) ? $team['totals']['hitting']['ab'] : 0,
                'r' => isset($team['totals']['hitting']['r']) ? $team['totals']['hitting']['r'] : 0,
                'h' => isset($team['totals']['hitting']['h']) ? $team['totals']['hitting']['h'] : 0,
                'rbi' => isset($team['totals']['hitting']['rbi']) ? $team['totals']['hitting']['rbi'] : 0,
                'bb' => isset($team['totals']['hitting']['bb']) ? $team['totals']['hitting']['bb'] : 0,
                'so' => isset($team['totals']['hitting']['so']) ? $team['totals']['hitting']['so'] : 0,
                'lob' => isset($team['linescore']['lob']) ? $team['linescore']['lob'] : 0,
            ]
        ];
    }
}
