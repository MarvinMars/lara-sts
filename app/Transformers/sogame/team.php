<?php

namespace App\Transformers\sogame;
use App\Transformers\Transformer;
use App\Transformers\common\player;

class team extends Transformer
{
    public function transform(array $teams)
    {
       $data = [];

        foreach ($teams as $team) {
            $shots = 0;
            $saves = 0;
            $corners = 0;
            $fouls = 0;

            foreach ($team['linescore']['lineprd'] as $period) {
                if (isset($period['shots']) && !empty($period['shots'])) {
                    $data['shots'][$team['id']][$period['prd']] = $period['shots'];
                    $shots += $period['shots'];
                }else {
                    $data['shots'][$team['id']][$period['prd']] = 0;
                }

                if (isset($period['saves']) && !empty($period['saves'])) {
                    $data['saves'][$team['id']][$period['prd']] = $period['saves'];
                    $saves += $period['saves'];
                }else {
                    $data['saves'][$team['id']][$period['prd']] = 0;
                }

                if (isset($period['corners']) && !empty($period['corners'])) {
                    $data['corners'][$team['id']][$period['prd']] = $period['corners'];
                    $corners += $period['corners'];
                }else {
                    $data['corners'][$team['id']][$period['prd']] = 0;
                }

                if (isset($period['fouls']) && !empty($period['fouls'])) {
                    $data['fouls'][$team['id']][$period['prd']] = $period['fouls'];
                    $fouls += $period['fouls'];
                }else {
                    $data['fouls'][$team['id']][$period['prd']] = 0;
                }
            }
            $data['shots'][$team['id']]['total'] = $shots;
            $data['saves'][$team['id']]['total'] = $saves;
            $data['corners'][$team['id']]['total'] = $corners;
            $data['fouls'][$team['id']]['total'] = $fouls;
        }

        return [
            'periods' => count($teams[0]['linescore']['lineprd']),
            'stats' => $data
        ];
    }
}
