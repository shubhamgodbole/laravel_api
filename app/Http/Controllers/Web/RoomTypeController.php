<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
class RoomTypeController extends Controller
{
    function getRoomTypes() {
        $roomtype = RoomType::all();
        return view('roomtypes/roomtypes')->with('roomtype',$roomtype); 
    }

    function addRoomType(Request $request) {
        // return $request->all();
         $validator = $request->validate([
             'name' => 'required',
             'is_active' => 'required'
         ]);
 
         $roomtype = RoomType::where('name',$request->get('name'))->first();
         if($roomtype) {
             $notification = array(
                 'message' => $request->get('name') ." this type is already exist", 
                 'alert-type' => 'error'
             );  
 
             return redirect('/room_types/add_room_types')->with($notification);
         }
         $roomtype = new RoomType();
         $roomtype->name = $request->get('name');
         $roomtype->is_active = $request->get('is_active');
         $roomtype->save();
         
         // meta_data change
        updateMetaData();


         $notification = array(
             'message' => 'New type is add successfully', 
             'alert-type' => 'success'
         );  
         
         return redirect('room_types')->with($notification);
     }

     function editRoomType($id) {
        $roomtype = RoomType::find($id);
        return view('/roomtypes/editroomtype')->with('edit_data',$roomtype);
    }

    function updateRoomType(Request $request) {
        $validator = $request->validate([
            'name' => 'required',
            'is_active' => 'required',
            'id' => 'required'
        ]);

        $roomtype = RoomType::find($request->get('id'));

        $roomtype->name = $request->get('name');
        $roomtype->is_active = $request->get('is_active');
        $roomtype->save();
        
        // meta_data change
        updateMetaData();

        $notification = array(
            'message' => 'Room type is updated successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('room_types')->with($notification);
    }

    function changeActivationStatus($id) {
        $roomtype = RoomType::find($id);
        $roomtype->is_active = !$roomtype->is_active;
        $roomtype->save();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Room type is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/room_types')->with($notification);
    }

    function deletRoomType($id) {
        $roomtype = RoomType::find($id);
        $roomtype->delete();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Room type is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/room_types')->with($notification);
    }
}
