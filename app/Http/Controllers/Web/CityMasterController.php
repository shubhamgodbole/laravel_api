<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CityMaster;
use App\Models\Pgdetail;

class CityMasterController extends Controller
{
    function getCityMasterData() {
        $citymaster = CityMaster::all();
        return view('citymaster/citymaster')->with('citymaster',$citymaster);
    }

    function addCity(Request $request) {
        $validator = $request->validate([
            'city_name' => 'required',
            'city_code' => 'required',
        ]);

        $citymaster = CityMaster::where('service_city_name',$request->get('city_name'))->first();
        if($citymaster) {
            $notification = array(
                'message' => $request->get('city_name') ." this city is already exist", 
                'alert-type' => 'error'
            );  

            return redirect('citymaster/add_city')->with($notification);
        }
        $citymaster = CityMaster::where('service_city_code',$request->get('city_code'))->first();
        if($citymaster) {
            $notification = array(
                'message' => $request->get('city_code') ." this city code is already exist", 
                'alert-type' => 'error'
            );  

            return redirect('citymaster/add_city')->with($notification);
        }
        $citymaster = new CityMaster();
        $citymaster->service_city_name = $request->get('city_name');
        $citymaster->service_city_code = $request->get('city_code');
        $citymaster->is_active = $request->get('is_active');
        $citymaster->save();
        
        // meta_data change
        updateMetaData();

        $notification = array(
            'message' => 'New city is add successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('citymaster')->with($notification);
    }

    function editCity($id) {
        $citymaster = CityMaster::find($id);
        return view('/citymaster/editcitymaster')->with('edit_data',$citymaster);
    }

    function updateCity(Request $request) {
        $validator = $request->validate([
            'city_name' => 'required',
            'city_code' => 'required',
            'id' => 'required',
        ]);

        $citymaster = CityMaster::where('service_city_name',$request->get('city_name'))->where('id','!=',$request->get('id'))->first();
        if($citymaster) {
            $notification = array(
                'message' => $request->get('city_name') ." this city is already exist", 
                'alert-type' => 'error'
            );  

            return redirect('citymaster/edit_city/'.$request->get('id'))->with($notification);
        }
        $citymaster = CityMaster::where('service_city_code',$request->get('city_code'))->where('id','!=',$request->get('id'))->first();
        if($citymaster) {
            $notification = array(
                'message' => $request->get('city_code') ." this city code is already exist", 
                'alert-type' => 'error'
            );  

            return redirect('citymaster/edit_city/'.$request->get('id'))->with($notification);
        }

        $citymaster = CityMaster::where('id',$request->get('id'))->first();
        if($request->get('is_active') == 0) {
            $pgdetail = Pgdetail::where('service_city_code',$citymaster->service_city_code)->first();
            if($pgdetail) {
                $notification = array(
                    'message' => $citymaster->service_city_code ." this city code is already assign to the pg, You can not change it.", 
                    'alert-type' => 'error'
                );  
    
                return redirect('citymaster/edit_city/'.$request->get('id'))->with($notification);
            }   
        }
        
        $citymaster->service_city_name = $request->get('city_name');
        $citymaster->service_city_code = $request->get('city_code');
        $citymaster->is_active = $request->get('is_active');
        $citymaster->save();
        
        // meta_data change
        updateMetaData();

        $notification = array(
            'message' => 'City is update successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('citymaster')->with($notification);
    }    

    function changeActivationStatus($id) {
        $citymaster = CityMaster::find($id);
        if($citymaster->is_active == 1) {
            $pgdetail = Pgdetail::where('service_city_code',$citymaster->service_city_code)->first();
            if($pgdetail) {
                $notification = array(
                    'message' => $citymaster->service_city_code ." this city code is already assign to the pg, You can not change it.", 
                    'alert-type' => 'error',
                    'status' => false
                );  
    
                return $notification;
            }   
        }
        
        $citymaster->is_active = !$citymaster->is_active;
        $citymaster->save();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'City is update successfully', 
            'alert-type' => 'success'
        );  
    
        return redirect('/citymaster')->with($notification);
    }
    
    function deletCity($id) {
        $aminite = CityMaster::find($id);
        $aminite->delete();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'City is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/citymaster')->with($notification);
    }
}
