<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Restaurant;
use App\Models\CustomerSupport;
use App\Models\Notification;
use Illuminate\Http\Request;
use DB;
use App\Traits\GeneralTrait;
use Carbon;

class DelegateController extends Controller
{
    use GeneralTrait;

    public function notification($id)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=Delegate::where('id',$id)
        ->pluck('firebase_token')->first();
        $body=Notification::where('delegate_id',$id)
        ->get('body','created_at');
 
        $data = [
            'body' => 'تم مرور 10 دقائق عن استلام الطلب',
            'title' => 'Faster App',
            'sound' =>'noti_sound',
            'content_available'=>true,
            'priority'=>'high',
            'channel_id'=>'fasterNotificationChannel',
        ];

        $fcmNotification = [
            'to'        => $token, //single token
            'data' => $data
        ];
 
        $headers = [
            'Authorization: key=AAAA876m7x0:APA91bHXBEyVA-E4VVUJUkQhRV6s0hpH8jVVEPbd9fm_spHWKONj85uTdoNl0zRJkVKHJPpU4k7FbLGK-0Z8-o6a7SrPnbyvAfg8PzedXsqaUS-9gDXWIQ5HkimF63cgNjsXcsKExkFF',
            'Content-Type: application/json'
        ];
 
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
 
        return true;
    }
    public function AvailableOrdersDelivery()
    {
        $orders = Order::select('id','created_at')
        ->where('order_status','==',0)
        ->where('delegate_id',null)
        ->addSelect(['restaurant_name' => Restaurant::select('name')
        ->whereColumn('id', 'orders.restaurant_id')
        ])->get();
        return $this -> returnData('data',$orders,'الطلبات المتاحه للتوصيل');
    }

    public function OrderDetails(Request $request)
    {
        $order = Order::select('id','total_price','notes','p','order_price','address')->where('order_status','=',0)
        ->addSelect(['restaurant_name' => Restaurant::select('name')
        ->whereColumn('id', 'orders.restaurant_id')])
        ->addSelect(['restaurant_phone' => Restaurant::select('phone')
        ->whereColumn('id', 'orders.restaurant_id')])
        ->addSelect(['restaurant_address' => Restaurant::select('notes')
        ->whereColumn('id', 'orders.restaurant_id')
        ])->find($request -> id);

        return $this -> returnData('data',$order,'تفاصيل الطلب');
    }

    public function allMyOrders(Request $request)
    {
        $orders = Order::select('id','order_status','total_price',
        'order_price','created_at')
        ->where('delegate_id','=', $request->id)
        ->where('order_status','=',2)
        ->addSelect(['restaurant_name' => Restaurant::select('name')
        ->whereColumn('id', 'orders.restaurant_id')
        ])->get();
        return $this -> returnData('data',$orders,'جميع طلباتي');
    }

    public function fillterMyOrders(Request $request)
    {
        $orders =$request->all();

        $orders = Order::select('id','order_status','total_price',
        'order_price','created_at')
        ->addSelect(['restaurant_name' => Restaurant::select('name')
        ->whereColumn('id', 'orders.restaurant_id')
        ])
        ->where('delegate_id','=', $request->id)
        ->where('order_status','=',2)
        ->where('created_at','LIKE', $request->date.'%')
        ->get();

        return $this -> returnData('data',$orders);
    }

    public function myOrderDetails(Request $request)
    {
        $order = Order::select('id','total_price','order_price','address','phone',
        'order_status','date','notes')
        ->where('delegate_id','=', $request->delegate_id)
        ->addSelect(['restaurant_name' => Restaurant::select('name')
        ->whereColumn('id', 'orders.restaurant_id')])
        ->addSelect(['restaurant_address' => Restaurant::select('notes')
        ->whereColumn('id', 'orders.restaurant_id')])
        ->addSelect(['delegate_status' => Delegate::select('delegate_status')
        ->whereColumn('id', 'orders.delegate_id')])
        ->find($request -> id);
                
        $order -> delivery_price = $order->total_price - $order -> order_price;

        return $this -> returnData('data',$order,'تفاصيل الطلب');
    }

    public function myOrdersOnDelivery(Request $request)
    {
        $date = Order::where('delegate_id','=', $request->id)
        ->where('order_status',0)
         ->pluck('id')->first();
        
        $flagord=Order::where('delegate_id','=', $request->id)
            ->where('expire_date','<=',now())
            ->where('flagord','<>',1)
            ->pluck('id')->first();
             
        $status = Order::find($date);
        if($status && $flagord)
        {     Order::where('delegate_id','=', $request->id)
            ->where('expire_date','<=',now())
            ->update(['flagord'=>1]);
                Notification::insert(
                [
                    'created_at'=> Carbon\Carbon::now('Asia/Riyadh')->toDateTimeString(),
                    'updated_at'=>now('Asia/Riyadh'),
                    'body' => 'تم مرور 10 دقائق علي عدم استلام الطلب', 'delegate_id' => $request->id
                ]);

             $this->notification($request->id);
        }
   
        $orders = Order::select('id','order_status')
                ->where('delegate_id','=', $request->id)
                ->where('order_status','!=',2)
                ->addSelect(['restaurant_name' => Restaurant::select('name')
                ->whereColumn('id', 'orders.restaurant_id')])->get();

        
        return $this -> returnData('data',$orders,'طلباتي التي قيد التوصيل حتي الان');
    }

    public function chooseOrder(Request $request)
   {
       $delegateID=Order::where('delegate_id',null)
       ->where('id',$request->order_id)
        ->pluck('id')->first();

       if ($delegateID) {
        $data =$request->all();
        $delegateStatus=Delegate::where('id',$request->delegate_id)
        ->pluck('delegate_status')->first();

        if ($delegateStatus==0) {
            // $d=\Carbon\Carbon::now('Asia/Riyadh')->toDateTimeString();   
            $d=\Carbon\Carbon::now()->toDateTimeString();   
            $order = DB::table('orders')
            ->where('id', $request->order_id)
            ->update(['order_status' => 0,'delegate_id'=>$request->delegate_id,
            'date'=>\Carbon\Carbon::parse($d)->timestamp,
            //'expire_date' => date("Y-m-d H:i:s", strtotime("+10 minutes", strtotime($dd)))
            'applay_date'=>\Carbon\Carbon::now('Asia/Riyadh'),
            'expire_date'=>date('Y-m-d H:i:s', strtotime('now +10 minutes'))
            ]);
            
            $delegateStatus = DB::table('delegates')
           ->where('id', $request->delegate_id)
           ->update(['delegate_status' => 1]);
           
            return $this -> returnData('data',$order,'تم اختيار الطلب');   
        } 
        else
        {
            return $this -> returnError('000','هذا المندوب  معه طلب اخر');
        }
       }
       else
       {
        return $this -> returnError('000','تم قبول هذا الطلب بواسطه مندوب اخر ');
        }
       
   }

   public function startDelivery(Request $request)
   {
        $data =$request->all();
        
        $delegateStatus=Delegate::where('id',$request->delegate_id)
        ->pluck('delegate_status')->first();

        
       $deledateID=Order::where('id',$request->order_id)
       ->where('delegate_id',$request->delegate_id)
       ->pluck('id')->first();

        if ($delegateStatus==1 && $deledateID) {
            $order = DB::table('orders')
            ->where('id', $request->order_id)
            ->update(['order_status' => 1]);

            return $this -> returnData('data',$order,'تم قبول الطلب');
        }
        return $this -> returnError('000','');
   }

   public function finishRequest(Request $request)
   { 
        $data =$request->all();
        
        $delegateStatus=Delegate::where('id',$request->delegate_id)
        ->pluck('delegate_status')->first();

       $orderStatus=Order::where('delegate_id',$request->delegate_id)->where('id',$request->order_id)->pluck('order_status')->first();

        if ($delegateStatus==1&&$orderStatus==1) 
        {
            $order = Order::where('id',$request->order_id)
            ->where('delegate_id',$request->delegate_id)
            ->update(['order_status'=>2]);

            $delegateStatus = Delegate::where('id',$request->delegate_id)
            ->update(['delegate_status'=>0]);

            $ordr= Order::where('id',$request->order_id)->select('restaurant_id')->pluck('restaurant_id')
                ->first();
            $district= Order::where('id',$request->order_id)->select('district_id')->pluck('district_id')
                ->first();
            $ord=DB::table('district_groups') 
                ->where('restaurant_id',$ordr)
                ->where('district_id',$district) 
                ->join('groups', 'district_groups.group_id', '=', 'groups.id')
                ->select('groups.price as price', 'groups.percentage as percentage')
                ->first();
            $ord-> money =($ord -> price * $ord -> percentage);

            Wallet::insert(
                ['order_id'=>$request->order_id,
                'delegate_id' => $request->delegate_id,
                'money' => $ord-> money,
                'created_at'=>now(),
                'updated_at'=> now()
                ]
            );

           $total= Delegate::where('id', $request->delegate_id)
            ->select('total_price')->pluck('total_price')->first();

            $ord-> total  = $total + $ord-> money;
        
            Delegate::where('id', $request->delegate_id)
            ->update(['total_price' => $ord -> total]);

           return $this -> returnData('data',$ord,' تم تسليم الطلب الي العميل');
       }
        return $this -> returnError('000','');
   }
}
