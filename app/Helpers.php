<?php 
use Carbon\Carbon;
use App\Models\Otpdetail;
require 'vendor/autoload.php';
use Plivo\RestClient;
use App\Mail\sendMail;
use App\Models\NotificationDetail;
use App\Models\MetaDataChange;
use App\Models\User;
function generateAccessToken($data)
{
    $token = json_encode(array('deviceUUID' => $data['deviceUUID'], 'timestamp' => Carbon::Now()->timestamp));
    return base64_encode(base64_encode($token));
}

function generateReferralCode()
{
    $is_exist_referral_code = false;
    do {
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $referral_code = substr(str_shuffle($str_result),  0, 6);
      $is_exist_referral_code = checkReferralCodeDuplication($referral_code);
      return $referral_code;
    } while (!$is_exist_referral_code);
}
function checkReferralCodeDuplication($referral_code)
{
    try {
        $is_exist = false;
        if ($referral_code) {
            $user_count = User::where("referral_code", $referral_code)->count();
            if ($user_count > 0) {
                $is_exist = true;
            } 
        }
        return $is_exist;
    } catch (\Exception $e) {
        report($e);
        return $e->getMessage();
    }
}

function sendOTP($mobile,$request_type) {
  $Otpdetail = Otpdetail::where('mobile',$mobile)->latest()->first();
  if($Otpdetail) {
    $Otpdetail->delete();
  }
  $otp_code = rand(100000, 999999);
  $Otpdetail = new Otpdetail();
  $Otpdetail->mobile = $mobile;
  $Otpdetail->request_type = $request_type;
  $Otpdetail->otp = $otp_code;
  $Otpdetail->save();

  $mobile = '+91'.$mobile;
    $client = new RestClient("MANTAYMTVMNTJIOTCZZW", "N2IwNjM1OGY5MGZkNjA1ZTJlYmVmMTI1NWIxNmZh");
  $response = $client->messages->create(
    '+919528743902', #src
    [$mobile], #dst
    '<#>Hi, '. $Otpdetail->otp .' is your One Time Password on PayPgRoom.com. Please use this password to complete your phone number verification.
oKMSc0m2tJK'
  );
//   print_r($response);
//   // Prints only the message_uuid
//   print_r($response->getmessageUuid(0));
  return $Otpdetail;
}



function sendMail($data) {
  Mail::to('shubhamgodbole30129@gmail.com')->send(new sendMail([
    "email_type" => $data['type'],
    "send_to_email" => $data['send_to_email'],
    "data_to_replace" => $data['data_to_replace']
]));

}

function prepareNotificationText($data, $notification_text)
{
    return str_replace(array_keys($data), array_values($data), $notification_text);
}


function pushNotificationAndroid($data){
   //API URL of FCM
   $url = 'https://fcm.googleapis.com/fcm/send';

   /*api_key available in:
   Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
   $api_key = 'AAAApB4C6Sg:APA91bGnIFMeMWW8CNMqVRpneAKoOHJ9o_-SsFBKrtSLt6nf4-NRXFfk5EBKLClrlAkSqBnZOWEJnisWIh5eE1BkGR3vjPZcYOF0LU2GB6KKE5vgxTFIwZakw1F0eklETF32ZOfijK63';

   // $api_key = 'AIzaSyDOsF2lefoYoxixQ1NV-Hsj3d-GqfcChzs';

   if($data['device_id']) {
        

   $fields = array (
       'to' =>  $data['device_id'],
       'data' => array (
           "message" => $data['notification_text'],
           "title" => $data['notification_title'],
           // BELOW GROUP_ID FIELD ADDED BY RAVI AS GROUP_ID WAS NEEDED TO HANDLE NOTIFICATION CLICK AND OPEN GROUP DETAILS ON NOTIFICATION CLICK.
       )
   );

   //header includes Content type and api key
   $headers = array(
       'Content-Type:application/json',
       'Authorization:key='.$api_key
   );

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   $result = curl_exec($ch);
   if ($result === FALSE) {
       return false;
       die('FCM Send Error: ' . curl_error($ch));
   }
   curl_close($ch);  
 

    $notificationDetail = new NotificationDetail();
    $notificationDetail->to_userid = $data['to_userid'];
    $notificationDetail->from_userid = $data['from_userid'];
    $notificationDetail->pg_id = $data['pg_id'];
    $notificationDetail->type = $data['type'];
    $notificationDetail->notification_text = $data['notification_text'];
    $notificationDetail->save();

    
      return true;
   }
   return false;
}

function updateMetaData() {
  $MetaDataChange = MetaDataChange::first();
  $MetaDataChange->meta_data_change_date	 = $MetaDataChange->latest_meta_data_change_date;
  $MetaDataChange->latest_meta_data_change_date	 = Carbon::now();
  $MetaDataChange->save();
}
