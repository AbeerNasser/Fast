<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthRestaurantController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required|email",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request -> only(['email','password']) ;
            
            $found=Restaurant::where('email',$request->email)
            ->where('temp_disable',0)
            ->pluck('id')->first();
            
            if($found)
            {
            $token =  Auth::guard('restaurant-api') -> attempt($credentials);

            if(!$token)
               return $this->returnError('E001','بيانات الدخول غير صحيحة');

            $admin = Auth::guard('restaurant-api') -> user();
            $admin -> api_token = $token;
            //return token
            return $this -> returnData('data' , $admin,'تم الدخول كمطعم بنجاح');
            }
            else{
             return $this -> returnError('001','تم ايقاف هذا المطعم مؤقتا');
            }
        
        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

 
    
}
