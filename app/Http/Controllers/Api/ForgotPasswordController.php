<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Traits\GeneralTrait;
use App\Models\Delegate;
use App\Models\Restaurant;


class ForgotPasswordController extends Controller
{
    use GeneralTrait;

    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);
        $email=Restaurant::where('email','=',$request->email)->pluck('id')->first();
        if($email)
            return $this -> returnSuccessMessage('تم ارسال رقم السر الجديد الي الايميل ');
        return $this -> returnSuccessMessage('تحقق من هذا البريد');
    }
    public function delegateForgot(Request $request) {

        $credentials = request()->validate(['phone' => 'required']);
        $phone=Delegate::where('phone','=',$request->phone)->pluck('id')->first();
        if($phone)
            return $this -> returnSuccessMessage('سيتم ارسال رقم السر الجديد في رساله');
        return $this -> returnSuccessMessage('تحقق من رقم الجوال');
    }

    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "تم تغير رقم السر بنجاح"]);
    }
}
