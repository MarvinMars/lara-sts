<?php

namespace App\Models;

class SportBlock extends Model {
	public $timestamps = false;

	protected $fillable = [
		'sport_type',
		'title',
		'block',
	];

	public function getTitleWithTypeAttribute(): ?string {
		return $this->sport_type . ': ' . $this->title;
	}
}
