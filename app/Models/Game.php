<?php

namespace App\Models;

use App\Interfaces\Importable;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;


class Game extends Model implements Importable
{
    use CrudTrait;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected $fillable = [
        'number',
        'gameid',
        'date',
        'start',
        'site',
        'stadium',
        'opponent_name',
        'score',
        'attend',
        'duration',
        'leaguegame',
        'neutralgame',
        'nitegame',
        'postseason',
        'homeaway',
        'created_at',
        'updated_at',
        'sport_id',
//
//        'version',
//        'generated',
//        'visid',
//        'homeid',
//        'schedinn',
//        'umpires',
//        'officials',
//        'notes',
//        'rules',
//        'totals',
//        'notes',

        //not existing values but with mutators
        'location',

    ];

    protected $dates = [
        'game_date',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'game_season');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'game_team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany(Player::class, 'game_player');
    }

    public function playerValues()
    {
        return $this->hasMany(PlayerValue::class);
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * @param $value
     */
    public function setLeaguegameAttribute($value)
    {
        $this->attributes['leaguegame'] = ($value == 'Y');
    }

    /**
     * @param $value
     */
    public function setNitegameAttribute($value)
    {
        $this->attributes['nitegame'] = ($value == 'Y');
    }

    /**
     * @param $value
     */
    public function setNeutralgameAttribute($value)
    {
        $this->attributes['neutralgame'] = ($value == 'Y');
    }


    /**
     * @param $value
     */
    public function setPostseasonAttribute($value)
    {
        $this->attributes['postseason'] = ($value == 'Y');
    }

    /**
     * @param $value
     */
    public function setHomeawayAttribute($value)
    {
        $this->attributes['homeaway'] = ($value == 'H');
    }

    /**
     * @param $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->toDateString();
    }

    /**
     * @param $value
     */
    public function setStartAttribute($value)
    {
        if ($value) {
            $this->attributes['start'] = Carbon::parse($value)->toTimeString();
        }

    }

    /**
     * @param $value
     */
    public function setDurationAttribute($value)
    {
        if ($value) {
            $this->attributes['duration'] = Carbon::parse($value)->toTimeString();
        }
    }

    public function setLocationAttribute($value)
    {
        if (!$this->site && $value) {
            $this->attributes['site'] = $value;
        }
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getStartAttribute($value)
    {
        return Carbon::parse($value)->toTimeString();
    }

    /**
     * Return game length in seconds.
     *
     * @return float|int
     */
    public function getGameLengthSecondsAttribute()
    {
        $duration = $this->duration;

        //hh:mm:ss
        if (!is_null($duration) && preg_match('/^([0-9]+){1,2}\:([0-9]+){1,2}\:([0-9]+){1,2}$/', $duration)) {
            list($hours, $minutes, $seconds) = explode(':', $duration);

            return (($hours * 60 * 60) + ($minutes * 60) + $seconds);
        }

        return 0;
    }

    /**
     * @param $value
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function getGameDateAttribute($value)
    {
        if ($this->date) {
            return Carbon::parse($this->date)->format('n/d/y');
        }

        return null;
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getHumanTitleAttribute($value)
    {
        return $this->stadium . ' ' . $this->site . ' ' . $this->gameDate;
    }
}
