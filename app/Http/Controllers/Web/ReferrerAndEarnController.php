<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferrerAndEarn;
use Validator;
class ReferrerAndEarnController extends Controller
{
    function getReferrerRules(Request $request) {
        $rules = ReferrerAndEarn::all();
        return view('referrerandearn/referrerandearn')->with('rules',$rules); 
    }

    function addRule(Request $request) {
        
        $referrerAndEarn = new ReferrerAndEarn();
        $referrerAndEarn->creater_amount = $request->get('creater_amount');
        $referrerAndEarn->receiver_amount	 = $request->get('receiver_amount');
        $referrerAndEarn->expiry_date = $request->get('expiry_date');
        $referrerAndEarn->description = $request->get('description');
        $referrerAndEarn->is_active = $request->get('is_active');
        $referrerAndEarn->save();
        
        // meta_data change
        updateMetaData();

        $notification = array(
            'message' => 'New rule is add successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('refer_and_earn')->with($notification);
    }

    function editRule($id) {
        $referrerAndEarn = ReferrerAndEarn::find($id);
        return view('/referrerandearn/editrule')->with('edit_data',$referrerAndEarn);
    }

    function updateRule(Request $request) {
        $validator = $request->validate([
            'creater_amount' => 'required',
            'receiver_amount' => 'required',
            'expiry_date' => 'required',
            'is_active' => 'required',
            'id' => 'required'
        ]);

        $referrerAndEarn = ReferrerAndEarn::find($request->get('id'));

        $referrerAndEarn->creater_amount = $request->get('creater_amount');
        $referrerAndEarn->receiver_amount	 = $request->get('receiver_amount');
        $referrerAndEarn->expiry_date = $request->get('expiry_date');
        $referrerAndEarn->description = $request->get('description');
        $referrerAndEarn->is_active = $request->get('is_active');
        $referrerAndEarn->save();
        
        // meta_data change
        updateMetaData();

        $notification = array(
            'message' => 'Rule is updated successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('refer_and_earn')->with($notification);
    }

    function changeActivationStatus($id) {
        $referrerAndEarn = ReferrerAndEarn::find($id);
        $referrerAndEarn->is_active = !$referrerAndEarn->is_active;
        $referrerAndEarn->save();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Rule is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/property_types')->with($notification);
    }

    function deletRule($id) {
        $referrerAndEarn = ReferrerAndEarn::find($id);
        $referrerAndEarn->delete();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Rule is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/property_types')->with($notification);
    }
}
