<?php
namespace App\Transformers\fbgame;

use App\Transformers\Transformer;
use App\Transformers\common\player;

class team extends Transformer
{
    public function transform(array $game)
    {
        $data = [];
        $teams = [];

        foreach ($game['team'] as $team) {

            $teams[] = [
                'vh'        => $team['vh'],
                'id'        => $team['id'],
                'name'      => $team['name'],
            ];
            if(isset($team['totals']['firstdowns'])){
                $item = $team['totals']['firstdowns'];
                $data['firstdowns'][$team['id']] = [
                    'no' => isset($item['no']) ?$item['no'] : '-',
                    'rush' => isset($item['rush']) ?$item['rush'] : '-',
                    'pass' => isset($item['pass']) ?$item['pass'] : '-',
                    'penalty' => isset($item['penalty']) ?$item['penalty'] : '-',
                ];
                $data['firstdowns']['keys'] = collect($data['firstdowns'][$team['id']])->keys()->toArray();
                unset($item);
            }
            if(isset($team['totals']['rush'])){
                $item = $team['totals']['rush'];
                $data['rush'][$team['id']] = [
                    'yds' => isset($item['yds']) ?$item['yds'] : '-',
                    'att' => isset($item['att']) ?$item['att'] : '-',
                    'loss' => isset($item['loss']) ?$item['loss'] : '-',
                    'td' => isset($item['td']) ?$item['td'] : '-',
                    'long' => isset($item['long']) ?$item['long'] : '-',
                ];
                $data['rush']['keys'] = collect($data['rush'][$team['id']])->keys()->toArray();
                unset($item);
            }
            if(isset($team['totals']['pass'])){
                $item = $team['totals']['pass'];
                $data['pass'][$team['id']] = [
                    'yds' => isset($item['yds']) ? $item['yds'] : '-',
                    'att' => isset($item['att']) ?$item['att'] : '-',
                    'loss' => isset($item['loss']) ?$item['loss'] : '-',
                    'td' => isset($item['td']) ?$item['td'] : '-',
                    'long' => isset($item['long']) ?$item['long'] : '-',
                ];
                $data['pass']['keys'] = collect($data['pass'][$team['id']])->keys()->toArray();
                unset($item);
            }
            if( isset($team['totals']['fumbles']) || isset($team['totals']['penalties'])){
                $data['total_offense'][$team['id']] = [
                    'totoff_plays' => isset($team['totoff_plays']) ?$team['totoff_plays'] : '-',
                    'totoff_yards' => isset($team['totoff_yards']) ?$team['totoff_yards'] : '-',
                    'totoff_avg' => isset($team['totoff_avg']) ?$team['totoff_avg'] : '-',
                    'pen_yds' => isset($team['totals']['penalties']['yds']) ? $team['totals']['penalties']['yds'] : '-',
                    'fumbles_lost' => isset($team['totals']['fumbles']['lost']) ? $team['totals']['fumbles']['lost'] : '-',
                ];
                $data['total_offense']['keys'] = collect($data['total_offense'][$team['id']])->keys()->toArray();
            }
            if( isset($team['totals']['punt']) ){
                $item = $team['totals']['punt'];
                $data['punt'][$team['id']] = [
                    'no' => isset($item['no']) ?$item['no'] : '-',
                    'yds' => isset($item['yds']) ?$item['yds'] : '-',
                    'long' => isset($item['long']) ?$item['long'] : '-',
                    'blkd' => isset($item['blkd']) ?$item['blkd'] : '-',
                    'tb' => isset($item['tb']) ?$item['tb'] : '-',
                    'fc' => isset($item['fc']) ?$item['fc'] : '-',
                    'plus50' => isset($item['plus50']) ?$item['plus50'] : '-',
                    'inside20' => isset($item['inside20']) ?$item['inside20'] : '-',
                    'avg' => isset($item['avg']) ?$item['avg'] : '-',
                ];
                $data['punt']['keys'] = collect($data['punt'][$team['id']])->keys()->toArray();
                unset($item);
            }
            if( isset($team['totals']['ko']) ){
                $item = $team['totals']['ko'];
                $data['ko'][$team['id']] = [
                    'no' => isset($item['no']) ?$item['no'] : '-',
                    'yds' => isset($item['yds']) ?$item['yds'] : '-',
                    'ob' => isset($item['ob']) ?$item['ob'] : '-',
                    'tb' => isset($item['tb']) ?$item['tb'] : '-',
                    'fcyds' => isset($item['fcyds']) ?$item['fcyds'] : '-',
                ];
                $data['ko']['keys'] = collect($data['ko'][$team['id']])->keys()->toArray();
                unset($item);
            }
            if( isset($team['totals']['misc']) ){
                $item = $team['totals']['misc'];
                $data['misc'][$team['id']] = [
                    'top' => isset($item['top']) ?$item['top'] : '-',
                    'yds' => isset($item['yds']) ?$item['yds'] : '-',
                    'ona' => isset($item['ona']) ?$item['ona'] : '-',
                    'onm' => isset($item['onm']) ?$item['onm'] : '-',
                    'ptsto' => isset($item['ptsto']) ?$item['ptsto'] : '-',
                ];
                $data['misc']['keys'] = collect($data['misc'][$team['id']])->keys()->toArray();
                unset($item);
            }
        }

        return [
            'teams' => $teams,
            'stats' => $data
        ];
    }
}