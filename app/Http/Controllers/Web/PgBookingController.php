<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SecurityDeopsit;
use Illuminate\Http\Request;
use App\Models\PgBooking;
use App\Models\Pgdetail;
use Carbon\Carbon;
class PgBookingController extends Controller
{
    function getBookings() {
        $pgBookingDetail = PgBooking::with('pgDetail')->with('tenantDetail')->get();
        //return $pgBookingDetail;
        return view('pgbooking/pg_booking')->with('pg_booking_datail',$pgBookingDetail);
    }

    function getBookingDetail($id) {

        $pgBookingDetail = PgBooking::with('pgDetail')->with('tenantDetail')->where('id',$id)->first();
        //return $pgBookingDetail;
        return view('pgbooking/pg_booking_detail')->with('pg_booking_datail',$pgBookingDetail);
    }

    function getSecurityDeposits() {
        $securityDeposts = SecurityDeopsit::with('pgDetail')->with('tenantDetail')->get();
        return view('pgbooking/securitydeposit')->with('securityDeposts',$securityDeposts);
    }

    function editSecurityDeposits($id) {
        $edit_data = SecurityDeopsit::with('pgDetail')->with('tenantDetail')->where('id',$id)->first();
        return view('pgbooking/editsecuritydeposit')->with('edit_data',$edit_data);
    }

    function updateSecurityDeposits(Request $request) {
        $validator = $request->validate([
            'id' => 'required',
            'return_date' => 'required'
        ]);

        $securityDeposts = SecurityDeopsit::where('id',$request->get('id'))->first();

        if(Carbon::parse($request->get('return_date')) < Carbon::parse($securityDeposts->payment_date)) {
            $notification = array(
                'message' => 'Return date must be grater than payment date', 
                'alert-type' => 'error'
            );  
            
            return redirect('/security_diposits/edit_security_diposits/'.$request->get('id'))->with($notification);    
        }

        $securityDeposts->return_date = $request->get('return_date');
        $securityDeposts->save();

        $pgdetail = Pgdetail::where('id',$securityDeposts->pg_id)->first();
        $pgdetail->is_available = 1;
        $pgdetail->save();
        
        $notification = array(
            'message' => 'Return date updateed successfully.', 
            'alert-type' => 'success'
        );  
        
        return redirect('/security_diposits')->with($notification);
    }
}
