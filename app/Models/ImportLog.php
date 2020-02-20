<?php

namespace App\Models;

/**
 * App\Models\ImportLog
 *
 * @property int $id
 * @property int $import_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Import $import
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImportLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImportLog extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'import_logs';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    // public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'import_id',
        'type',
        'content',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:n/d/y H:i:s',
        'updated_at' => 'datetime:n/d/y H:i:s'
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
     * Import model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function import()
    {
        return $this->belongsTo(Import::class);
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
