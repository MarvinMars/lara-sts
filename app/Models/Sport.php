<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Event;

class Sport extends Model
{
    use CrudTrait, Sluggable;

    const TYPE_LACROSSE = 'LC';
    const TYPE_BASEBALL = 'BS';
    const TYPE_FOOTBALL = 'FB';
    const TYPE_SOFTBALL = 'SB';
    const TYPE_BASKETBALL = 'BB';
    const TYPE_SOCCER = 'SO';
    const TYPE_ICE_HOCKEY = 'HK';
    const TYPE_VOLLEYBALL = 'VB';

    public static $availableTypes = [
        self::TYPE_LACROSSE => 'Lacrosse',
        self::TYPE_BASEBALL => 'Baseball',
        self::TYPE_FOOTBALL => 'Football',
        self::TYPE_SOFTBALL => 'Softball',
        self::TYPE_BASKETBALL => 'Basketball',
        self::TYPE_SOCCER => 'Soccer',
        self::TYPE_ICE_HOCKEY => 'Ice Hockey',
        self::TYPE_VOLLEYBALL => 'Volleyball',
    ];

    public static $gameFileDefinitions = [
        self::TYPE_LACROSSE => 'lcgame',
        self::TYPE_BASEBALL => 'bsgame',
        self::TYPE_FOOTBALL => 'fbgame',
        self::TYPE_SOFTBALL => 'bsgame',
        self::TYPE_BASKETBALL => 'bbgame',
        self::TYPE_SOCCER => 'sogame',
        self::TYPE_ICE_HOCKEY => 'hkgame',
        self::TYPE_VOLLEYBALL => 'vbgame',
    ];

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    //protected $table = 'sports';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'type',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

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

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'sport_season');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_sport');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
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
}
