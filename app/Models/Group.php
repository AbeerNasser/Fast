<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'percentage','price','created_at','updated_at'
    ];


    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }
    
    public function districtGroups()
    {
        return $this->belongsToMany('App\Models\District');
    }
}
