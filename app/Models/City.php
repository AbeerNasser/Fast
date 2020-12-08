<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name','group_id'
    ];

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }
}
