<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactusData;
class ContactusController extends Controller
{
    function getEnquiries() {
        $contactusData = ContactusData::all();
        return view('enquiries/enquiries')->with('contactusData',$contactusData);
    }

    function deletEnquiry($id) {
        $contactusData = ContactusData::find($id);
        $contactusData->delete();
        $notification = array(
            'message' => 'Enquiry is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/getenquiries')->with($notification);
    }
}
