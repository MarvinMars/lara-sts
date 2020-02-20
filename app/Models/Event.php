<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Team;
use App\Models\Sport;
use App\Models\User;

class Event extends Model
{
    use CrudTrait;

    const STATUS_NOT_FOUND   = 1;
    const STATUS_QUEUE       = 2;
    const STATUS_IN_PROGRESS = 3;
    const STATUS_PROCESSED   = 4;
    const STATUS_ERROR       = 5;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'events';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'location',
        'venue',
        'user_id',
        'sport_id',
        'file',
        'file_timestamp',
        'event_date',
        'event_time',
        'home_team_id',
        'away_team_id',
        'is_completed',
	    'parse_result',
        'status',
    ];
    // protected $hidden = [];
    // protected $dates = [];

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

    public function sport()
    {
        return $this->belongsTo(Sport::class,'sport_id');
    }

    public function home_team()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function away_team()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
	 * Get status label as html.
	 *
	 * @return string
	 */
	public function getStatusLabel()
	{
		$labels = $this->getStatusLabels();

		$label = (isset($labels[$this->status]) ? $labels[$this->status] : trans('stats.unknown'));

		switch ($this->status) {
			case self::STATUS_PROCESSED:
				$class = 'bg-green';
				break;
			case self::STATUS_NOT_FOUND:
			case self::STATUS_ERROR:
				$class = 'bg-red';
				break;
			case self::STATUS_IN_PROGRESS:
			case self::STATUS_QUEUE:
				$class = 'bg-yellow';
				break;
			default:
				$class = 'bg-gray';
				break;
		}

		return '<small class="label ' . $class . '">' . $label . '</small>';
	}

	/**
	 * Get status labels.
	 *
	 * @return array
	 */
	public function getStatusLabels()
	{
		return [
			self::STATUS_NOT_FOUND => 'Not found ',
			self::STATUS_QUEUE => 'Queue',
			self::STATUS_IN_PROGRESS => 'In progress',
			self::STATUS_PROCESSED => 'Processed',
			self::STATUS_ERROR => 'Error',
		];
	}

	/**
	 * Get status labels.
	 *
	 * @return array
	 */
	public function getWatchIcon()
	{
		return '<a href="/stats/event/'. $this->id . '" target="_blank"><i class="fa fa-eye"></i></a>';
	}

	/**
	 * Set the file timestamp in UTC.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setFileTimestampAttribute($value)
	{
		$this->attributes['file_timestamp'] = Carbon::createFromTimestampUTC($value)->toDateTimeString();
	}
}
