<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactusData;

class ContactusController extends Controller
{
    function sendEnquiry(Request $request) {
        try {
            $contactusData = new ContactusData();
            $contactusData->name = $request->get('name');
            $contactusData->mobile = $request->get('mobile');
            $contactusData->email = $request->get('email');
            $contactusData->message = $request->get('message');
            $contactusData->save();
            return $this->sendResultJSON(true, _("Enquiry send successfully.") ,$contactusData);
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
}
