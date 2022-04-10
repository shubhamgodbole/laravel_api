<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use App\Models\TransectionHistory;
use App\Models\NotificationDetail;
use App\Models\SecurityDeopsit;
use Illuminate\Http\Request;
use App\Models\PgBooking;
use App\Models\Pgdetail;
use App\Models\Quests;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use App\Models\UserUsedCoupan;
use Illuminate\Support\Facades\DB;
class PgBookingController extends Controller
{
    function pgBooking(Request $request) {
        DB::beginTransaction();
        try {

                $element_array = array(
                    'tenant_id'=> "required",
                    'owner_id'=> "required",
                    'pg_id'=> "required",
                    'transection_id' => 'required',
                    'payment_id' => 'required',
                    'from_date'=> "required",
                    'to_date'=> "required",
                    'booking_price'=> "required",
                    'security_deposit' => 'required',
                    'cleaning_fee' => 'required',
                    //'discount' => 'required',
                    'total_amount' => 'required', 
                    'room_type_id' => 'required', 
                    'total_amount_after_discount' => 'required', 
                    'number_of_months' => 'required', 
                    'number_of_persons' => 'required',
                    'quests' => 'required',   
                   // 'hash_sequence' =>'required',
                    'payment_mode' =>'required'
                );
                
                if($request->get('coupan_id')) {
                    $element_array['coupan_code'] = 'required';
                    $element_array['discount'] = 'required';
                }
                
                $validator = Validator::make($request->all(), $element_array);

                if ($validator->fails()) {
                    return $this->sendResultJSON(false, $validator->errors()->first());
                }
            
                if(($request->get('payment_mode') == config('constants.payment_mode')['online'] ) && !$request->get('hash_sequence') ) {
                    return $this->sendResultJSON(false, 'hash sequence is required');
                }
                
                if($request->get('payment_mode') == config('constants.payment_mode')['pay_at_pg'] && !$request->get('status')) {
                        return $this->sendResultJSON(false, 'status field is required');
                }
                
                $pgDetail= Pgdetail::where('id',$request->get('pg_id'))->where('is_available',1)->first();
                if(!$pgDetail) {
                    return $this->sendResultJSON(false, 'this pg is not available');
                }
                $quests = $request->get('quests');
                
                $transectionHistory = '';
                $hashToken = '';
                if(($request->get('payment_mode') == config('constants.payment_mode')['online'] )) {
                    $salt = "UrnfHbCBu7";
                    
                    $token = $request->get('hash_sequence'). $salt;
                    $hashToken = hash('sha512', $token);
                    if($hashToken) {
                        $transectionHistory = TransectionHistory::where('tenant_id',$request->get('tenant_id'))
                        ->where('pg_id',$request->get('pg_id'))
                        ->where('owner_id',$request->get('owner_id'))
                        ->where('transection_id',$request->get('transection_id'))
                        ->first();
                        
                        if($transectionHistory) {
                            $transectionHistory->delete();
                        }   
                        $transectionHistory = new TransectionHistory();
                        $transectionHistory->tenant_id = $request->get('tenant_id');
                        $transectionHistory->pg_id = $request->get('pg_id');
                        $transectionHistory->owner_id = $request->get('owner_id');
                        $transectionHistory->transection_id = $request->get('transection_id');
                        $transectionHistory->hash_token = $hashToken;
                        $transectionHistory->save();
                    }  
                }
            
                $pgBooking = new PgBooking();
                $pgBooking->tenant_id = $request->get('tenant_id');
                $pgBooking->pg_id = $request->get('pg_id');
                $pgBooking->owner_id = $request->get('owner_id');
                $pgBooking->payment_id = $request->get('payment_id');
                $pgBooking->room_type_id = $request->get('room_type_id');
                $pgBooking->from_date = $request->get('from_date'); 
                $pgBooking->to_date = $request->get('to_date'); 
                $pgBooking->booking_price = $request->get('booking_price');
                $pgBooking->security_deposit = $request->get('security_deposit');
                $pgBooking->cleaning_fee = $request->get('cleaning_fee');
                $pgBooking->coupan_code = $request->get('coupan_code');
                $pgBooking->discount = $request->get('discount');
                $pgBooking->total_amount = $request->get('total_amount');
                $pgBooking->total_amount_after_discount = $request->get('total_amount_after_discount');
                $pgBooking->number_of_months = $request->get('number_of_months');
                $pgBooking->number_of_persons = $request->get('number_of_persons');
                $pgBooking->payment_mode = $request->get('payment_mode');
                $pgBooking->merchant_id = $request->get('merchant_id');
                $pgBooking->merchant_key = $request->get('merchant_key');
                
                $response = [];
                if(($request->get('payment_mode') == config('constants.payment_mode')['online'] ))  {
                    $pgBooking->transection_history_id = $transectionHistory->id;
                    $response['check_sum'] = $hashToken ? $hashToken : '';
                }
                            
                if($request->get('payment_mode') == config('constants.payment_mode')['pay_at_pg']) {
                    $pgBooking->status = config('constants.booking_status')['completed'];
                    $pgBooking->booking_status_text = $request->get('status');
                    $response['status'] = $request->get('status');
                }    
                $pgBooking->save();

                // if($request->get('coupan_id')) {
                //     $userUsedCoupan = new UserUsedCoupan();
                //     $userUsedCoupan->tenant_id = $request->get('tenant_id');
                //     $userUsedCoupan->coupan_id = $request->get('coupan_id');
                //     $userUsedCoupan->pg_id = $request->get('pg_id');
                //     $userUsedCoupan->save();
                // }

                foreach($quests as $q) {
                    $quest = new Quests();
                    $quest->pg_booking_id = $pgBooking->id;
                    $quest->quest_name = $q['quest_name'];
                    $quest->quest_mobile = $q['quest_mobile'];
                    $quest->quest_document_type = $q['quest_document_type'];
                    $quest->quest_document_number = $q['quest_document_number'];
                    $quest->save();   
                }

                $securityDeposit = new SecurityDeopsit();
                $securityDeposit->tenant_id = $request->get('tenant_id');
                $securityDeposit->pg_id = $request->get('pg_id');
                $securityDeposit->payment_id = $request->get('payment_id');
                $securityDeposit->amount = $request->get('security_deposit');
                $securityDeposit->booking_id = $pgBooking->id;
                $securityDeposit->payment_date = Carbon::now();
                $securityDeposit->save();

                DB::commit();
                
                $owner = User::where('id',$request->get('owner_id'))->first();
                $tenant = User::where('id',$request->get('tenant_id'))->first();
            
                pushNotificationAndroid([
                    'to_userid'=>$owner->id,
                    'from_userid'=>$tenant->id,
                    'pg_id'=>$request->get('pg_id'),
                    'type'=>'PG_BOOKING',
                    'notification_title'=> 'New Booking !!',
                    'notification_text'=> $pgDetail->pg_name .' has been booked by '. $tenant->first_name .' '. $tenant->last_name , 
                    'device_id'=> $owner->gcm_subscription_id
                    ]);
                
                // if($user->email ) {
                //     sendMail(['send_to_email'=> $user->email, 'type'=>'BOOKING_CONFORMATION','data_to_replace'=>array('{tanent_name}'=>$user->first_name.' '. $user->last_name,'{pg_name}'=>$pgDetail->pg_name)]);
                // }

                return $this->sendResultJSON(true, _("Booking Successfull."),$response );
        }
        catch (\Exception $e) {
            DB::rollBack();
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    
    function verifyHsahToken(Request $request) {
        try {
            $element_array = array(
                'owner_id' => 'required',
                'tenant_id' => 'required',
                'pg_id' => 'required',
                'transection_id' => 'required',
                'hash_sequence' => 'required',
                'compare_sequence' => 'required',
                'payu_json' => 'required',
                'status' => ' required'
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $salt = "UrnfHbCBu7";
            $token = $salt.$request->get('hash_sequence') ;
            $hashToken = hash('sha512', $token);
            
           // return $this->sendResultJSON(true, '',$hashToken);
            //return $this->sendResultJSON(true, _("Your hash token is verefied succssfully."),array('transection_id'=>$request->get('transection_id')) );
            
            if($hashToken == $request->get('compare_sequence')) {
                $transectionHistory = TransectionHistory::where('tenant_id',$request->get('tenant_id'))
                ->where('owner_id',$request->get('owner_id'))
                ->where('pg_id',$request->get('pg_id'))
                ->where('transection_id',$request->get('transection_id'))
                ->first();
//                return $this->sendResultJSON(true, '',$transectionHistory);
                if($transectionHistory) {
                    $transectionHistory->payu_json = $request->get('payu_json');
                    $transectionHistory->status = $request->get('status');
                    $transectionHistory->save();
                    if($request->get('status') == 'SUCCESS' || $request->get('status') == 'SUCCESSFUL') {
                        $pgBooking = PgBooking::where('transection_history_id',$transectionHistory->id)->first();
                        
                        if($pgBooking) {
                             $pgBooking->status = config('constants.booking_status')['completed'];
                             $pgBooking->booking_status_text = $request->get('status');
                             $pgBooking->save();
                        
                            if($request->get('coupan_id')) {
                                $userUsedCoupan = new UserUsedCoupan();
                                $userUsedCoupan->tenant_id = $request->get('tenant_id');
                                $userUsedCoupan->coupan_id = $request->get('coupan_id');
                                $userUsedCoupan->pg_id = $request->get('pg_id');
                                $userUsedCoupan->save();
                            }     
                            // $pgDetail= Pgdetail::where('id',$request->get('pg_id'))->first();
                            //     $pgDetail->is_available = 0;
                            //     $pgDetail->save();
                        }

                    }
                return $this->sendResultJSON(true, _("Your hash token is verefied succssfully."),array('transection_id'=>$request->get('transection_id'), 'status' => $request->get('status')) );
                }
                return $this->sendResultJSON(true, _("Invalid transection id."),array('transection_id'=>$request->get('transection_id')) );
            }
            else {
                    return $this->sendResultJSON(false, _("Your hash token is not verefied succssfully.") ,array('transection_id'=>$request->get('transection_id')));
            }
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    function myBookings(Request $request) {
        try {
            
            if(!$request->get('tenant_id') && !$request->get('owner_id')) {
                 return $this->sendResultJSON(false, "Please passed at least one field  tenant_id or owner_id");
            }
            
            if($request->get('tenant_id')) {
                $pgBooking = PgBooking::where('tenant_id',$request->get('tenant_id'))->where('status',config('constants.booking_status')['completed'])->get();
            }
            else {
                $pgBooking = PgBooking::where('owner_id',$request->get('owner_id'))->where('status',config('constants.booking_status')['completed'])->get();
            }

            $pgBookingData = [];
            foreach($pgBooking as $p) {
                $pgDetail= Pgdetail::where('id',$p->pg_id)->with('address')->with('pg_owner')->withTrashed()->first();
                $transectionHistory = '';
                if($p->transection_history_id) {
                    $transectionHistory = TransectionHistory::where('id',$p->transection_history_id)->first();
                }
                $tenant = User::where('id',$p->tenant_id)->first();
                
                array_push($pgBookingData,array(
                    'id' => $p->id,
                    'pg_name' =>  $pgDetail->pg_name,
                    'owner_id' =>$pgDetail['pg_owner']['id'],
                    'owner_name'=> $pgDetail['pg_owner']['first_name'] .' '. $pgDetail['pg_owner']['last_name'],
                    'tenant_name' => $tenant->first_name .' '.$tenant->last_name,
                    'tenant_mobile' => $tenant->mobile,
                    'from_date' => $p->from_date,
                    'to_date' => $p->to_date,
                    'booking_price' => $p->booking_price,
                    'security_deposit' => $p->security_deposit,
                    'cleaning_fee' => $p->cleaning_fee,
                    'coupan_code' => $p->coupan_code,
                    'discount' => $p->discount,
                    'total_amount' => $p->total_amount,
                    'total_amount_after_discount' => $p->total_amount_after_discount,
                    'number_of_months' => $p->number_of_months,
                    'number_of_persons' => $p->number_of_persons,
                    'location' => $pgDetail->address,
                    'payu_json' => $transectionHistory ? $transectionHistory->payu_json : null,
                    'payment_mode' => $p->payment_mode,
                    'status' => $p->booking_status_text,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    ));
            }
            
            return $this->sendResultJSON(true, _("Fetch my bookings successfully"),$pgBookingData );
        }catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    function getNotifications(Request $request) {
        try {
            $element_array = array(
                'to_userid'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            $query = NotificationDetail::where('to_userid',$request->get('to_userid'));
            if($request->get('from_userid')) {
                $query = $query->where('from_userid',$request->get('from_userid'));
            }
            $notificationDetail = $query->get();

            $data = [];
            foreach($notificationDetail as $n) {
                $touser = User::where('id',$request->get('to_userid'))->first();
                $fromuser = User::where('id',$n->from_userid)->first();
                $pgDetail= Pgdetail::where('id',$n->pg_id)->withTrashed()->first();                
                array_push($data,[
                    'id' => $n->id,
                    'from_user_id' => $fromuser->id,
                    'from_user_name' => $fromuser->first_name .' '. $fromuser->last_name,
                    'from_user_profile_url' => $fromuser->profile ?? null,
                    'to_user_id' => $touser->id,
                    'to_user_name' => $touser->first_name .' '. $touser->last_name,
                    'to_user_profile_url' => $touser->profile ?? null,
                    'pg_id' => $pgDetail->id,
                    'pg_name' => $pgDetail->pg_name,
                    'type' => $n->type,
                    'message_payload' => $n->notification_text,
                    'sent_datetime' => Carbon::parse($n->created_at)->format("d M Y h:i A")
                ]);
            }
            return $this->sendResultJSON(true, '',$data);
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
}
