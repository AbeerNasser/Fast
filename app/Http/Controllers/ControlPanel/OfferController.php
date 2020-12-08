<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Offer;
use Illuminate\Pagination\Paginator;

class OfferController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Restaurant::get();
        return view('pages/offers', ['offers' => $offers]);
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
    public function update(Request $request,$id)
    {
        $data=$request->except('_token','_method');

        $restaurant = Restaurant::find($id); 
        
        $data[ 'restaurant_id']=$restaurant->id;

        $offer = Offer::insert($data);
        Restaurant::where('id',$restaurant->id)->update(['has_offer'=>1]);

        return redirect('admin/offers')->with('succeess','inserted');
    }
    // public function removeOffer($id)
    // {
    //    // $data=$request->except('_token','_method');

    //     $restaurant = Restaurant::find($id); 
        
    //     // $data[ 'restaurant_id']=$restaurant->id;

    //     // $offer = Offer::insert($data);
    //     Restaurant::where('id',$restaurant->id)->update(['has_offer'=>0]);

    //     return redirect('admin/offers')->with('succeess','removed');
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //change has_offer for restaurant 

        $restaurant = Restaurant::find($id); 
        Restaurant::where('id',$restaurant->id)->update(['has_offer'=>0]);

        return redirect('admin/offers')->with('succeess','removed');
    }
}
