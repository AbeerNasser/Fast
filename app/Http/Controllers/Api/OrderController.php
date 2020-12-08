<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\District;
use App\Models\Restaurant;
use App\Models\Delegate;
use App\Models\Notification;
use App\Traits\GeneralTrait;


class OrderController extends Controller
{
    use GeneralTrait;
    
    public function createOrder(Request $request)
    {
        //payment_ways enum values
        $type = DB::select( DB::raw("SHOW COLUMNS FROM orders WHERE Field = 'payment_way'") )[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
            
        $districts = DB::table('district_groups')->where('restaurant_id',$request->id)
            ->join('districts', 'district_groups.district_id', '=', 'districts.id')
            ->join('groups', 'district_groups.group_id', '=', 'groups.id')
            ->select('districts.id', 'districts.name', 'groups.price')
            ->get();   

        $data['enum']=$enum;
        $data['districts']=$districts;
      
        return $this -> returnData('data',$data,'سعر التوصيل لكل حي');
    }
    
    public function notification()
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $tokens=Delegate::where('firebase_token','!=',null)->pluck('firebase_token');
        $data = [
            'body' => 'هناك طلب جديد',
            'title' => 'Faster App',
            'sound' => 'noti_sound.mp3',
            'content_available'=>true,
            'priority'=>'high',
            'channel_id'=>'fasterNotificationChannel',
        ];
        
        $fcmNotification = [
            'registration_ids' => $tokens, //multple token 
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
    
    public function storeOrder(Request $request)
    {
        $restaurant = Restaurant::find($request -> id);

        //validation
        $request->validate([
            'order_price' => 'required',
            'payment_way' => 'required',
            'phone' => 'required',//client_phone
            'address' => 'required',//district_name
        ]);

        $data =$request->all();
        $request->total_price = $request -> order_price + $request -> price;
        $total_price= $request->total_price;
        $data['total_price']=$total_price;
        $data['p']=$request -> price;
        $data['restaurant_id']=$request -> id;
        $data['district_id']=$request -> district_id;
        $data['created_at']= \Carbon\Carbon::now('Asia/Riyadh')->toDateTimeString();

        $order = Order::create($data);
        
        $this->notification();
        return $this -> returnData('data',$order,'تم تقديم الطلب بنجاح');
    
    }

   
    public function orderTracking(Request $request)
    {
        $order = Order::select('id','order_price',
        'address', 'order_status')->where('id', $request -> id)
        ->addSelect(['delegate_phone' => Delegate::select('phone')
        ->whereColumn('id', 'orders.delegate_id')])
        ->get();
        $ord = Order::find($request -> id);
        if(!$ord)
            return $this->returnError('S001','');
        return $this -> returnData('data',$order,'تتبع الطلب');  
    }

    public function restOrders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->where('restaurant_id',$request->id)->get();
        
        $ord = Restaurant::find($request -> id);
        if(!$ord)
            return $this->returnError('S001','');
        return $this -> returnData('data',$orders,'الطلبات من الاحدث الي الاقدم');

    }

    public function show(Request $request)
    {
        $order = Order::find($request -> id);
        if(!$order)
            return $this->returnError('001','هذاالطلب غير موجود');
        return $this -> returnData('data',$order,'تم جلب البيانات الطلب بنجاح');
    }

   

}
