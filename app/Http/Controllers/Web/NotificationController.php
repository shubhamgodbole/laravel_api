<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationDetail;
use App\Models\User;
class NotificationController extends Controller
{
     function sendNotification(Request $request) {
         $validator = $request->validate([
            'sendto' => 'required',
            'title' => 'required',
            'description' => 'required',
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
        ]);
        
        $user = User::where('user_type',$request->get('sendto'))->where('is_active',1)->get();
        if(count($user) > 0) {
            foreach($user as $u ) {
                $ads = new NotificationDetail();
                $ads->from_userid = session("user")->id;
                $ads->to_userid = $u->id;
                $ads->title = $request->get('title');
                $ads->description = $request->get('description');
        
                if($request->file('image')) {
                    $t=time();
                    $file_name = $t."_notification.jpg";
                    $path = $request->file('image')->move(public_path("/image/"),$file_name);
                    $file_uri = url('/public/image/'.$file_name);
                    //return $file_uri;
                    $ads->image = $file_uri;
                }
                
                $ads->save();
                pushNotificationAndroid([
                    'to_userid'=>$u->id,
                    'from_userid'=>session("user")->id,
                    'pg_id'=>'',
                    'type'=>'ADMIN_NOTIFICATION',
                    'notification_title'=> $request->get('title'),
                    'notification_text'=> $request->get('description') , 
                    'device_id'=> $u->gcm_subscription_id
                    ]);
            }
        }
        return session("user")->id; 
    }
}
