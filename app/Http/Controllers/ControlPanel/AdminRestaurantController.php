<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\District;
use App\Models\City;
use App\Models\Group;
use App\Models\District_group;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;

class AdminRestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = DB::table('restaurants')
        ->join('districts', 'restaurants.district_id', '=', 'districts.id')
        ->join('cities', 'districts.city_id', '=', 'cities.id')
        ->select('restaurants.*','cities.name as city_name', 'districts.name as district_name')
        ->get();
        return view('pages/adminRest', ['restaurants' => $restaurants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts =District::with('city')->get();
        
        return view('pages/adminAddNewRest',['districts' => $districts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requesont  $request
     * @return \Illuminate\Http\Respse
     */
    public function store(Request $request)
    {   
        $data=$request->all();
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'email'=>'required|email|unique:restaurants',
            'password'=>'required|confirmed',
        ]);
        
        $data['notes']=$request->notes;
        $data['phone']=$request->phone;
        $data['district_id']=$request->address;
        $data['password']=bcrypt($request->password);
        $restaurant = Restaurant::create($data);
      
        return redirect('admin/restaurants')->with('succeess','inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = DB::table('restaurants')
        ->where('restaurants.id',$id)
        ->join('districts', 'restaurants.district_id', '=', 'districts.id')
        ->join('cities', 'districts.city_id', '=', 'cities.id')
        ->select('restaurants.*','cities.name as city_name', 'districts.name as district_name')
        ->get();

        return view('pages/adminOneRest', ['restaurant' => $restaurant[0]]);
    }
    
    public function showGroups($id)
    {
        $restaurant = Restaurant::find($id);
        $district=Restaurant::where('id',$id)->pluck('district_id')->first();
        $city=District::where('id', $district)->pluck('city_id')->first();
        
        $groups = DB::table('district_groups')
            ->where('restaurant_id',$id)
            ->where('groups.status','=',0)
            ->join('districts', 'district_groups.district_id', '=', 'districts.id')
            ->join('groups', 'district_groups.group_id', '=', 'groups.id')
            ->select('district_groups.id as cell_id','groups.*','districts.name as district_name')
        ->get();
            
        $districts=District::where('city_id', $city)->select('id','name')->get();

        return view('pages/adminPricingGroup',['restaurant'=>$restaurant,'groups' => $groups,'districts' => $districts]);
    }

    public function storeGroup(Request $request,$id)
    {
        
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'percentage'=>'required',
        ]);
        $data=$request->except(['_token','_method','districts']);
        Group::insert($data);
        $group = Group::pluck('id')->last();

        foreach ($request->districts as $key=>$district) {
             District_group::insert(['group_id'=>$group,'restaurant_id'=>$id,'district_id'=>$district]);
        
        }
    
        return redirect('admin/restaurants')->with('succeess','inserted');
    }

    public function activeRest($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        if($restaurant->temp_disable == 0)
            Restaurant::where('id',$id)->update(['temp_disable'=>1]);
        else
            Restaurant::where('id',$id)->update(['temp_disable'=>0]);
        return redirect('admin/restaurants');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts =District::with('city')->get();
        $restaurant = Restaurant::find($id);
        return view('pages/adminAddNewRest', ['restaurant' => $restaurant,'districts'=>$districts]);
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
        $data=$request->except(['_method','_token','password_confirmation']);
         $data['password']=bcrypt($request->password);
         if($request->address){
            $data['district_id']=$request->address;
         }
        $restaurant = Restaurant::where('id', '=', $id)->update($data);

        return redirect('admin/restaurants')->with('succeess','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        
        return redirect('admin/restaurants');
    }
}
