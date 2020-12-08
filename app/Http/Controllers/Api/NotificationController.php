<?php

namespace App\Http\Controllers\Api;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Notification;
use DB;
use App\Traits\GeneralTrait;

class NotificationController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotifications(Request $request)
    {
        $notifications = Notification::select('*')
        ->where('delegate_id',$request->delegate_id)
        ->get();
        return $this -> returnData('data',$notifications);
    
    }

    public function notification(Request $request)
    {

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=Delegate::where('id',$request->delegate_id)
        ->pluck('firebase_token')->first();
        $body=notification::where('delegate_id',$request->delegate_id)
        ->pluck('body')->first();
        $notification = [
            'body' => $body,
            'title' => 'test title',
            'sound' => true,
            'content_available'=>true,
            'priority'=>'high',
            // "sound" : "default",
            // "body" :  "test body",
            // "title" : "test title",
            // "content_available" : true,
            // "priority" : "high",
        ];
        $extraNotificationData = ["message" => $notification];

        $fcmNotification = [
            // 'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
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

    // public function index()
    // {
    //     $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/laravelfirebase-9d875-firebase-adminsdk-wltre-a1b8486a6c.json');
    //     $firebase = (new Factory)
    //     ->withServiceAccount($serviceAccount)
    //     ->withDatabaseUri('https://laravelfirebase-9d875.firebaseio.com/')
    //     ->create();

    //     $database = $firebase->getDatabase();

    //     $newPost = $database
    //     ->getReference('delivery/delegates')
    //     ->push([
    //     'title' => 'Laravel FireBase ' ,
    //     'category' => 'Laravel'
    //     ]);
    //     echo '<pre>';
    //     print_r($newPost->getvalue());
    // }
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
        //
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
