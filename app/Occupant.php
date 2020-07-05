<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_id',
        'name',
        'contact',
        'nric'
    ];

}
