<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserUsedCoupan;
use App\Models\Coupan;
use Validator;
use Carbon\Carbon;
class CoupanController extends Controller
{
    function getCoupans(Request $request) {
        try {
            $element_array = array(
                'tenant_id'=> "required",
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $coupans = Coupan::where('start_date','<=',Carbon::now()->format('Y-m-d'))->where('end_date','>=',Carbon::now()->format('Y-m-d'))->orWhere('end_date',NULL)->where('is_active',1)->get();
            $data = [];
            foreach($coupans as $coupan) {
                $userUsedCoupan = UserUsedCoupan::where('tenant_id',$request->get('tenant_id'))->where('coupan_id',$coupan->id)->first();
                $coupan->is_used = $userUsedCoupan ? true : false;
               // if(!$userUsedCoupan) {
                    array_push($data,$coupan);
               // }
            }
            return $this->sendResultJSON(true, 'Coupans fetch successfully',array('coupans'=> $data));           
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

function checkVaildCoupan(Request $request) {
        try {
            $element_array = array(
                'tenant_id'=> "required",
                'coupan_code'=> "required"
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            $coupan = Coupan::where('coupan_code',$request->get('coupan_code'))->where('is_active',1)->first();
            if($coupan) {
                $userUsedCoupan = UserUsedCoupan::where('tenant_id',$request->get('tenant_id'))->where('coupan_id',$coupan->id)->first();
                if($userUsedCoupan) {
                    return $this->sendResultJSON(false, 'You had already used this coupan before');
                }
                $coupan->is_used = $userUsedCoupan ? true : false;
                if(!$coupan->end_date) {
                    return $this->sendResultJSON(true, 'Coupon code applied successfully',$coupan);                    
                }
                if($coupan->end_date >= Carbon::now()->format('Y-m-d')) {
                    return $this->sendResultJSON(true, 'Coupon code applied successfully',$coupan);
                }
            }
            return $this->sendResultJSON(false, 'Invalid Coupon');
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
}
