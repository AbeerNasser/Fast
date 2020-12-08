<?php
//admin auth
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Restaurant;
use App\Models\Delegate;
use App\Models\City;
use App\Models\Group;
use App\Models\District;
use App\User;
use App\Models\CustomerSupport;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    
    //مدير دعم فني 
    public function index()
    {
        $supports= CustomerSupport::where('status','=',0)->with(['restaurant','delegate'])->get();
        return view('pages/support', ['supports' => $supports]);
    }
    
    //مدير عام 
    public function handleAdmin()
    {
        $users = User::select('*')->get();
        $districts = District::select('*')->get();
        $cities = City::select('*')->get();
        $groups = Group::select('*')->get();
        $delegates = Delegate::select('*')->get();
        $restaurants = Restaurant::select('*')->get();
        //dd($users);
        return view("pages/dashboard", 
        compact('users','districts','cities','groups','delegates','restaurants'));
    }
    
    //مدير دانشاء مطاعم وتسعيرات 
    public function handleRestaurant()
    {
        $restaurants = DB::table('restaurants')
        ->join('districts', 'restaurants.district_id', '=', 'districts.id')
        ->join('cities', 'districts.city_id', '=', 'cities.id')
        ->select('restaurants.*','cities.name as city_name', 'districts.name as district_name')
        ->get();
        return view('pages/restaurants', ['restaurants' => $restaurants]);
    }
}
