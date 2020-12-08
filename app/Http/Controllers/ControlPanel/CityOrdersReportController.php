<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Order;
use App\Models\District_group;
use App\Models\Group;
use App\Models\District;
use DB;

class CityOrdersReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       $cities = City::get();
        return view('pages/cityOrdersReport',['cities'=>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = DB::table('districts')
            ->where('districts.city_id',$request->city_id)
            ->join('orders', 'districts.id', '=', 'orders.district_id')
            ->join('delegates', 'orders.delegate_id', '=', 'delegates.id')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->select('orders.*','restaurants.name as restaurant', 'delegates.name as delegate','districts.name as district')
            ->get();
  
        return view('pages/cityOrdersReport',['orders'=>$orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
