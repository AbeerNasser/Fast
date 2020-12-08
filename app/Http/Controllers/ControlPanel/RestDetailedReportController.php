<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\District_group;
use App\Models\Group;
use App\Models\District;
use DB;

class RestDetailedReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $restaurants = Restaurant::get();
        return view('pages/restaurantDetailedReport',['restaurants'=>$restaurants]);
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
        $restaurant= Restaurant::addSelect(
           ['district' => District::select('name')->whereColumn('districts.id', 'restaurants.district_id')
        ])->find($request->restaurant_id);    
        
        $allOrders=Order::where('restaurant_id',$restaurant->id)
        ->get();
        $orders=Order::where('restaurant_id',$restaurant->id)
        ->where('order_status','=',2)
        ->get();
        $ord=Order::where('restaurant_id',$restaurant->id)
        ->where('order_status','=',1)
        ->get();
        
        $groups = DB::table('district_groups')
            ->where('restaurant_id',$restaurant->id)
            ->join('groups', 'district_groups.group_id', '=', 'groups.id')
            ->join('districts', 'district_groups.district_id', '=', 'districts.id')
            ->select('groups.*','districts.name as district')
            ->get();
        
        
        return view('pages/restaurantDetailedReport',['restaurant'=>$restaurant,'allOrders'=>$allOrders,'orders'=>$orders,'ord'=>$ord,'groups'=>$groups]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $restaurant = Restaurant::find($id);
        // return json_encode($restaurant);  
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
