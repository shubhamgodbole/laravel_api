<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PincodeDetail;
use Illuminate\Http\Request;
Use App\Models\Address;
use App\Models\User;
use URL;

class UserController extends Controller
{
    function getUser() {
        $user = User::where('user_type','!=',config('constants.user_type')['admin'])->with('address')->get();
        //$user = User::all();
        return view('users/users')->with('users',$user); 
    }

    function getPgOwners() {
        $user = User::where('user_type',config('constants.user_type')['owner'])->with('address')->get();
        //$user = User::all();
        return view('pgowners/pgowners')->with('users',$user); 
    }

    function getTenants() {
        $user = User::where('user_type',config('constants.user_type')['tenant'])->with('address')->get();
        //$user = User::all();
        return view('tenants/tenants')->with('users',$user); 
    }

    function getAdmins() {
        $user = User::where('user_type',config('constants.user_type')['admin'])->with('address')->get();
        //$user = User::all();
        return view('adminusers/admin_users')->with('users',$user); 
    }

    function getPincodeDetails($pincode) {
        $pincodeData = PincodeDetail::where('pincode',$pincode)->first();
        return $pincodeData;
    }
    function addUser(Request $request) {

        //return $request->all();
        $validator = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|min:10|max:10',
            'gender' => 'required',
            'user_type' => 'required',
            'password' => 'required|min:6|max:20',
            // 'pincode' => 'required',
            // 'district' => 'required',
            // 'state' => 'required',
            'dob' => 'required'
        ]);

        $user = User::where('mobile',$request->get('mobile'))->first();
        if($user) {
            $notification = array(
                'message' => $request->get('mobile') ." this mobile is already registerd", 
                'alert-type' => 'error'
            );  
            if($request->get('user_type') == config('constants.user_type')['owner']) {
                return redirect('pg_owners/add_owner')->with($notification);
            }
            else if($request->get('user_type') == config('constants.user_type')['tenant']) {
                return redirect('tenants/add_tenant')->with($notification);
            }
            else {
                return redirect('pg_owners/users')->with($notification);
            }
        }
        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->mobile = $request->get('mobile');
        $user->gender = $request->get('gender');
        $user->dob = $request->get('dob');
        $user->user_type = $request->get('user_type');
        $user->profit = $request->get('profit');
        $user->password = bcrypt($request->get('password'));
        $user->is_active = 1;
        $user->referral_code = generateReferralCode();
        if($request->file('profile')) {
            $t=time();
            $file_name = $t."_profile.jpg";
            $path = $request->file('profile')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            $user->profile = $file_uri;
        }

        // $address = new Address();
        // $address->line1 = $request->get('line1');
        // $address->line2 = $request->get('line2');
        // $address->city = $request->get('city');
        // $address->taluka = $request->get('taluka');
        // $address->pincode = $request->get('pincode');
        // $address->district = $request->get('district');
        // $address->state = $request->get('state');
        // $address->save();

        // $user->address_id = $address->id;
        $user->save();


        $notification = array(
            'message' => 'New user is add successfully', 
            'alert-type' => 'success'
        );  
        if($request->get('user_type') == config('constants.user_type')['owner']) {
            return redirect('pg_owners')->with($notification);
        }
        else if($request->get('user_type') == config('constants.user_type')['tenant']) {
            return redirect('tenants')->with($notification);
        }
        else {
            return redirect('pg_owners/users')->with($notification);
        }
    }


    function editUser($id) {
        $user = User::find($id);
        // $address = Address::find($user->address_id);
        // $user->line1 = $address->line1;
        // $user->line2 = $address->line2;
        // $user->city = $address->city;
        // $user->taluka = $address->taluka;
        // $user->pincode = $address->pincode;
        // $user->district = $address->district;
        // $user->state = $address->state;
        
        if($user->user_type == config('constants.user_type')['owner']) {
            return view('/pgowners/editpg_owner')->with('edit_data',$user);
        }
        else if($user->user_type == config('constants.user_type')['tenant']) {
            return view('/tenants/edit_tenant')->with('edit_data',$user);
        }
        else {
            return view('/users/editUser')->with('edit_data',$user);
        }
        //return view('/users/editUser')->with('edit_data',$user);
    }

    function updateUser(Request $request) {
        //try {
            $validator = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                 //'email' => 'required',
                 'mobile' => 'required',
                'gender' => 'required',
                'user_type' => 'required',
                // 'password' => 'required',
                // 'profile' => 'required',
                // 'pincode' => 'required',
                // 'district' => 'required',
                // 'state' => 'required',
                'dob' => 'required',
            ]);

            $user = User::find($request->get('id'));
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->mobile = $request->get('mobile');
            $user->gender = $request->get('gender');
            $user->dob = $request->get('dob');
            $user->profit = $request->get('profit');
            $user->user_type = $request->get('user_type');
          //  $user->is_active = $request->get('is_active');
            $user->save();

            // $address = Address::find($user->address_id);
            // $address->line1 = $request->get('line1');
            // $address->line2 = $request->get('line2');
            // $address->city = $request->get('city');
            // $address->taluka = $request->get('taluka');
            // $address->pincode = $request->get('pincode');
            // $address->district = $request->get('district');
            // $address->state = $request->get('state');
            // $address->save();
            
            $notification = array(
                'message' => 'User is update successfully', 
                'alert-type' => 'success'
            );  
            
            if($request->get('user_type') == config('constants.user_type')['owner']) {
                return redirect('pg_owners')->with($notification);
            }
            else if($request->get('user_type') == config('constants.user_type')['tenant']) {
                return redirect('tenants')->with($notification);
            }
            else {
                return redirect('users')->with($notification);
            }
            //return redirect('/users')->with($notification);
        // }
        // catch (\Exception $e) {
        //     $notification = array(
        //         'message' => $e->getMessage(), 
        //         'alert-type' => 'error'
        //     );  
        //     return URL::current(); // redirect($request->path)->with($notification);
        //     }
    }


    function deleteUser($id) {
            $user = User::find($id);
            $user->delete();
            $notification = array(
                'message' => 'User is deleted successfully', 
                'alert-type' => 'success'
            );  
            return redirect('/users')->with($notification);
    }

    function changeActivationStatus($id) {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        $notification = array(
            'message' => 'User is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/users')->with($notification);
    }

    function getLatLong(Request $request)
    {
        $address = $request->get('address');
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        return $geocode;
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
    }


}
