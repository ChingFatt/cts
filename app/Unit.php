<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'block_id',
        'unit_number'
    ];

    public function occupants() {
        return $this->hasMany('App\Occupant', 'unit_id');
    }

    public function visitors() {
        return $this->hasMany('App\Visitor', 'unit_id')->orderBy('visit_end')->orderBy('visit_start', 'desc');
    }
}
