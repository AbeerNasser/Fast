<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'body','delegate_id','created_at','updated_at'
    ];
    public function delegates()
    {
        return $this->hasMany('App\Models\Delegate');
    }
}
