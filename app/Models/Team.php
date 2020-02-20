<?php

namespace App\Models;

use App\Interfaces\Importable;
use Backpack\CRUD\CrudTrait;

class Team extends Model implements Importable
{
    use CrudTrait;

    protected $fillable = [
        'name',
        'title',
        'code',
        'shortcode',
    ];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Return team IDS for the current team.
     *
     * @return array
     */
    public static function teamIds(): array
    {
        $env_string = (string)config('stats.team_ids', '');
        $env_array = explode(',', $env_string);

        if (count($env_array) > 0) {
            foreach ($env_array as $key => $item) {
                if (!empty ($item)) {
                    $env_array[$key] = trim($item);
                } else {
                    unset($env_array[$key]);
                }
            }
            return $env_array ?: [];
        }


        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_team');
    }

    public function events_home_team()
    {
        return $this->hasMany(Event::class, 'home_team_id','id');
    }

    public function  events_away_team()
    {
        return $this->hasMany(Event::class, 'away_team_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(Player::class, 'team_id', 'id');
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
    public function setNameAttribute($value)
    {
        $this->attributes['title'] = $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getHumanTitleAttribute($value)
    {
        return $this->title . ' ' . $this->shortcode;
    }
}
