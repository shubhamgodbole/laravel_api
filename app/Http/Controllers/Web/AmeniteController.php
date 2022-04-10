<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ameniti;
class AmeniteController extends Controller
{
    function getAmenities() {
        $aminite = Ameniti::all();
        return view('amenitie/amenitie')->with('aminite',$aminite); 
    }

    function addAmenitie(Request $request) {
        $validator = $request->validate([
            'name' => 'required',
        ]);

        $aminite = Ameniti::where('name',$request->get('name'))->first();
        if($aminite) {
            $notification = array(
                'message' => $request->get('name') ." this amenitie is already exist", 
                'alert-type' => 'error'
            );  

            return redirect('amenities')->with($notification);
        }
        $aminite = new Ameniti();
        $aminite->name = $request->get('name');
        $aminite->is_active = $request->get('is_active');

        if($request->file('icon')) {
            $t=time();
            $file_name = $t."_icon.jpg";
            $path = $request->file('icon')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            //return $file_uri;
            $aminite->icon = $file_uri;
        }
        
        $aminite->save();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'New amenitie is add successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('amenities')->with($notification);

    }

    function editAmenitie($id) {
        $aminite = Ameniti::find($id);
        return view('/amenitie/editamenitie')->with('edit_data',$aminite);
    }

    function updateAmenitie(Request $request) {
        $validator = $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $aminite = Ameniti::find($request->get('id'));
        $aminite->name = $request->get('name');
        $aminite->is_active = $request->get('is_active');

        if($request->file('icon')) {
            $t=time();
            $file_name = $t."_icon.jpg";
            $path = $request->file('icon')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            $aminite->icon = $file_uri;
        }
        $aminite->save();

        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Amenitie is updated successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('amenities')->with($notification);

    }
    function changeActivationStatus($id) {
        $aminite = Ameniti::find($id);
        $aminite->is_active = !$aminite->is_active;
        $aminite->save();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Amenitie is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/amenities')->with($notification);
    }

    function deletAmenitie($id) {
        $aminite = Ameniti::find($id);
        $aminite->delete();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Amenitie is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/amenities')->with($notification);
    }
}
