<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Season;
use App\Models\Player;
use App\Models\Sport;
use App\Models\Team;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class StatsController extends Controller
{
    protected $data = [];

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect(route('backpack'));
    }

    /**
     * @param Player $player
     * @param Season|null $season
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function byPlayerSeason(Player $player, Season $season = null)
    {
        if (!is_null($season)) {
            $season = Season::whereHas('players', function (Builder $query) use ($player) {
                $query->where('player_id', '=', $player->id);
            })->find($season->id);
        } else {
            $season = Season::query()
                ->whereHas('players', function (Builder $query) use ($player) {
                    $query->where('player_id', '=', $player->id);
                })
                ->orderByDesc('title')
                ->orderBy('sort')
                ->first();
        }

        if (!$player->seasons || !$season) {
            abort(404, 'Player does not played in the season');
        }


        $this->data = [
            'player' => $player,
            'season' => $season,
            'seasons' => $player->seasons,
            'title' => trans('stats.player_stats', [
                'name' => $player->name,
                'season' => $season->title,
                'sport' => $player->sport->title,
            ]),
        ];
        return view('stats.index', $this->data);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function live(Event $event)
    {
	    if( $event->status == Event::STATUS_ERROR ){
		    abort(404, 'Event parsed with errors');
	    }
	    if( $event->status == Event::STATUS_QUEUE ){
		    abort(404, 'Event not ready yet');
	    }
    	if( $event->status == Event::STATUS_PROCESSED ){
		    if(empty($event->parse_result)){
			    abort(404, 'Event not ready yet');
		    }else{
			    $array = json_decode($event->parse_result, TRUE);

			    try {
				    switch ($array['sport']) {
					    case 'hkgame':
						    $individual = [
							    'info'            =>  $array['data']['info'] ?? [],
							    'faceoff'         =>  $array['data']['stats']['data']['faceoff']['data'] ?? [],
							    'goalkeeping'     =>   $array['data']['stats']['data']['goalkeeping']['data'] ?? [],
							    'shots_by_period' =>   $array['data']['stats']['data']['shots_by_period']['data'] ?? [],
						    ];
						    $boxscore = [
							    'boxscore'           =>  $array['data']['base']  ?? [],
							    'stats'              =>  $array['stats']  ?? [],
							    'scoring_summary'    =>  $array['data']['scoring_summary']['data'] ?? [],
							    'power_play_summary' =>  $array['data']['power_play_summary']['data']  ?? [],
							    'penalty_summary'    =>  $array['data']['penalty_summary']['data']  ?? [],
						    ];
						    break;
					    case 'fbgame':
						    $individual = [
							    'info'          =>  $array['data']['info'] ?? [],
							    'offensive'     =>  $array['data']['stats']['data']['offensive'] ?? [],
							    'defensive'     =>  $array['data']['stats']['data']['defensive'] ?? [],
							    'special'       =>  $array['data']['stats']['data']['special'] ?? [],
							    'team_stats'    =>  $array['data']['stats']['data']['team_stats'] ?? [],
							    'drive_chart'   =>  $array['data']['stats']['data']['drive_chart'] ?? [],
							    'participation' =>  $array['data']['stats']['data']['participation'] ?? [],
							    'starters'      =>  $array['data']['stats']['data']['starters'] ?? [],
						    ];
						    $boxscore = [
							    'boxscore'        =>  $array['data']['base'] ?? [],
							    'stats'           =>  $array['stats'] ?? [],
							    'scoring_summary' =>  $array['data']['scoring_summary']['data'] ?? [],
						    ];
						    break;
					    case 'sogame':
					    case 'lcgame':
						    $individual = [
							    'info'         =>  $array['data']['info'] ?? [],
							    'teams_stats'  =>  $array['data']['stats']['data'] ?? [],
							    'goalie_stats' =>  $array['data']['goalie_stats']['data'] ?? [],
						    ];
						    $boxscore = [
							    'boxscore'        =>  $array['data']['base'] ?? [],
							    'stats'           =>  $array['stats'] ?? [],
							    'scoring_summary' =>  $array['data']['scoring_summary']['data'] ?? [],
							    'ejections'       =>  $array['data']['ejections']['data'] ?? [],
							    'teams'           =>  $array['data']['team']['data'] ?? [],
						    ];

						    break;
					    case 'bsgame':
						    $individual = [
							    'game' =>  $array['data']['game']['data'] ?? [],
							    'info' =>  $array['data']['info'] ?? [],
						    ];
						    $boxscore = [
							    'boxscore' =>  $array['data']['base'] ?? [],
							    'stats'    =>  $array['stats'] ?? [],
							    'game'     =>  $array['data']['game']['data'] ?? [],
						    ];
						    break;
					    case 'bbgame':
						    $individual = [
							    'game' =>  $array['data']['game']['data'] ?? [],
							    'info' =>  $array['data']['info'] ?? [],
						    ];
						    $boxscore = [
							    'boxscore' =>  $array['data']['base'] ?? [],
							    'stats' =>  $array['stats'] ?? [],
							    'game' =>  $array['data']['game']['data'] ?? [],
						    ];
						    break;
					    case 'vbgame':
						    $individual = [
							    'game' =>  $array['data']['game']['data'] ?? [],
							    'info' =>  $array['data']['info'] ?? [],
						    ];
						    $boxscore = [
							    'boxscore' =>   $array['data']['base'] ?? [],
							    'stats'    =>   $array['stats'] ?? [],
							    'game'     =>   $array['data']['game']['data'] ?? [],
						    ];
						    break;
					    default:
						    $individual = [
							    'teams' =>  $array['data']['stats']['data'] ?? [],
							    'info' =>  $array['data']['info'] ?? [],
						    ];

						    $boxscore = [
							    'boxscore' =>   $array['data']['base'] ?? [],
							    'stats'    =>   $array['stats'] ?? [],
						    ];
				    }

				    return view('stats.live.index',[
					    'event' => $event,
					    'sport' => $array['sport'],
					    'boxscore' => $boxscore,
					    'individual' => $individual,
					    'play_by_play' =>  $array['data']['play_by_play']['data'] ?? [],
				    ]);
			    } catch (Exception $e) {
				    return view('stats.live.no_data');
			    }
		    }
	    } else {
		    abort(404);
	    }
    }
}
