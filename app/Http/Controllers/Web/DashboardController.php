<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PgBooking;
use App\Models\Pgdetail;
use App\Models\User;
class DashboardController extends Controller
{
    function getDashboardData() {
        $data =[];
        $data['total_owners'] = User::where('user_type',config('constants.user_type')['owner'])->get()->count();
        $data['total_tenants'] = User::where('user_type',config('constants.user_type')['tenant'])->get()->count();
        $data['total_pgs'] = Pgdetail::get()->count();
        $data['total_booking'] = PgBooking::get()->count();
        $data['letest_booking'] = PgBooking::with('pgDetail')->with('tenantDetail')->orderBy('created_at', 'asc')
        ->take(10)->get();
        //return $data;
        return view('dashboard')->with('dashboard_data',$data); 
    }
}
