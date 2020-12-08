<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\District_group;
use App\Models\Group;
use DB;

class dfController extends Controller
{
    public function index()
    { 
        // $restaurants = Restaurant::get();
        // return view('pages/restaurantsReport',['restaurants'=>$restaurants]);
        return view('pages/delRepo');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $datefrom = $request->input('datefrom');
        $dateto = $request->input('dateto');

        $endday = date("Y-m-d", strtotime("$dateto +1 day"));
        
        $orders = Order::whereBetween('created_at',[$datefrom,$endday])->with(['restaurant','delegate'])->get();

        return view('pages/delRepo',['orders'=>$orders]);
    }

    public function show($id)
    {
        $orders=Order::where('restaurant_id',$id)->select('id','created_at','order_price','p','restaurant_id')
        ->get();
        
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