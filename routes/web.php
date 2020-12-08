<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

//مدير عام  
Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');

Route::middleware('admin')->prefix('admin/')->group(function () {
    Route::resource('restaurants','ControlPanel\AdminRestaurantController'); 
    Route::get('showGroups/{id}','ControlPanel\AdminRestaurantController@showGroups'); 
    Route::post('storeGroup/{id}','ControlPanel\AdminRestaurantController@storeGroup'); 
    Route::post('activeRest/{id}','ControlPanel\AdminRestaurantController@activeRest');
    Route::resource('PricingGroup','ControlPanel\PricingGroupController'); 
    Route::resource('admin/groups','ControlPanel\GroupController'); 
    Route::post('admin/activeGroup/{id}','ControlPanel\GroupController@activeGroup');
    
    
    Route::resource('support','ControlPanel\AdminSupportController'); 
    Route::post('activeSupport/{id}','ControlPanel\AdminSupportController@activeSupport'); 
    Route::post('deleteOrder/{id}','ControlPanel\AdminSupportController@deleteOrder'); 
    Route::post('delayOrder/{id}','ControlPanel\AdminSupportController@delayOrder'); 
    Route::get('TrackingOrder/{id}','ControlPanel\AdminSupportController@TrackingOrder');
    
    
    Route::resource('districts','ControlPanel\DistrictController'); 
    Route::resource('cities','ControlPanel\cityController');
        
    Route::resource('delegats','ControlPanel\DelegateController');
    Route::post('activeDelegate/{id}','ControlPanel\DelegateController@activeDelegate'); 
        
    Route::resource('orders','ControlPanel\OrderController'); 
        
    Route::resource('users','ControlPanel\userController'); 
    Route::post('activeUser/{id}','ControlPanel\userController@activeUser'); 
        
    Route::resource('offers','ControlPanel\OfferController'); 
    Route::post('offer','ControlPanel\OfferController@removeOffer'); 
        
    Route::resource('settings','ControlPanel\SettingController'); 
       
    Route::resource('reports','ControlPanel\ReportController'); 
    Route::resource('restaurantsReport','ControlPanel\restaurantsReportController');  
    Route::resource('delegatsReport','ControlPanel\delegatsReportController'); 
    Route::resource('restDetailedReport','ControlPanel\RestDetailedReportController');  
    Route::resource('delegateDetailedReport','ControlPanel\DelegateDetailedReportController');
    Route::resource('cityOrdersReport','ControlPanel\CityOrdersReportController');  
    Route::resource('destrictOrdersReport','ControlPanel\DestrictOrdersReportController');  
    Route::resource('bestSellingRestaurant','ControlPanel\BestSellingRestaurantController'); 
    Route::resource('agentsInteract','ControlPanel\AgentsInteractController');
    
    Route::resource('requestedCities','ControlPanel\RequestedCitiesController');
    Route::resource('requestedDistricts','ControlPanel\RequestedDistrictsController');
    Route::resource('restsReport','ControlPanel\ffController');
    Route::resource('delgReport','ControlPanel\dfController');
});

// مدير دعم فني 
Route::get('/home', 'HomeController@index')->name('home')->middleware('support'); 
Route::middleware('support')->group(function (){
    Route::resource('support','ControlPanel\supportController'); 
    Route::post('activeSupport/{id}','ControlPanel\supportController@activeSupport'); 
    Route::post('deleteOrder/{id}','ControlPanel\supportController@deleteOrder'); 
    Route::post('delayOrder/{id}','ControlPanel\supportController@delayOrder'); 
    Route::get('TrackingOrder/{id}','ControlPanel\supportController@TrackingOrder'); 
}); 
    
// مدير دانشاء مطاعم وتسعيرات 
Route::get('restaurant', 'HomeController@handleRestaurant')->name('restaurants.route')->middleware('restaurant');

Route::middleware('restaurant')->group(function () {
    Route::resource('restaurants','ControlPanel\RestController'); 
    Route::get('showGroups/{id}','ControlPanel\RestController@showGroups'); 
    Route::post('storeGroup/{id}','ControlPanel\RestController@storeGroup'); 
    Route::post('activeRest/{id}','ControlPanel\RestController@activeRest');
    Route::resource('PricingGroup','ControlPanel\PricingGroupController'); 
    
    
    Route::resource('delegats','ControlPanel\AdminDelegateController');
        Route::post('activeDelegate/{id}','ControlPanel\AdminDelegateController@activeDelegate');
});



Route::view('forgot_password', 'auth.passwords.reset')->name('password.reset');
