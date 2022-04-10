<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
class PropertyTypeController extends Controller
{
    
    function getPropertyTypes() {
        $propertytype = PropertyType::all();
        return view('propertytypes/propertytypes')->with('propertytype',$propertytype); 
    }

    function addPropertyType(Request $request) {
       // return $request->all();
        $validator = $request->validate([
            'name' => 'required',
            'is_active' => 'required'
        ]);

        $propertytype = PropertyType::where('name',$request->get('name'))->first();
        if($propertytype) {
            $notification = array(
                'message' => $request->get('name') ." this type is already exist", 
                'alert-type' => 'error'
            );  

            return redirect('/property_types/add_property_types')->with($notification);
        }
        $propertytype = new PropertyType();
        $propertytype->name = $request->get('name');
        $propertytype->is_active = $request->get('is_active');
        $propertytype->save();

        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'New type is add successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('property_types')->with($notification);
    }

    function editPropertyType($id) {
        $propertytype = PropertyType::find($id);
        return view('/propertytypes/editpropertytype')->with('edit_data',$propertytype);
    }

    function updatePropertyType(Request $request) {
        $validator = $request->validate([
            'name' => 'required',
            'is_active' => 'required',
            'id' => 'required'
        ]);

        $propertytype = PropertyType::find($request->get('id'));

        $propertytype->name = $request->get('name');
        $propertytype->is_active = $request->get('is_active');
        $propertytype->save();

        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Property type is updated successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('property_types')->with($notification);
    }

    function changeActivationStatus($id) {
        $propertytype = PropertyType::find($id);
        $propertytype->is_active = !$propertytype->is_active;
        $propertytype->save();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Property type is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/property_types')->with($notification);
    }

    function deletPropertyType($id) {
        $propertytype = PropertyType::find($id);
        $propertytype->delete();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Property type is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/property_types')->with($notification);
    }
}
