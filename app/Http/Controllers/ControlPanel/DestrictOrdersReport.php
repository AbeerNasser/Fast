<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\District_group;
use App\Models\Group;
use App\Models\District;
use DB;

class DestrictOrdersReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $districts = District::get();
        dd($districts);
        return view('pages/destrictOrdersReport',['districts'=>$districts]);
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
        $delegate = Delegate::find($request->delegate_id);
        

        $restaurants = DB::table('orders')
            ->where('delegate_id',$delegate->id)
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->join('districts', 'orders.district_id', '=', 'districts.id')
            ->select('restaurants.name as restaurant', 'districts.name as district')
            ->get();
        
        $orders=Order::where('delegate_id',$delegate->id)
        ->where('order_status','=',2)
        ->get();
        
        $myOrders=Order::where('delegate_id',$delegate->id)
        ->where('order_status','!=',2)
        ->get();
        
        return view('pages/delegateDetailedReport',['delegate'=>$delegate,'orders'=>$orders,'myOrders'=>$myOrders,'restaurants'=>$restaurants]);
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
