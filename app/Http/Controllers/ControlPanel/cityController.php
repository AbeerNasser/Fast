<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Restaurant;
use Illuminate\Pagination\Paginator;

class cityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // $cities = City::with('group')->get();
        $cities = City::get();

        return view('pages/cities', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $districts=District::get(['name','id']);
        // return view('pages/addNewCity',['districts' => $districts]);
        return view('pages/addNewCity');
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
        $data = $request->validate([
            'name'=>'required',
            // 'group'=>'required',
        ]);

        // $data['group_id']= $request->group;
        $city = City::create($data);

        return redirect('admin/cities')->with('success','inserted');
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
        // $groups=Group::get(['name','id']);
        // $city = City::find($id);
        // return view('pages/addNewCity', ['city' => $city,'groups'=>$groups]); 

        $city = City::find($id);
        return view('pages/addNewCity', ['city' => $city]);
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
        $data=$request->except('_method','_token');

        // $data=$request->validate([
        //     'name'=>'required',
        //     'group'=>'required',
        // ]);

        // $data['name'] = $request->input('name');
        // $data['group_id']= $request->group;
        $city = City::where('id', '=', $id)->update($data);

        return redirect('admin/cities')->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        // $district = District::where('city_id',$city->id)->get();
        // $district->restaurants()->delete();
        $city->districts()->delete();
        $city->delete();
        
        return redirect('admin/cities');
    }
}
