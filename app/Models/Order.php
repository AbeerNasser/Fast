<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'phone', 'order_price', 'total_price', 'order_status','address','notes','payment_way','delegate_id','restaurant_id','created_at','p','district_id','flagord'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
    public function delegate()
    {
        return $this->belongsTo('App\Models\Delegate');
    }
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }
}
