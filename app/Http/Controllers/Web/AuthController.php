<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otpdetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    function login(Request $request) {
        $validator = $request->validate([
            'mobile' => 'required',
            'password' => 'required'
        ]);
        
        if($request->get('mobile') && $request->get('password')) {  
            $user = User::where('mobile',$request->get('mobile'))->where('user_type',1)->where('is_active',1)->first();

            if ($user && Hash::check($request->get('password'), $user->password)) {
                $notification = array(
                    'message' => 'You are successfully login', 
                    'alert-type' => 'success'
                );  
                $request->session()->put('user',$user);
                return redirect('/dashboard')->with($notification);               
            }
            $notification = array(
                'message' => 'Invalid mobile or password', 
                'alert-type' => 'error'
            );  
            return redirect('/login')->with($notification);
        }
    }

    function logout() {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    function forgetPassword(Request $request) {
        $validator = $request->validate([
            'mobile' => 'required',
        ]);
        
        if($request->get('mobile')) {  
            $user = User::where('mobile',$request->get('mobile'))->where('user_type',1)->where('is_active',1)->first();

            if ($user) {
                sendOTP($request->get('mobile'),$request_type ='forgotpassword');
                $request->session()->put('mobile',$user->mobile);
                $request->session()->put('request_type','forgotpassword');
                $notification = array(
                    'message' => 'please verify otp', 
                    'alert-type' => 'success'
                );  
                return redirect('/verify_otp')->with($notification);               
            }
            $notification = array(
                'message' => 'Invalid mobile number', 
                'alert-type' => 'error'
            );  
            return redirect('/forget_password')->with($notification);
        }
    }

    public function verifyOTP(Request $request) {
        try {
            $validator = $request->validate([
                'otp'=> "required",
                'request_type'=> 'required'
            ]);
            
            $mobile =  $request->session()->get('mobile');
            //return $mobile;   
            $Otpdetail = Otpdetail::where('mobile',$mobile)->where('is_verified',0)->where('request_type', $request->get('request_type'))->whereRaw('verification_datetime IS NULL')->latest()->first();
            if ($Otpdetail) {
                $valid_time = Carbon::parse($Otpdetail->created_at)->addMinutes(5)->timestamp;
                $current_time = Carbon::now()->timestamp;
                if ($current_time >= $valid_time) {
                    $notification = array(
                        'message' => 'OTP is expired. Please resend otp', 
                        'alert-type' => 'error'
                    );  
                    return redirect('/verify_otp')->with($notification);
                }
                if ($Otpdetail->otp != $request->get('otp')) {
                    $notification = array(
                        'message' => 'Invalid OTP', 
                        'alert-type' => 'error'
                    );  
                    return redirect('/verify_otp')->with($notification);
                }
                $Otpdetail->is_verified = 1;
                $Otpdetail->verification_datetime = Carbon::now();
                $Otpdetail->save();

                return redirect('/reset_password');                
            }
            $notification = array(
                'message' => 'Invalid OTP', 
                'alert-type' => 'error'
            );  
            return redirect('/verify_otp')->with($notification);
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function reSendOTP(Request $request) {
        try {

            $mobile =  $request->session()->get('mobile');
            $request_type =  $request->session()->get('request_type');
            $data = sendOTP($mobile,$request_type);
            $notification = array(
                'message' => 'Otp is sned successfully. Please verify otp with your registerd mobile number.', 
                'alert-type' => 'success'
            );  
            return redirect('/verify_otp')->with($notification);
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function resetPassword(Request $request) {
        $validator = $request->validate([
            'new_password' => 'required|min:6|max:20',
            'conform_password' => 'required_with:new_password|same:new_password|min:6|max:20'
        ]);
        
        if($request->get('new_password') && $request->get('conform_password')) {  
            $mobile =  $request->session()->get('mobile');
            $user = User::where('mobile',$mobile)->where('user_type',1)->where('is_active',1)->first();

            if ($user) {
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                return redirect('/login');               
            }
            $notification = array(
                'message' => 'Invalid request. Please try again.', 
                'alert-type' => 'error'
            );  
            return redirect('/login')->with($notification);
        }
    }
}
