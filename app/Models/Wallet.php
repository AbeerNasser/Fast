<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets' ;

    protected $fillable = [
        'money','order_id','delegate_id',
        'created_at', 'updated_at'
    ];
    
    public function delegate()
    {
        return $this->belongsTo('App\Models\Delegate');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
