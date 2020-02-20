<?php

namespace App;

use App\Models\Sport;
use App\Models\SportBlock;
use Illuminate\Database\Seeder;

class SportBlocksSeeder extends Seeder
{
    public static $availableBlocksByTypes = [
        Sport::TYPE_FOOTBALL => [
            'highs',
            'defensive',
            'career_highs',
            'offensive',
            'career_rushing',
            'career_scoring',
            'career_total_offensive',
            'career_passing',
            'career_defensive',
            'career_all_purpose',
            'career_receiving',
            'offensive_passing_group',
            'offensive_rushing_group',
            'offensive_receiving_group',
            'career_interceptions',
            'career_sacks_stats',
        ],
        Sport::TYPE_SOCCER => [
            'highs',
            'game_by_game',
            'game_by_game_goalkeeping',
            'season_goalkeeping_highs',
            'career_goalkeeping_stats',
            'career_scoring_stats',
        ],
        Sport::TYPE_BASEBALL => [
            'highs',
            'hitting',
            'fielding',
            'pitching',
        ],
        Sport::TYPE_SOFTBALL => [
            'highs',
            'hitting',
            'fielding',
            'pitching',
        ],
        Sport::TYPE_BASKETBALL => [
            'highs',
            'game_by_game',
            'career',
        ],
        Sport::TYPE_VOLLEYBALL => [
            'highs',
            'game_by_game',
            'career',
            'offensive',
            'career_total_offensive',
            'career_defensive',
            'career_total_defensive',
        ],
        Sport::TYPE_ICE_HOCKEY => [
            'game_by_game',
            'career',
            'highs',
            'goalkeeping_highs',
            'goalkeeping_stats',
        ]
    ];

    public function run()
    {
        foreach (self::$availableBlocksByTypes as $sportType => $sportTypeBlocks) {
            SportBlock::where('sport_type', '=', $sportType)
                ->whereNotIn('block', $sportTypeBlocks)
                ->delete();

            foreach ($sportTypeBlocks as $block) {
                SportBlock::updateOrCreate([
                    'sport_type' => $sportType,
                    'block' => $block,
                ],
                    [
                        'title' => title_case(str_replace('_', ' ', $block)),
                    ]);
            }
        }
    }
}
