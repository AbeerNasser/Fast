<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerSupport;
use App\Models\Order;
use App\Models\Delegate;
use App\Models\Restaurant;
use DB;
use Illuminate\Pagination\Paginator;

class AdminSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $supports= CustomerSupport::where('status','=',0)->with(['restaurant','delegate'])->get();
        return view('pages/adminSupport', ['supports' => $supports]);
    }
    
    public function activeSupport($id)
    {
        $support = CustomerSupport::findOrFail($id);
        if($support->status == 0)
            CustomerSupport::where('id',$id)->update(['status'=>1]);
        else
            CustomerSupport::where('id',$id)->update(['status'=>0]);
        return redirect('admin/support');
    }
    
    public function TrackingOrder($id)
    {
        $order = Order::find($id);
        $orderStatus=Order::where('id',$id)->pluck('order_status')->first();
        $delegateStatus=Delegate::where('id',$order->delegate_id)->pluck('delegate_status')->first();
 
        if($orderStatus==0 && $delegateStatus==1)
            return back()->with('alert',  'مازال الطلب بالمطعم في انتظار المندوب');
        elseif($orderStatus==1 && $delegateStatus==1)
            return back()->with('alert','تم سليم الطلب للمندوب');
        elseif($orderStatus==2 && $delegateStatus==0)
          return back()->with('alert','تم تسليم الطلب للعميل');
            
        else
            return back()->with('alert','لم يوافق مندوب علي تسليم الطلب حتي الان');
        
    }
    
    public function deleteOrder($id)
    {
        $support = CustomerSupport::findOrFail($id);

            if($support->type_of_problem =='العميل الغي الطلب')
            {
                Delegate::where('id',$support->delegate_id)->update(['delegate_status'=>0]);
                Order::where('id',$support->details)
                ->delete();

                $support->delete();  
                
                CustomerSupport::where('details',$support->details)->delete();
            }
        return redirect('admin/support');
    }
    
    public function delayOrder($id)
    {
        $support = CustomerSupport::findOrFail($id);

            if($support->type_of_problem == 'تاخير المندوب')
            {
                Order::where('id',$support->details)->update(['order_status'=>0]);
                Delegate::where('id',$support->delegate_id)->update(['delegate_status'=>0]);
                
                $support->delete();
            }
        return redirect('admin/support');
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
        $data = $request->all();
        $request->validate([
            'order' => 'required',
        ]);
       $order= Order::find($request->order);

        if($order != null && $order->delegate_id != null)
        {
            $supports = Order::where('orders.id', $request->order)
            ->addSelect(['restaurant_name' => Restaurant::select('name')
                ->whereColumn('id', 'orders.restaurant_id')
            ])
            ->addSelect(['restaurant_phone' => Restaurant::select('phone')
                ->whereColumn('id', 'orders.restaurant_id')
            ])
            ->addSelect(['delegate_name' => Delegate::select('name')
                ->whereColumn('id', 'orders.delegate_id')
            ])
            ->addSelect(['delegate_phone' => Delegate::select('phone')
                ->whereColumn('id', 'orders.delegate_id')
            ])
            ->get();   
            $this->TrackingOrder($request->order);
            return view('pages/supportDetails', ['supports' => $supports[0]]);
        }
        
      return redirect('admin/support');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        // $support=CustomerSupport::findOrFail($id);
        // if($support->restaurant_id != null)
        // {
        //     $supports = DB::table('customer_supports')
        //     ->where('customer_supports.id', $id)
        //     ->where('customer_supports.restaurant_id', $support->restaurant_id)
        //     ->where('customer_supports.details', $support->details)
        //     ->join('restaurants','customer_supports.restaurant_id', '=', 'restaurants.id')
        //     ->join('orders', 'customer_supports.details', '=', 'orders.id')
        //     ->join('delegates', 'orders.delegate_id', '=', 'delegates.id')
        //     ->select('orders.id as order_id','orders.order_price','orders.phone as client_phone',
        //     'orders.address as client_address','restaurants.name as restaurant_name',
        //     'restaurants.phone as restaurant_phone',
        //     'delegates.name as delegate_name','delegates.phone as delegate_phone')      
        //     ->get();
        // }else{
        //     $supports = DB::table('customer_supports')
        //     ->where('customer_supports.id', $id)
        //     ->where('customer_supports.delegate_id', $support->delegate_id)
        //     ->where('customer_supports.details', $support->details)
        //     ->join('delegates', 'customer_supports.delegate_id', '=', 'delegates.id')
        //     ->join('orders', 'customer_supports.details', '=', 'orders.id')
        //     ->join('restaurants','orders.restaurant_id', '=', 'restaurants.id')
        //     ->select('orders.id as order_id','orders.order_price','orders.phone as client_phone',
        //     'orders.address as client_address','restaurants.name as restaurant_name',
        //     'restaurants.phone as restaurant_phone',
        //     'delegates.name as delegate_name','delegates.phone as delegate_phone')      
        //     ->get();
        // }
        // return view('pages/supportDetails', ['supports' => $supports[0]]);
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
