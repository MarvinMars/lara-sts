<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class defensive extends Transformer
{
    public function transform(array $team)
    {
        $data = [];
        if (isset($team['player'])){
            foreach ($team['player'] as $player) {
                if  ($player['uni'] == 'TM'){
                    continue;
                }

                if( isset($player['name']) ){
                    $name = $player['name'];
                } elseif ( isset($player['checkname']) ) {
                    $name = $player['checkname'];
                } elseif ( isset($player['shortname']) ) {
                    $name = $player['shortname'];
                } else {
                    $name = ' ';
                }

                if(
                    isset($player['defense'])
                    && $name
                ){
                    $data[] = [
                        'uni' => $player['uni'],
                        'name' => $name,
                        "tackua" => isset($player['defense']['tackua']) ? $player['defense']['tackua'] : '-',
                        "tacka" => isset($player['defense']['tacka']) ? $player['defense']['tacka'] : '-',
                        'tot_tack' => isset($player['defense']['tot_tack']) ? $player['defense']['tot_tack'] : '-',

                        'tfl_yds' => (isset($player['defense']['tfla']) ? $player['defense']['tfla'] : '-')
                                    .'/'.
                                    (isset($player['defense']['tflyds'])? $player['defense']['tflyds'] : '-') ,

                        'sackyds' => (isset($player['defense']['sacka'])? $player['defense']['sacka'] : '-')
                                    .'/'.
                                    (isset($player['defense']['sackyds'])? $player['defense']['sackyds'] : '-') ,

                        'qbh' => isset($player['defense']['qbh']) ? $player['defense']['qbh'] : '-',
                        'brup' => isset($player['defense']['brup']) ? $player['defense']['brup'] : '-',
                        'int' => isset($player['defense']['int']) ? $player['defense']['int'] : '-',
                        'intyds' => isset($player['defense']['intyds']) ? $player['defense']['intyds'] : '-',
                    ];
                }
            }
        }

        $team = [
            'vh'        => $team['vh'],
            'id'        => $team['id'],
            'rank'      => isset($team['rank']) ? $team['rank'] : '',
            'name'      => $team['name'],
            'defensive'   => $data,
        ];
        unset($data);
        return $team;
    }
}