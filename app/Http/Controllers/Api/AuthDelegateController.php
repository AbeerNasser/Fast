<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthDelegateController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {

        try {
            $rules = [
                "phone" => "required",
                "password" => "required",
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request -> only(['phone','password']) ;
            
            $found=Delegate::where('phone',$request->phone)
            ->where('temp_disable',0)
            ->pluck('id')->first();
            
            if($found)
            {

            $token =  Auth::guard('delegate-api') -> attempt($credentials);

            if(!$token)
               return $this->returnError('E001','بيانات الدخول غير صحيحة');
               
               
            Delegate::where('phone',$request->phone)->update(['firebase_token'=>$request->firebase_token]);

            $delegateAdmin = Auth::guard('delegate-api') -> user();
            $delegateAdmin -> api_token = $token;
            //return token
             return $this -> returnData('data' , $delegateAdmin,'تم الدخول كمندوب بنجاح');
            }
            else{
             return $this -> returnError('001','تم ايقاف هذا المندوب مؤقتا');
            }
            }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

}
