<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function units() {
        return $this->hasMany('App\Unit')->orderBy('created_at', 'desc');
    }
}
