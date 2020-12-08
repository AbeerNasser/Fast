<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerSupport;
use App\Models\Restaurant;
use App\Models\Delegate;
// use DB;
use App\Traits\GeneralTrait;

class TechnicalSupportController extends Controller
{
    use GeneralTrait;

    public function requestDelegateTechnicalSupport(Request $request)
    {
        $request->validate([
            'delegate_name' => 'required',
            'type_of_problem' => 'required',
            'details' => 'required',
            'phone' => 'required',//delegate_phone
        ]);
        
        $name=$request->delegate_name;
        $data =$request->all();
        $delegateID = Delegate::select('id')->where('name', $name)->pluck('id')->first();
        $data['delegate_id']=$delegateID;
        
        if(!$data['delegate_id'])
           return $this->returnError('000','لا يوجد مندوب بهذا الاسم');
        else
            $requestTechnicalSupport = CustomerSupport::create($data);

        return $this -> returnData('data',$requestTechnicalSupport->id,'تم تقديم الطلب بنجاح');
    }

    public function requestTechnicalSupport(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required',
            'type_of_problem' => 'required',
            'details' => 'required',
            'phone' => 'required',//restaurant_phone
        ]);
        
        $name=$request->restaurant_name;
        $data =$request->all();
        
        $restaurantID = Restaurant::select('id')->where('name', $name)->pluck('id')->first();

        $data['restaurant_id']=$restaurantID;

        if(!$data['restaurant_id'])
            return $this->returnError('000','لا يوجد مطعم بهذا الاسم');
        else
            $requestTechnicalSupport = CustomerSupport::create($data);

        return $this -> returnData('data',$requestTechnicalSupport->id,'تم تقديم الطلب بنجاح');
    }

   
}
