<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

class RestaurantController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::get();
        return $this -> returnData('data',$restaurants);
    }

    public function show(Request $request)
    {
        $restaurant = Restaurant::find($request -> id);
        if(!$restaurant)
            return $this->returnError('001','هذاالمطعم غير موجود');
        return $this -> returnData('data',$restaurant,'تم جلب البيانات بنجاح');
    }
}
