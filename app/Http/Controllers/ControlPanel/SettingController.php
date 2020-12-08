<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Settings_email;
use App\Models\Settings_phone;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/settings');
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
        $request->validate([
            'website_link'=>'nullable',
            'facebook_link'=>'nullable',
            'instgram_link'=>'nullable',
            'youtube_link'=>'nullable',
            'snapchat_link'=>'nullable',
            'twitter_link'=>'nullable',
        ]);
       $data= $request->all();
      
       $sdata= $request->except(['phones','emails']);
       Setting::create($sdata);

        $settings = Setting::pluck('id')->last();
        
        foreach ($request->phones as $key=>$phone) {
            if($phone!= null)
               Settings_phone::insert(['phone'=>$phone,'setting_id'=>$settings]);
        }
        foreach ($request->emails as $key=>$email) {
            if($email!= null)
               Settings_email::insert(['email'=>$email,'setting_id'=>$settings]);
        }

        return redirect('admin/settings')->with('succeess','inserted');
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
