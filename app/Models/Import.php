<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Exception;
use Illuminate\Support\Collection;
use SimpleXMLElement;

class Import extends Model
{
    use CrudTrait;

    const STATUS_UPLOADED = 0;
    const STATUS_GAMES = 1;
    const STATUS_TEAMS = 2;
    const STATUS_PLAYERS = 3;
    const STATUS_DONE = 4;
    const STATUS_ERROR = -1;
    const STATUS_IMPORTING = 5;
    const STATUS_WRONG_FILE = 6;
    const STATUS_FILE_NOT_FOUND = 7;
    const STATUS_IS_NOT_GAME = 8;
    const STATUS_MISSING_TEAM = 9;
    const STATUS_GAME_EXISTS = 10;
    const STATUS_DONE_WITH_ERRORS = 11;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    //protected $table = 'imports';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'season_id',
        'files',
        'sport_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'files' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($obj) {
            if (count((array)$obj->files)) {
                foreach ($obj->files as $filePath) {
                    \Storage::disk('import')->delete($filePath);
                }
            }

        });

        static::creating(function ($obj) {
            $obj->status = self::STATUS_UPLOADED;
        });
    }

    /**
     *
     *
     * @param bool $crud
     *
     * @return string
     */
    public function openProcessing($crud = false)
    {
        if (!in_array($this->status, [
            self::STATUS_DONE,
            self::STATUS_ERROR,
        ])
        ) {
            return '<a class="btn btn-xs btn-primary" ' .
                'href="' . route('crud.import.processing', [
                    'id' => $this->id,
                ]) . '">' .
                '<i class="fa fa-download"></i> ' . trans('import.proceed') . '</a>';
        }
    }

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
            case self::STATUS_DONE:
                $class = 'bg-green';
                break;
            case self::STATUS_ERROR:
            case self::STATUS_WRONG_FILE:
            case self::STATUS_IS_NOT_GAME:
            case self::STATUS_FILE_NOT_FOUND:
            case self::STATUS_MISSING_TEAM:
            case self::STATUS_DONE_WITH_ERRORS:
                $class = 'bg-red';
                break;
            case self::STATUS_UPLOADED:
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
            self::STATUS_UPLOADED => trans('stats.not_imported'),
            self::STATUS_TEAMS => trans_choice('stats.teams', 2),
            self::STATUS_GAMES => trans_choice('stats.games', 2),
            self::STATUS_PLAYERS => trans_choice('stats.players', 2),
            self::STATUS_IMPORTING => trans('stats.processing'),
            self::STATUS_ERROR => trans('stats.error'),
            self::STATUS_DONE => trans('stats.imported'),
            self::STATUS_WRONG_FILE => trans('stats.wrong_file'),
            self::STATUS_FILE_NOT_FOUND => trans('stats.file_not_found'),
            self::STATUS_IS_NOT_GAME => trans('stats.is_not_game'),
            self::STATUS_MISSING_TEAM => trans('stats.missing_team'),
            self::STATUS_DONE_WITH_ERRORS => trans('stats.done_with_errors'),
        ];
    }

    /**
     * Check all files for correct name and that they can be parsed.
     *
     * @return \Illuminate\Support\Collection|bool
     */
    public function isCorrectFiles(): Collection
    {
        $result = collect();
        if (!$this->files || !is_array($this->files) || !$this->sport) {
            $result->push('Files are not exists on the server or sport does not set.');
            return $result;
        }

        $storage = \Storage::disk('import');
        $expectedDefinition = array_get(Sport::$gameFileDefinitions, $this->sport->type);

        foreach ($this->files as $file) {
            if (!$storage->exists($file)) {
                continue;
            }
            $xml = null;

            try {
                $xml = new SimpleXMLElement($storage->get($file));
            } catch (Exception $e) {
                $result->push(sprintf('File [%s] is not valid XML file', $file));
            }

            if ($xml instanceof SimpleXMLElement) {
                if ($xml->getName() !== $expectedDefinition) {
                    $result->push(sprintf('Wrong file definition. Expected [%s], got [%s]', $expectedDefinition,
                        $xml->getName()));
                }
            }
        }

        return $result;
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * Logs of the import.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(ImportLog::class)->orderByDesc('created_at');
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

    public function getFilesCountAttribute()
    {
        return count($this->files);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * @param $value
     */
    public function setFilesAttribute($value)
    {
        $attribute_name = 'files';
        $disk = 'import';
        $destination = date('Y') . '/' . date('m') . '/' . date('d');

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination);
    }


}
