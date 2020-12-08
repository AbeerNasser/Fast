<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\City;
use App\Models\District;
use App\Models\Group;
use App\Models\Wallet;
use DB;
use App\Traits\GeneralTrait;

class walletController extends Controller
{
    use GeneralTrait;
    
    public function addToWallet(Request $request)
    {
         $data =$request->all();
         
         $delegateStatus=Delegate::where('id',$request->delegate_id)
         ->pluck('delegate_status')->first();

       if ($delegateStatus==0 ) 
       {

            $walets = Wallet::where('delegate_id',$request->delegate_id)
            ->get();

            $delegate=Delegate::select('total_price')->where('id',$request->delegate_id)
            ->get();
            
            $wallet['walets']=$walets;
            $wallet['total_price']=$delegate;    

            return $this -> returnData('data',$wallet,' تم اضافه النسبه الي حسابك');
        }

        // return $this -> returnData('data',$order_status);
        return $this -> returnError('000','');
    }
}
