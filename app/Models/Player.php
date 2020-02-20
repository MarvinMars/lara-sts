<?php

namespace App\Models;

use App\Interfaces\Importable;
use Backpack\CRUD\CrudTrait;

class Player extends Model implements Importable
{
    use CrudTrait;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    //protected $table = 'players';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'checkname',
        'uni',
        'code',
        'year',
        'active',
        'gp',
        'team_id',
        'sport_id',
        'player_type_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return array|\Illuminate\Support\Collection
     */
    public function playerValueKeys()
    {
        $playerValues = PlayerValue::select(\DB::raw('MAX(id) as id'), 'group', 'key')
            ->where('player_id', '=', $this->id)
            ->groupBy(['group', 'key']);

        $result = PlayerValue::select('sub.*')
            ->rightJoin(\DB::raw('(' . $playerValues->toSql() . ') as sub'), 'sub.id', '=',
                'player_values.id')
            ->mergeBindings($playerValues->getQuery())
            ->orderBy('sub.id')->get();

        return $result;
    }

    /**
     * @param string $group
     * @param string $key
     * @param int $gameId
     *
     * @return int|mixed
     */
    public function getPlayerValueByQuery(string $group, string $key, int $gameId)
    {
        $result = PlayerValue::select('value')
            ->wherePlayerId($this->id)
            ->where('game_id', '=', $gameId)
            ->where('group', '=', $group)
            ->where('key', '=', $key)
            ->first();

        return (isset($result->value) ? round($result->value, 3) : 0);
    }

    /**
     * @param string $group
     * @param string $key
     * @param Season $season
     *
     * @return string
     */
    public function getPlayerTotalValueByQuery(string $group, string $key, Season $season)
    {
        $result = 0;
        $games = $this->games()
            ->whereHas('seasons', function ($query) use ($season) {
                $query->where('season_id', '=', $season->id);
            })->get();

        if ($games) {
            $result = PlayerValue::select('value')
                ->wherePlayerId($this->id)
                ->whereIn('game_id', $games->pluck('id'))
                ->where('group', '=', $group)
                ->where('key', '=', $key)
                ->sum('value');


        }

        return number_format($result);
    }

    /**
     * Return the opponent name by game for the current player.
     *
     * @param Game $game
     *
     * @return mixed|null
     *
     * @deprecated
     */
    public function getOpponentNameByGame(Game $game)
    {
        return $game->opponent_name;
    }

