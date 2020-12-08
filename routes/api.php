<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api','checkPassword'] ], function () {

    //Restaurants apis
    Route::post('getAllRestaurants', 'Api\RestaurantController@index');

    Route::group(['prefix' => 'restaurant'],function (){
        Route::post('login', 'Api\AuthRestaurantController@login');
        Route::post('password/email', 'Api\ForgotPasswordController@forgot');
        Route::post('password/reset', 'Api\ForgotPasswordController@reset');
        Route::group(['middleware' => ['checkRestaurantToken::restaurant-api']], function () {
            Route::post('getRestaurantByID', 'Api\RestaurantController@show');
            Route::post('newOrder', 'Api\OrderController@createOrder');
            Route::post('confirmOrder', 'Api\OrderController@storeOrder');
            Route::post('orderTracking', 'Api\OrderController@orderTracking');
            Route::post('allOrders', 'Api\OrderController@restOrders');
            Route::post('getOrderByID', 'Api\OrderController@show');

            Route::post('requestTechnicalSupport', 'Api\TechnicalSupportController@requestTechnicalSupport');
            Route::post('orderNotification', 'Api\OrderController@notification');
                       

        });
    });

    //Delegates apis
    Route::group(['prefix' => 'delegate'],function (){
        Route::post('login', 'Api\AuthDelegateController@login');
        Route::post('delegateForgot', 'Api\ForgotPasswordController@delegateForgot');
        Route::group(['middleware' => ['checkDelegateToken::delegate-api']], function () {

            Route::post('availableOrdersDelivery','Api\DelegateController@AvailableOrdersDelivery');
            Route::post('allMyOrders','Api\DelegateController@allMyOrders');
            Route::post('fillterMyOrders','Api\DelegateController@fillterMyOrders');
            Route::post('myOrdersOnDelivery','Api\DelegateController@myOrdersOnDelivery');
            Route::post('orderDetails', 'Api\DelegateController@OrderDetails');
            Route::post('startDelivery', 'Api\DelegateController@startDelivery');
            Route::post('notification', 'Api\DelegateController@notification');
            Route::post('chooseOrder', 'Api\DelegateController@chooseOrder');
            Route::post('finishRequest', 'Api\DelegateController@finishRequest');
            Route::post('myOrderDetails', 'Api\DelegateController@myOrderDetails');
            Route::post('myNotify', 'Api\NotificationController@getNotifications');
            Route::post('requestDelegateTechnicalSupport', 'Api\TechnicalSupportController@requestDelegateTechnicalSupport');
            Route::post('wallet', 'Api\walletController@addToWallet');
                              
        });
    });

});