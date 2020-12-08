<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\City;
use App\Models\Restaurant;
use DB;
use Illuminate\Pagination\Paginator;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $districts = District::with('city')->get();
        // ->simplePaginate(4);
        
        return view('pages/districts', ['districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $cities=City::get(['name','id']);
        return view('pages/addNewDistrict',['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name'=>'required',
            'city'=>'required',
        ]);

        $data['city_id']= $request->city;
        $district = District::create($data);

        return redirect('admin/districts')->with('success','inserted');
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
        $cities=City::get(['name','id']);
        $district = District::find($id);
        return view('pages/addNewDistrict', ['district' => $district,'cities' => $cities]);
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
        $request->validate([
            'name'=>'required',
            'city'=>'required',
        ]);
        $data['name'] = $request->input('name');
        $data['city_id']= $request->city;
        $district = District::where('id', '=', $id)->update($data);

        return redirect('admin/districts')->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->restaurants()->delete();
        $district->delete();

        return redirect('admin/districts');
    }
}
