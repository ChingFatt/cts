<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'nric',
        'unit_id',
        'codes',
        'visit_start',
        'visit_end'
    ];

    public function unit() {
        return $this->belongsTo('App\Unit', 'unit_id');
    }
}