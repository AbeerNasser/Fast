<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    protected $fillable = [
        'phone','details','delegate_id','type_of_problem','restaurant_id','status','created_at','updated_at'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
    
    public function delegate()
    {
        return $this->belongsTo('App\Models\Delegate');
    }
}
