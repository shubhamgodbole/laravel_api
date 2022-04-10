<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\DeviceRegistered;
use App\Models\PincodeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Otpdetail;
Use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Crypt;
class AuthController extends Controller
{
    
    function registerDevice(Request $request) {
        try {
            $element_array = array(
                'deviceUUID'=> "required",
                'deviceName'=> "required",
                'deviceOS'=> "required",
                'deviceOSVer'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $deviceRegistered = DeviceRegistered::where('deviceUUID',$request->get('deviceUUID'))->first();
            
            if($deviceRegistered) {
                return $this->sendResultJSON(false, $request->get('deviceUUID').' this deviceUUID has been already registered.');                
            }

            $token = Str::random(128);
            $hashToken = hash('sha256', $token);

            $deviceRegistered = new DeviceRegistered();
            $deviceRegistered->deviceUUID = $request->get('deviceUUID');
            $deviceRegistered->deviceName = $request->get('deviceName');
            $deviceRegistered->deviceOS = $request->get('deviceOS');
            $deviceRegistered->deviceOSVer = $request->get('deviceOSVer');
            $deviceRegistered->token = $token;
           // $deviceRegistered->token = generateAccessToken($deviceRegistered);
            $deviceRegistered->save();

            return $this->sendResultJSON(true, 'Device has been registered.',array('token'=> $deviceRegistered->token));           
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function tokenRevoke(Request $request) {
        try {
            $element_array = array(
                'deviceUUID'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $deviceRegistered = DeviceRegistered::where('deviceUUID',$request->get('deviceUUID'))->first();
            
            if(!$deviceRegistered) {
                return $this->sendResultJSON(false, 'Invalid deviceUUID.');                
            }

            $token = Str::random(128);
            $hashToken = hash('sha256', $token);
            $deviceRegistered->token = $token;
            //$deviceRegistered->token = generateAccessToken($deviceRegistered);
            $deviceRegistered->save();

            return $this->sendResultJSON(true, 'The token revoked successfully.',array('token'=> $deviceRegistered->token));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function requestOtp(Request $request) {
        try {
            $element_array = array(
                'mobile' => 'required|numeric|digits:10',
                'request_type'=> 'required',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            if($request->get('request_type') == config('constants.request_type')['Registration']) {
                $user = User::where('mobile',$request->get('mobile'))->where('is_mobile_verified',1)->first();
                if($user) {
                    return $this->sendResultJSON(false, __($request->get('mobile') ." this mobile is already registerd"));
                }
                if($request->get('user_type') == config('constants.user_type')['admin']) {
                    return $this->sendResultJSON(false, __("invalid user type"));
                }
                if(!$request->get('password')) {
                    return $this->sendResultJSON(false, __("Password field is required."));                    
                }
                if(!$request->get('user_type')) {
                    return $this->sendResultJSON(false, __("User type field is required."));                    
                }
                
                $user = User::where('mobile',$request->get('mobile'))->latest()->first();
                if($user) {
                    $user->delete();
                }
                $user = new User();
                $user->mobile = $request->get('mobile');
                $user->password = bcrypt($request->get('password'));
                $user->user_type = $request->get('user_type');
                $user->country_code = $request->get('country_code');

                $user->save();
            }
            $data = sendOTP($request->get('mobile'),$request_type = $request->get('request_type'));

            return $this->sendResultJSON(true, __("Otp has been sent successfully."));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    public function verifyOTP(Request $request) {
        try {
            $element_array = array(
                'mobile'=> "required|numeric|digits:10",
                'otp'=> "required",
                'request_type'=> 'required'
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $Otpdetail = Otpdetail::where('mobile',$request->get('mobile'))->where('is_verified',0)->where('request_type', $request->get('request_type'))->whereRaw('verification_datetime IS NULL')->latest()->first();
           //$Otpdetail = Otpdetail::where('mobile',$request->get('mobile'))->where('is_verified',0)->whereRaw('verification_datetime IS NULL')->latest()->first();
            if ($Otpdetail) {
                $valid_time = Carbon::parse($Otpdetail->created_at)->addMinutes(5)->timestamp;
                $current_time = Carbon::now()->timestamp;
                if ($current_time >= $valid_time) {
                    return $this->sendResultJSON(false, __('otp expired'));
                }
                if ($Otpdetail->otp != $request->get('otp')) {
                    return $this->sendResultJSON(false, __('invalid otp'));
                }
                $Otpdetail->is_verified = 1;
                $Otpdetail->verification_datetime = Carbon::now();
                $Otpdetail->save();

                if($request->get('request_type') == config('constants.request_type')['Registration']) {
                    $user = User::where('mobile',$request->get('mobile'))->first();
                    $user->is_mobile_verified = 1;
                    $user->is_active = 1;
                    $user->referral_code = generateReferralCode();
                    $user->save();
                    
                    if($request->get('referral_code')) {

                        $owner = User::where('referral_code',$request->get('referral_code'))->first();
                        $referrerAndEarn = ReferrerAndEarn::where('is_active',1)->first();
                        if($referrerAndEarn) {
                            pushNotificationAndroid([
                                'to_userid'=>$owner->id,
                                'from_userid'=> '',
                                'pg_id'=> '',
                                'type'=>'NEW_REGISTRATION_BY_REFERREL_CODE',
                                'notification_title'=> 'Remind your friend to transact on PayPgRoom',
                                'notification_text'=> 'Your friend '. $user->first_name .' '.  $user->last_name .' has installed PayPgRoom app. You will get ₹'.$referrerAndEarn->creater_amount.' when your friend completes his first payment on PayPgRoom.' , 
                                'device_id'=> $owner->gcm_subscription_id
                            ]);
                            pushNotificationAndroid([
                                'to_userid'=>$user->id,
                                'from_userid'=> '',
                                'pg_id'=> '',
                                'type'=>'NEW_REGISTRATION_BY_REFERREL_CODE',
                                'notification_title'=> "Don't forget your ₹". $referrerAndEarn->receiver_amount ." referral bonus",
                                'notification_text'=> "Make your first payment on PayPgRoom and You'll get ₹". $referrerAndEarn->receiver_amount ." and help your referrer earn ₹".$referrerAndEarn->creater_amount, 
                                'device_id'=> $user->gcm_subscription_id
                            ]);
                        }
                    }
                }
                return $this->sendResultJSON(true, __("otp is verified successfully"));
                
            }
            return $this->sendResultJSON(false, __("Invalid otp"));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function login(Request $request) {
        try {
            $element_array = array(
                'mobile'=> "required|numeric|digits:10",
                'password'=> "required"
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('mobile',$request->get('mobile'))->where('user_type','!=',config('constants.user_type')['admin'])->where('is_active',1)->first();

            if ($user && Hash::check($request->get('password'), $user->password)) {
           
//                sendOTP($request->get('mobile'),$request_type ='login');

                return $this->sendResultJSON(true, __("Login successfully."),array('user'=> $user));
                
            } else {
                return $this->sendResultJSON(false, __("invalid credientials"));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function getProfile(Request $request) {
        try {
            $element_array = array(
                'user_id'=> "required"
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('id',$request->get('user_id'))->first();

            if ($user) {
                // if($user->email) {
                //     sendMail(['send_to_email'=> $user->email, 'type'=>'REGISTRATION','data_to_replace'=>array('{owner_name}'=>$user->first_name.' '. $user->last_name)]);
                // }
                return $this->sendResultJSON(true, __("User profile fetch successfully."),array('user'=> $user));
                
            } else {
                return $this->sendResultJSON(false, __("invalid user"));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function updateProfile(Request $request) {
        try {
            $element_array = array(
                'user_id'=> 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('id',$request->get('user_id'))->first();

            if ($user) {
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->email = $request->get('email');
                $user->gender = $request->get('gender');
                $user->dob = $request->get('dob');
                $user->save();
                
                
                return $this->sendResultJSON(true, __("User profile update successfully."),array('user'=> $user));
            } else {
                return $this->sendResultJSON(false, __("invalid user"));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }


    function updateAvtar(Request $request) {
        try {
            $element_array = array(
                'user_id'=> 'required',
                'avatar' => 'required|file|max:2048|mimes:jpg,jpeg,png,svg,bmp,gif,webp'
                
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('id',$request->get('user_id'))->first(); 

            if ($user) {

                $t=time();
                $file_name = $t."_profile.jpg";
                $path = $request->file('avatar')->move(public_path("/image/"),$file_name);
                $file_uri = url('/public/image/'.$file_name);
                $user->profile = $file_uri;
                $user->save();
                return $this->sendResultJSON(true, __("Avatar has been updated."),array('user'=> $user));
            } else {
                return $this->sendResultJSON(false, __("Unable to find user"));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function forgotPassword(Request $request) {
        try {
            $element_array = array(
                'mobile'=> 'required|numeric|digits:10'
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('mobile',$request->get('mobile'))->where('is_active',1)->first();

            if ($user) {
                sendOTP($request->get('mobile'),$request_type ='ForgotPassword');
                return $this->sendResultJSON(true, __("Otp sent successfully. Please verify otp with your registerd mobile number."));
            } else {
                return $this->sendResultJSON(false, __("invalid user"));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function changePassword(Request $request) {
        try {
            $element_array = array(
                'mobile'=> 'required|numeric|digits:10',
                'new_password' => 'required|min:6|max:20',
                'conform_password' => 'required_with:new_password|same:new_password|min:6|max:20'
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('mobile',$request->get('mobile'))->where('is_active',1)->first();

            if ($user) {
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                return $this->sendResultJSON(true, __("Your password has been changed."));
            } else {
                return $this->sendResultJSON(false, __("invalid user"));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function registration(Request $request) {
        try { 
            $element_array = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile' => 'required|min:10|max:10',
                'gender' => 'required',
                'user_type' => 'required',
                'password' => 'required|min:6|max:10',
                'pincode' => 'required',
                'district' => 'required',
                'state' => 'required',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            if($request->get('user_type') == config('constants.user_type')['admin']) {
                return $this->sendResultJSON(false, __("invalid user type"));
            }
            $user = User::where('mobile',$request->get('mobile'))->first();
            if($user) {
                return $this->sendResultJSON(false, __($request->get('mobile') ." this mobile is already registerd"));
            }

            if($request->get('user_type') == config('constants.user_type')['owner'] && !$request->get('profit')) {
                return $this->sendResultJSON(false, __("profit field is requird"));
            }

            sendOTP($request->get('mobile'),$request_type ='registration');
            
            $user = new User();
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email') ? $request->get('email') : '';
            $user->mobile = $request->get('mobile');
            $user->gender = $request->get('gender');
            $user->user_type = $request->get('user_type');
            if($request->get('user_type') == config('constants.user_type')['owner']) {
                $user->profit = $request->get('profit');
            }
            $user->password = bcrypt($request->get('password'));
    
            if($request->file('profile')) {
                $t=time();
                $file_name = $t."_profile.jpg";
                $path = $request->file('profile')->move(public_path("/image/"),$file_name);
                $file_uri = url('/public/image/'.$file_name);
                $user->profile = $file_uri;
            }

            $address = new Address();
            $address->line1 = $request->get('line1');
            $address->line2 = $request->get('line2');
            $address->city = $request->get('city');
            $address->taluka = $request->get('taluka');
            $address->pincode = $request->get('pincode');
            $address->district = $request->get('district');
            $address->state = $request->get('state');
            $address->save();
    
            $user->address_id = $address->id;
            $user->save();

            return $this->sendResultJSON(true, __("Your registration process is completed. Please verify otp with your registerd mobile number."));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    
    
    function getPincodeDetail(Request $request) {
        try {
            $element_array = array(
                'pincode'=> 'required|min:6|max:6',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $pincodeDetail = PincodeDetail::where('pincode',$request->get('pincode'))->first();
            if ($pincodeDetail) {
                return $this->sendResultJSON(true, __("Fetch pincode detail succssfully"), $pincodeDetail);     
            }
            return $this->sendResultJSON(false, __("Invalid pincode"));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }

    }

    function checkIsMoboileExist(Request $request) {
        try {
            $element_array = array(
                'mobile' => 'required|min:10|max:10',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $user = User::where('mobile',$request->get('mobile'))->first();
            if($user) {
                return $this->sendResultJSON(false, __($request->get('mobile') ." this mobile is already registerd"));
            }
            return $this->sendResultJSON(true, __("mobile number is valid"));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }

    }
    
    function storedUserGCMId(Request $request) {
        try {
            $element_array = array(
                'gcm_id' => 'required',
                'user_id' => 'required',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }            
            
            $user = User::where('id',$request->get('user_id'))->first();
            if($user) {
                $user->gcm_subscription_id = $request->get('gcm_id');
                $user->save();
                return $this->sendResultJSON(true, __("User GCM ID saved."));
            }
            
            return $this->sendResultJSON(false, __("Invalid user id."));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    function sendPushNotification(Request $request) {
        try {
            
            $element_array = array(
                'device_id' => 'required',
                'user_id' => 'required',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            pushNotificationAndroid($request->get('device_id'),$request->get('user_id'),'this is test push notification');
            
            return $this->sendResultJSON(true, __("Push notification send successfully."));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
}
