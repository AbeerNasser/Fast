<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class District_group extends Model
{
    protected $fillable = [
        'group_id','district_id','restaurant_id'
    ];

    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
   

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }

}
