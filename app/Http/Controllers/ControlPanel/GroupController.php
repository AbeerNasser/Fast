<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\District_group;
use DB;
use Illuminate\Pagination\Paginator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = DB::table('district_groups')
        ->join('groups', 'district_groups.group_id', '=', 'groups.id')
        ->join('districts', 'district_groups.district_id', '=', 'districts.id')
        ->join('cities', 'districts.city_id', '=', 'cities.id')
        ->select('district_groups.id as cell_id','groups.*','cities.name as city_name','districts.name as district_name')
        ->get();
        
        return view('pages/priceGroups',['groups' => $groups]);
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
    public function update(Request $request, $id)
    {
        //
    }
    
     public function activeGroup($id)
    {
        $group = Group::findOrFail($id);
        if($group->status == 0)
            Group::where('id',$id)->update(['status'=>1]);
        else
            Group::where('id',$id)->update(['status'=>0]);
        return redirect('admin/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distGroup = District_group::findOrFail($id);
        $distGroup->delete();
        return redirect('admin/groups');
    }
}