    /**
     * Return game title by game_id
     *
     * @param int $gameId
     *
     * @return null|string
     */
    public function getOpponentNameByGameId(int $gameId): ?string
    {
        if ($game = Game::find($gameId)) {
            return $this->getOpponentNameByGame($game);
        }

        return null;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAvailableStatsBlocks()
    {
        $result = collect();

        /** @var Sport $sport */
        $sport = $this->sport;

        if ($sport) {
            $availableBlocks = SportBlock::whereSportType($sport->type)->get();
            foreach ($availableBlocks as $availableBlock) {
                $result->push($availableBlock->attributesToArray());
            }
        }

        return $result;
    }

    /**
     *
     * @param int $id
     *
     * @return bool
     *
     * @deprecated
     */
    public function isHideBlock(int $id)
    {
        return $this->hideBlocks()->where('id', '=', $id)->exists();
    }

    /**
     * Check that the block(s) are showing for the current player.
     *
     * @param array ...$blocks
     *
     * @return bool
     */
    public function isHaveBlocks(...$blocks)
    {
        if ($this->playerType) {
            return $this->playerType->sportBlocks()->whereIn('block', $blocks)->exists();
        } else {
            return !$this->hideBlocks()->whereIn('block', $blocks)->exists();
        }

    }

    /**
     * Return external link on the player's stats.
     *
     * @return string
     */
    public function getExternalUrlLink(): string
    {
        return '<a href="' . route('frontend.player.stats',
                ['playerId' => $this->id]) . '" target="_blank">' . $this->name . '</a>';
    }


    /**
     * @param \App\Models\Season $season
     * @param \App\Models\Game|null $game
     * @param string|null $group
     *
     * @return float|int
     * @deprecated
     */
    public function getAvg(Season $season, Game $game = null, string $group = null)
    {
        $avg = 0.000;

        $date = null;

        if (!is_null($game)) {
            $date = $game->date . ' ' . $game->start;
        }

        try {
            $gamesBefore = $this->games()
                ->whereHas('seasons', function ($query) use ($season) {
                    $query->where('season_id', '=', $season->id);
                });
            if (!empty($date)) {
                $gamesBefore = $gamesBefore->whereRaw('TIMESTAMP(games.date, games.start) <= TIMESTAMP(?)',
                    [
                        $date,
                    ]);
            }

            $gamesBefore = $gamesBefore->get();


            if ($gamesBefore) {
                $query = PlayerValue::select('value')->wherePlayerId($this->id)->whereIn('game_id',
                    $gamesBefore->pluck('id')->toArray())->getQuery();

                if ($group) {
                    $query->where('group', '=', $group);
                }

                $hits = clone $query;

                $ab = clone $query;

                $hits = $hits->where('key', '=', 'h')->sum('value');

                $ab = $ab->where('key', '=', 'ab')->sum('value');

                if ($ab > 0) {
                    $avg += ($hits / $ab);
                }
            }
        } catch (\Exception $e) {
        }


        return $avg;
    }

    /**
     * List of the games for the current player in the season.
     *
     * @param Season $season
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function gamesBySeason(Season $season)
    {
        return $this->games()
            ->whereHas('seasons', function ($query) use ($season) {
                $query->where('season_id', '=', $season->id);
            })
            ->whereHas('playerValues', function ($query) {
                $query->where('group', '=', 'player')
                    ->where('key', '=', 'gp')
                    ->where('value', '!=', 0)
                    ->where('player_id', '=', $this->id);
            })
            ->orderBy('date')
            ->orderBy('start')
            ->get();
    }

    /**
     * Clearing page cache of the player.
     *
     * @return void
     */
    public function clearCache(): void
    {
        if (!$this->id || !$this->exists) {
            return;
        }

        $slug = route('frontend.player.stats', [
            'stats_player' => $this->id
        ], false);

        $commandPattern = 'page-cache %s';

        $commands = [
            sprintf($commandPattern, $slug),
            sprintf($commandPattern, $slug . '/')
        ];

        if ($this->seasons) {
            foreach ($this->seasons as $season) {
                $slug = route('frontend.player.stats', [
                    'stats_player' => $this->id,
                    'stats_season' => $season->id
                ], false);

                $commands[] = sprintf($commandPattern, $slug);
                $commands[] = sprintf($commandPattern, $slug . '/');
            }
        }

        foreach ($commands as $key => $command) {
            call_in_background($command, 'sleep ' . $key);
        }

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'player_season')
            ->orderBy('title')
            ->orderBy('sort');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(PlayerValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_player');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hideBlocks()
    {
        return $this->belongsToMany(SportBlock::class, 'player_hide_blocks');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerType()
    {
        return $this->belongsTo(PlayerType::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /**
     * @return int
     */
    public function getGamesPlayedAttribute(): int
    {
        return $this->games()->count();
    }

    /**
     * @return bool
     */
    public function getIsShowDefensiveAttribute(): bool
    {
        return !!$this->values()->where('group', 'defense')->exists();
    }

    /**
     * @return bool
     */
    public function getIsShowRushingAttribute(): bool
    {
        return !!$this->values()->where('group', 'rush')->exists();
    }

    /**
     * @return bool
     */
    public function getIsShowPassingAttribute(): bool
    {
        return !!$this->values()->where('group', 'pass')->exists();
    }

    /**
     * @return bool
     */
    public function getIsShowReceivingAttribute(): bool
    {
        return !!$this->values()->where('group', 'rcv')->exists();
    }

    /**
     * @return bool
     */
    public function getIsShowOffensive(): bool
    {
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Return human title attribute.
     *
     * @param $value
     *
     * @return null|string
     */
    public function getHumanTitleAttribute($value): ?string
    {
        return $this->name;
    }
}
