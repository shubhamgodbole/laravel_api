<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupan;
use Validator;
class CoupanController extends Controller
{
    function getCoupans() {
        $coupans = Coupan::all();
        return view('coupans/coupans')->with('coupans',$coupans);
    }

    function addCoupan(Request $request) {
        $element_array = array(
            'coupan_code' => 'required|unique:coupans,coupan_code',
            'start_date' => 'required',
            'discount_percentage' => 'required',
            'minimum_transaction_amount' => 'required',
            'maximum_discount_amount' => 'required',
        );

        $validator = Validator::make($request->all(), $element_array);

        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(), 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $coupans = new Coupan();        
        $coupans->coupan_code = $request->get('coupan_code');
        $coupans->discount_percentage = $request->get('discount_percentage');
        $coupans->minimum_transaction_amount = $request->get('minimum_transaction_amount');
        $coupans->maximum_discount_amount = $request->get('maximum_discount_amount');
        $coupans->start_date = $request->get('start_date');
        $coupans->end_date = $request->get('end_date');
        $coupans->description = $request->get('description');
        $coupans->is_active = $request->get('is_active');
        $coupans->save();

        $notification = array(
            'message' => 'Coupan added successfully', 
            'alert-type' => 'success'
        );
        return redirect('coupans')->with($notification);
    }

    function editCoupanView($id) {
        $coupans = Coupan::find($id);
        $notification = array(
            'message' => 'Coupan added successfully', 
            'alert-type' => 'success'
        );
        return view('coupans/editcoupan')->with('edit_data',$coupans);
    } 

    function updateCoupan(Request $request) {
        $element_array = array(
            'coupan_code' => 'required',
            'start_date' => 'required',
            'discount_percentage' => 'required',
            'minimum_transaction_amount' => 'required',
            'maximum_discount_amount' => 'required',
            'id' => 'required',
        );

        $validator = Validator::make($request->all(), $element_array);

        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(), 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $coupans = Coupan::where('coupan_code',$request->get('coupan_code'))->where('id','!=',$request->get('id'))->first();
        if($coupans) {
            $notification = array(
                'message' => 'Coupan code is already exist', 
                'alert-type' => 'error'
            );
            return redirect('coupans')->with($notification);            
        }
        $coupans = Coupan::find($request->get('id'));
        $coupans->coupan_code = $request->get('coupan_code');
        $coupans->discount_percentage = $request->get('discount_percentage');
        $coupans->minimum_transaction_amount = $request->get('minimum_transaction_amount');
        $coupans->maximum_discount_amount = $request->get('maximum_discount_amount');
        $coupans->start_date = $request->get('start_date');
        $coupans->end_date = $request->get('end_date');
        $coupans->description = $request->get('description');
        $coupans->is_active = $request->get('is_active');
        $coupans->save();

        $notification = array(
            'message' => 'Coupan updated successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    function changeActivationStatus($id) {
        $coupans = Coupan::find($id);
        $coupans->is_active = !$coupans->is_active;
        $coupans->save();
        $notification = array(
            'message' => 'Coupan type is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('coupans')->with($notification);
    }

    function deleteCoupan($id) {
        $coupans = Coupan::find($id);
        $coupans->delete();
        $notification = array(
            'message' => 'Coupan is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('coupans')->with($notification);
    }
}
