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
use Carbon;

class RestaurantsReportController extends Controller
{
    public function index()
    { 
        // $restaurants = Restaurant::get();
        // return view('pages/restaurantsReport',['restaurants'=>$restaurants]);
        
        
        $restaurants = Restaurant::get();
        return view('pages/ff',['restaurants'=>$restaurants]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // $data=$request->all();
        // $datefrom = $request->input('datefrom');
        // $dato = $request->input('dateto');    
        // $dateto=Carbon\Carbon::parse($dato)->addDays(1);
        
        // $orders=Order::whereBetween('created_at',[$datefrom,$dateto])
        // ->where('restaurant_id',$request->restaurant_id)
        // ->select('id','created_at','order_price','p')->get();
        
        // return view('pages/restaurantsReport',['orders'=>$orders]);
        
    }

    public function show($id)
    {
        // $restaurant = Restaurant::find($id);
        // return json_encode($restaurant);  
        
        
        $orders=Order::where('restaurant_id',$id)
        ->with('delegate')->get();
        //dd($orders);
        $restaurant_id=Order::where('restaurant_id',$id)->pluck('restaurant_id')
        ->first();
        
        return view('pages/ffdetails',['orders'=>$orders,'restaurant_id'=>$restaurant_id]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $data=$request->all();
        $datefrom = $request->input('datefrom');
        $dateto = $request->input('dateto');

        $endday = date("Y-m-d", strtotime("$dateto +1 day"));
 
        $id = $request->input('restId'); 
    
        $orders = Order::where('restaurant_id',$id)->whereBetween('created_at',[$datefrom,$endday])->get();

        return view('pages/ffdetails',['orders'=>$orders]);
    }

    public function destroy($id)
    {
        //
    }
}
