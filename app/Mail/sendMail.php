<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->email_type = $data["email_type"];
        $this->send_to_email = $data["send_to_email"];
        $this->data_to_replace = $data["data_to_replace"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailTemplate = EmailTemplate::where('type',$this->email_type)->first();
        $email_text = prepareNotificationText($this->data_to_replace,$emailTemplate->email_text);
        $email_subject = $emailTemplate->subject;
        return $this->subject($email_subject)->view('mail')->with(['html'=>$email_text,'header'=> '','footer'=>'']);
    }
}
