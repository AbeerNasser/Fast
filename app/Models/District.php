<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name','city_id'
    ];
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }
    
     public function groups()
    {
        return $this->belongsToMany('App\Models\Group');
    }
    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }
}
