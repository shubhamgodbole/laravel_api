<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class EmailTemplateController extends Controller
{
    function getEmailTemplates() {
        $emailTemplates = EmailTemplate::all();
        return view('emailtemplates/emailtemplates')->with('emailTemplates',$emailTemplates);
    }

    function editEmailTemplate($id) {
        $emailTemplate = EmailTemplate::find($id);
        return view('/emailtemplates/editemail_template')->with('edit_data',$emailTemplate);
    }

    function updateEmailTemplate(Request $request) {
        $validator = $request->validate([
            'subject' => 'required',
            'email_text' => 'required',
            'id' => 'required',
        ]);

        $emailTemplate = EmailTemplate::find($request->get('id'));
        $emailTemplate->subject = $request->get('subject');
        $emailTemplate->email_text = $request->get('email_text');
        $emailTemplate->save();

        $notification = array(
            'message' => 'Email template is update successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('emailtemplates')->with($notification);
    }
    
        function sendEmail(Request $request) {
        $validator = $request->validate([
            'subject' => 'required',
            'email_text' => 'required',
            'send_to' => 'required',
        ]);
        $user = [];
        if($request->get('send_to') == 1) {
            $user = User::where('is_active',1)->get();
        }
        else if($request->get('send_to') == 2) {
            $user = User::where('user_type',config('constant.user_type')['owner'])->where('is_active',1)->get();
        }
        else if($request->get('send_to') == 3) {
            $user = User::where('user_type',config('constant.user_type')['tenant'])->where('is_active',1)->get();
        }
        foreach($user as $u ) {
            $u->email = 'shubhamgodbole30129@gmail.com';
            if($u->email) {
                Mail::send(array(), array(), function ($message) use($u,$request) {
                    $message->to($u->email)
                    ->subject($request->get('subject'))
                    ->from('getamit025@gmail.com')
                    ->setBody($request->get('email_text'));
                });            
            }
        }
        $notification = array(
            'message' => 'Email sent successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('emailtemplates/sendemail')->with($notification);

     }

}
