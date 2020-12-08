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

class xxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $restaurants = Restaurant::get();
        return view('pages/xx',['restaurants'=>$restaurants]);
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
        $data=$request->all();
        $datefrom = $request->input('datefrom');
        $dato = $request->input('dateto');    
$dateto=Carbon\Carbon::parse($dato)->addDays(1);
        // $restaurants = Restaurant::whereBetween('created_at',[$datefrom,$dateto])->get();
        
        $orders=Order::whereBetween('created_at',[$datefrom,$dateto])
        ->where('restaurant_id',$request->restaurant_id)
        ->select('id','created_at','order_price','p')->get();
        //dd($orders);
        
        return view('pages/xx',['orders'=>$orders]);
    
        
        
        //return view('pages/xx',['restaurant'=>$restaurant,'allOrders'=>$allOrders,'orders'=>$orders,'ord'=>$ord,'groups'=>$groups]);
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


// <?php

// namespace App\Http\Controllers\ControlPanel;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Restaurant;
// use App\Models\Order;
// use App\Models\District_group;
// use App\Models\Group;
// use DB;

// class RestaurantsReportController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     { 
//         $restaurants = Restaurant::get();
//         return view('pages/restaurantsReport',['restaurants'=>$restaurants]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $data=$request->all();
//         $datefrom = $request->input('datefrom');
//         $dateto = $request->input('dateto');    

//         $restaurants = Restaurant::whereBetween('created_at',[$datefrom,$dateto])->get();
//         // $orders=Order::where('restaurant_id',$request->id)
//         // ->whereBetween('created_at',[$datefrom,$dateto])
//         // ->select('id','created_at','order_price','p')
//         // ->get();
//         // dd($orders);
        
//         return view('pages/restaurantsReport',['restaurants'=>$restaurants]);
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         $orders=Order::where('restaurant_id',$id)->select('id','created_at','order_price','p')
//         ->get();
        
//         // $orders=Order::where('restaurant_id',$request->id)->whereBetween('created_at',[$datefrom,$dateto])->get();
//         // dd($orders);
        
//         return view('pages/restaurantsReportDetails',['orders'=>$orders]);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//     }
// }