<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Wallet;
// use App\Models\Restaurant;
use DB;
use Illuminate\Pagination\Paginator;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $delegats = Delegate::get();
        return view('pages/salesReps', ['delegats' => $delegats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('pages/addNewSalesRep');
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
        $request->validate([
            'name'=>'required',
            'sn_no'=>'required',
            'phone'=>'required',
            'password'=>'required|confirmed',
            'sn_img'=>'mimes:png,jpg,jpeg,svg|max:1024',
            // 'notes'=>'nullable|data',
            // 'firebase_token'=>'nullable|data',
        ]);
         if($request->sn_img){
            $name = $request->name;
            $imgName = $name.'.'.$request->sn_img->extension();
            $request->sn_img->move(public_path('img'),$imgName);
            $data['sn_img']=$imgName;
         }
        $data['password']=bcrypt($request->password);
        $delegate = Delegate::create($data);

        return redirect('admin/delegats')->with('success','inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $delegat = Delegate::find($id);
        return view('pages/salesRep', ['delegat' => $delegat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $delegate = Delegate::find($id);
        return view('pages/addNewSalesRep',['delegate' => $delegate]);
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
        $data=$request->except('_method','_token','password_confirmation');
        if($request->sn_img){
        $name = $request->name;
        $imgName = $name.'.'.$request->sn_img->extension();
        $request->sn_img->move(public_path('img'),$imgName);
        $data['sn_img']=$imgName;
        }
         $data['password']=bcrypt($request->password);
        $delegate = Delegate::where('id',$id)->update($data);

        return redirect('admin/delegats')->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $delegate = Delegate::findOrFail($id);
        $delegate->wallets()->delete();
        $delegate->delete();
        
        return redirect('admin/delegats');
    }

    public function activeDelegate($id)
    {
        $delegate = Delegate::findOrFail($id);
        if($delegate->temp_disable == 0)
            Delegate::where('id',$id)->update(['temp_disable'=>1]);
        else
            Delegate::where('id',$id)->update(['temp_disable'=>0]);

        return redirect('admin/delegats');
    }
}
