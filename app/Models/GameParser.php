<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameParser extends Model
{
    protected $table = 'game_parser';

    protected $fillable = [
        'path',
        'user_id',
        'post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
