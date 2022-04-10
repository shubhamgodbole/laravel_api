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
    return view('login');
});
Route::group(['middleware'=>'revalidate'], function() {
    Route::get('/', function () {
        return redirect('login');
    });
    Route::get('/login', function () {
        return view('login');
    });
    Route::get('/signup', function () {
        return view('registration');
    });
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // });
    Route::post('/check_login', 'Web\AuthController@login');
    Route::get('/logout', 'Web\AuthController@logout');

    // User Routes
    Route::get('/users', 'Web\UserController@getUser');
    Route::get('/users/add_user', function () {
        return view('users/addUser');
    });
    Route::post('/users/addUser', 'Web\UserController@addUser');
    Route::get('/users/edit_user/{id}', 'Web\UserController@editUser');
    Route::post('/users/updateUser', 'Web\UserController@updateUser');
    Route::get('/users/deleteUser/{id}', 'Web\UserController@deleteUser');
    Route::get('/users/changeActivationStatus/{id}', 'Web\UserController@changeActivationStatus');
    Route::get('/users/pincode_details/{id}', 'Web\UserController@getPincodeDetails');

    Route::get('/pg_owners', 'Web\UserController@getPgOwners');
    Route::get('/pg_owners/add_owner', function () {
        return view('pgowners/addpg_owner');
    });
    Route::post('/pg_owners/addOwner', 'Web\UserController@addUser');

    Route::get('/tenants', 'Web\UserController@getTenants');
    Route::get('/tenants/add_tenant', function () {
        return view('tenants/addtenant');
    });
    Route::post('/tenants/addTenant', 'Web\UserController@addUser');

    Route::get('/admin_users', 'Web\UserController@getAdmins');

    Route::get('/amenities', 'Web\AmeniteController@getAmenities');
    Route::get('/amenities/add_amenitie', function () {
        return view('amenitie/addamenitie');
    });
    Route::post('/amenities/addAmenitie', 'Web\AmeniteController@addAmenitie');
    Route::get('/amenities/changeActivationStatus/{id}', 'Web\AmeniteController@changeActivationStatus');
    Route::get('/amenities/edit_amenitie/{id}', 'Web\AmeniteController@editAmenitie');
    Route::post('/amenities/updateAmenitie', 'Web\AmeniteController@updateAmenitie');
    Route::get('/amenities/deletAmenitie/{id}', 'Web\AmeniteController@deletAmenitie');

    Route::get('/property_types', 'Web\PropertyTypeController@getPropertyTypes');
    Route::get('/property_types/add_property_types', function () {
        return view('propertytypes/addpropertytype');
    });
    Route::post('/property_types/addPropertyType', 'Web\PropertyTypeController@addPropertyType');
    Route::get('/property_types/edit_property_type/{id}', 'Web\PropertyTypeController@editPropertyType');
    Route::post('/property_types/updatePrpertyType', 'Web\PropertyTypeController@updatePropertyType');
    Route::get('/property_types/deletPropertyType/{id}', 'Web\PropertyTypeController@deletPropertyType');
    Route::get('/property_types/changeActivationStatus/{id}', 'Web\PropertyTypeController@changeActivationStatus');


    Route::get('/room_types', 'Web\RoomTypeController@getRoomTypes');
    Route::get('/room_types/add_room_types', function () {
        return view('roomtypes/addroomtype');
    });
    Route::post('/room_types/addRoomType', 'Web\RoomTypeController@addRoomType');
    Route::get('/room_types/edit_room_type/{id}', 'Web\RoomTypeController@editRoomType');
    Route::post('/room_types/updateRoomType', 'Web\RoomTypeController@updateRoomType');
    Route::get('/room_types/deletRoomType/{id}', 'Web\RoomTypeController@deletRoomType');
    Route::get('/room_types/changeActivationStatus/{id}', 'Web\RoomTypeController@changeActivationStatus');
    // PGs Routes
    Route::get('/pges', 'Web\PgController@getPgs');
    Route::get('/pges/pg_detail/{id}', 'Web\PgController@pgDetail');
    Route::get('/pges/changeActivationStatus/{id}', 'Web\PgController@changeActivationStatus');
    Route::get('/pges/changeIsRecommendedStatus/{id}', 'Web\PgController@changeIsRecommendedStatus');

    Route::get('/pg_bookings', 'Web\PgBookingController@getBookings');
    Route::get('/pg_bookings/pg_booking_detail/{id}', 'Web\PgBookingController@getBookingDetail');
    Route::get('/security_diposits', 'Web\PgBookingController@getSecurityDeposits');
    Route::get('/security_diposits/edit_security_diposits/{id}', 'Web\PgBookingController@editSecurityDeposits');
    Route::post('/security_diposits/updateSecurityDeposits', 'Web\PgBookingController@updateSecurityDeposits');
    Route::get('pges/update_pg/{id}','Web\PgController@pgUpdateView');
    Route::post('/pges/update_pg_detail','Web\PgController@UpdatePGDetail');
    Route::get('pges/find_amenity/{id}','Web\PgController@findAmenity');
    Route::post('pges/add_pg_amenity','Web\PgController@addPGAmenity');
    Route::get('pges/delete_amenity','Web\PgController@removeAmenity');
    Route::post('pges/update_pg_pricedetail','Web\PgController@updatePGPriceDetail');
    Route::get('pges/delete_pgimage','Web\PgController@deletePGImage');
    Route::post('pges/add_pg_image','Web\PgController@addPGImage');

    // Category
    Route::get('/categories', 'Web\CategoryController@getCategory');
    Route::get('/categories/add_category', function () {
        return view('category/addcategory');
    });
    Route::post('/categories/addCategory', 'Web\CategoryController@addCategory');
    Route::get('/category/edit_category/{id}', 'Web\CategoryController@editCategory');
    Route::post('/category/updateCategory', 'Web\CategoryController@updateCategory');
    Route::get('/category/deletAmenitie/{id}', 'Web\CategoryController@deletCategory');

    // Ads
    Route::get('/ads', 'Web\AdsController@getAds');
    Route::get('/ads/add_ads', 'Web\AdsController@add_ads');
    Route::post('/ads/addAds', 'Web\AdsController@addAds');
    Route::get('/ads/edit_ads/{id}', 'Web\AdsController@editAds');
    Route::post('/ads/updateAds', 'Web\AdsController@updateAds');
    Route::get('/ads/deletAds/{id}', 'Web\AdsController@deletAds');
    Route::get('/ads/changeRecommandedStatus/{id}', 'Web\AdsController@changeRecommandedStatus');
    Route::get('/ads/changeActivationStatus/{id}', 'Web\AdsController@changeActivationStatus');
    
    
    Route::get('forget_password', function () {
        return view('forgotpassword');
    });
    Route::post('/forgotPassword', 'Web\AuthController@forgetPassword');
    Route::get('verify_otp', function () {
        return view('verifyotp');
    });
    Route::post('/verifyOTP', 'Web\AuthController@verifyOTP');
    Route::get('/resendOTP', 'Web\AuthController@reSendOTP');

    Route::get('reset_password', function () {
        return view('resetpassword');
    });
    Route::post('/resetPassword', 'Web\AuthController@resetPassword');

    Route::get('/discounts', 'Web\DiscountController@getDiscounts');    
    Route::get('/discounts/edit_discount/{id}', 'Web\DiscountController@editDiscount');
    Route::post('/discounts/updateDiscount', 'Web\DiscountController@updateDiscount');


    Route::get('/dashboard', 'Web\DashboardController@getDashboardData');
    
        // city master
    Route::get('/citymaster', 'Web\CityMasterController@getCityMasterData');
    Route::get('/citymaster/add_city', function () { return view('citymaster/addcity'); });
    Route::post('/citymaster/addCity', 'Web\CityMasterController@addCity');
    Route::get('/citymaster/edit_city/{id}', 'Web\CityMasterController@editCity');
    Route::post('/citymaster/updateCity', 'Web\CityMasterController@updateCity');
    Route::get('/citymaster/changeActivationStatus/{id}', 'Web\CityMasterController@changeActivationStatus');
    Route::get('/citymaster/delete_city/{id}', 'Web\CityMasterController@deletCity');

    // email template
    Route::get('/emailtemplates', 'Web\EmailTemplateController@getEmailTemplates');
    Route::get('/emailtemplates/edit_template/{id}', 'Web\EmailTemplateController@editEmailTemplate');
    Route::post('/emailtemplates/updateEmailTemplate', 'Web\EmailTemplateController@updateEmailTemplate');
    Route::get('/emailtemplates/sendemail', function () { return view('emailtemplates/sendemailform'); });
    Route::post('/emailtemplates/sendEmail', 'Web\EmailTemplateController@sendEmail');
    
        // enquiries
    Route::get('/getenquiries', 'Web\ContactusController@getEnquiries');
    Route::get('/getenquiries/delete_enquiry/{id}', 'Web\ContactusController@deletEnquiry');

    // cancellation policy
    Route::get('/cancellation_policy', 'Web\CancellationPolicyController@getPolicy');
    Route::get('/cancellation_policy/edit_policy/{id}', 'Web\CancellationPolicyController@editPolicyView');
    Route::post('/cancellation_policy/update_policy', 'Web\CancellationPolicyController@updatePolicy');


    // coupans
    Route::get('/coupans', 'Web\CoupanController@getCoupans');
    Route::get('/coupans/add_coupan', function () { return view('coupans/addcoupan'); });
    Route::post('/coupans/addCoupan', 'Web\CoupanController@addCoupan');
    Route::get('/coupans/changeActivationStatus/{id}', 'Web\CoupanController@changeActivationStatus');
    Route::get('/coupans/edit_coupan/{id}', 'Web\CoupanController@editCoupanView');
    Route::post('/coupans/updateCoupan', 'Web\CoupanController@updateCoupan');
    Route::get('/coupans/delete_coupan/{id}', 'Web\CoupanController@deleteCoupan');
    
        // referrer and earns
    Route::get('/refer_and_earn', 'Web\ReferrerAndEarnController@getReferrerRules');
    Route::get('/refer_and_earn/add_rule', function () { return view('referrerandearn/addrule'); });
    Route::post('/refer_and_earn/addRule', 'Web\ReferrerAndEarnController@addRule');
    Route::get('/refer_and_earn/edit_rule/{id}', 'Web\ReferrerAndEarnController@editRule');
    Route::post('/refer_and_earn/updateRule', 'Web\ReferrerAndEarnController@updateRule');
    Route::get('/refer_and_earn/changeActivationStatus/{id}', 'Web\ReferrerAndEarnController@changeActivationStatus');
    Route::get('/refer_and_earn/delete_rule/{id}', 'Web\ReferrerAndEarnController@deletRule');

    // notification
    Route::get('/send_notification', function () { return view('sendnotification/sendnotification'); });
    Route::post('/sendNotification', 'Web\NotificationController@sendNotification');
    
    
    Route::get('welcome', function () {
        return view('welcome');
    });
    Route::get('latlong', function () {
        return view('latlong');
    });
    Route::post('/getLatLong', 'Web\UserController@getLatLong');
});
