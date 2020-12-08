<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    
    protected $fillable = [
        'discount_per', 'date_per','restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }


}
