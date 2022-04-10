<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'APIToken'], function () {

    

    Route::group(['prefix' => 'user'], function () {
        Route::post('request-otp','API\AuthController@requestOtp');
        Route::post('verify-otp','API\AuthController@verifyOTP');
        Route::post('login','API\AuthController@login');
        Route::post('profile','API\AuthController@getProfile');
        Route::post('update-profile','API\AuthController@updateProfile');
        Route::post('update-avtar','API\AuthController@updateAvtar');
//        Route::post('forgot-password','API\AuthController@forgotPassword');
        Route::post('change-password','API\AuthController@changePassword');
        Route::post('user-gcm','API\AuthController@storedUserGCMId');
    });

    Route::group(['prefix' => 'pg'], function () {
        Route::post('pg-meta-data', 'API\PgController@pgMetaDeta');
        Route::post('add-pg', 'API\PgController@addPG');
        Route::post('add-pg-image', 'API\PgController@addPgImages');
        Route::post('get-pgs', 'API\PgController@getPgs1');
        Route::post('add-location', 'API\PgController@addPgLocation');
        Route::post('add-pg-detail', 'API\PgController@addPgDetail');
        Route::post('get-amenities', 'API\PgController@getAmenities');
        Route::post('add-amenities', 'API\PgController@addPgAmenites');
        Route::post('book-pg', 'API\PgBookingController@pgBooking');
        Route::post('my-pgs', 'API\PgController@getMyPgs');
        Route::post('add-favaorate', 'API\PgController@addFavaorate');
        Route::post('verify-hash-checksum', 'API\PgBookingController@verifyHsahToken');
        Route::post('update-pg-available-status', 'API\PgController@setPGAvailable');
        Route::post('my-bookings', 'API\PgBookingController@myBookings');
        Route::post('get-city-master', 'API\CiyMasterController@getCityMasterData');
        Route::post('delete-pg', 'API\PgController@deletePg');
    });
    
    Route::group(['prefix' => 'ads'], function () {
        Route::post('get-categories', 'API\AdsController@geCategories');
        Route::post('add-ads', 'API\AdsController@addAds');   
        Route::post('get-category-ads', 'API\AdsController@geCategoryAds');   
        Route::post('get-my-ads', 'API\AdsController@geMyAds');  
        Route::post('upload-menu-image', 'API\AdsController@addAdsMenuImage');  
        Route::post('get-ads-detail', 'API\AdsController@getAdsDetail');  
    });

    Route::post('get_notiication_list', 'API\PgBookingController@getNotifications');
    Route::post('send-notification', 'API\AuthController@sendPushNotification');

    Route::post('add_pg_price_detail', 'API\PgController@addPgPricingDetail');
    
    Route::post('get_property_type', 'API\PgController@getPropertyTypes');
    Route::post('get_room_type', 'API\PgController@getRoomTypes');
    Route::post('get_pgs_near', 'API\PgController@nearByPg');
    
    Route::post('send-enquiry', 'API\ContactusController@sendEnquiry');

    // coupans
    Route::post('get-coupans', 'API\CoupanController@getCoupans');
    Route::post('verified-coupan', 'API\CoupanController@checkVaildCoupan');
});
Route::post('registration','API\AuthController@registration');

Route::post('get_pincode_detail', 'API\AuthController@getPincodeDetail');
Route::post('check_mobile_exist','API\AuthController@checkIsMoboileExist');
Route::post('resend_otp','API\AuthController@reSendOTP');
Route::post('new-device','API\AuthController@registerDevice');
Route::post('token-revoke','API\AuthController@tokenRevoke');


//https://localhost/shubham/pgfinder/backup/last_backup