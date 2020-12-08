<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\District_group;
use App\Models\Group;
use Carbon;

class DelegatsReportController extends Controller
{
    public function index()
    {
        $delegates = Delegate::get();
        
        return view('pages/dd',['delegates'=>$delegates]);
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
        // ->where('delegate_id',$request->delegate_id)
        // ->select('id','created_at','order_price','p')->get();
    
        
        //return view('pages/delegatsReport',['orders'=>$orders]);
    }
    
    public function show($id)
    {
        // $orders=Order::where('delegate_id',$id)->select('id','created_at','order_price','p','delegate_id')
        // ->get();
        
        // $delegate_id=Order::where('delegate_id',$id)->pluck('delegate_id')
        // ->first();
        
        // return view('pages/dddetails',['orders'=>$orders,'delegate_id'=>$delegate_id]);
        
        
        $orders=Order::where('delegate_id',$id)->with('restaurant')
        ->get();
        
        $delegate_id=Order::where('delegate_id',$id)->pluck('delegate_id')
        ->first();

        return view('pages/dddetails',['orders'=>$orders,'delegate_id'=>$delegate_id]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // $data=$request->all();
        // $datefrom = $request->input('datefrom');
        // $dato = $request->input('dateto');    
        // $dateto=Carbon\Carbon::parse($dato)->addDays(1);
        
        // $orders=Order::whereBetween('created_at',[$datefrom,$dateto])
        // ->where('delegate_id',$request->delegate_id)
        // ->select('id','created_at','order_price','p')->get();
        
        // return view('pages/delegatsReport',['orders'=>$orders]);
        
        
        
        $data=$request->all();
        $datefrom = $request->input('datefrom');
        $dateto = $request->input('dateto');

        $endday = date("Y-m-d", strtotime("$dateto +1 day"));
 
        $id = $request->input('delegateId'); 
    
        $orders = Order::where('delegate_id',$id)->whereBetween('created_at',[$datefrom,$endday])->get();

        return view('pages/dddetails',['orders'=>$orders]);
    }

    public function destroy($id)
    {
        //
    }
}
