<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
use Excel;
use DB;
use Flash;
use App\comments;
use Illuminate\Support\Facades\Mail;
use App\Email;
use App\Sentmaillist;
use App\shipment;
use Carbon\Carbon;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function inbox(){
        $email=Email::where('received_date','>',Carbon::today())->delete();
        $oClient = Client::account();
        $oClient->connect();
        $afolder=$oClient->getFolder('INBOX');
        //Get the mail from today
        $aMessage=$afolder->query()->leaveUnread()->since(Carbon::today())->get();
        //insert the mail to db
        foreach($aMessage as $oMessage){
            try{
                $email=new Email();
                $email->subject=$oMessage->getSubject();
                $email->body=$oMessage->getHTMLBody();
                $email->from=$oMessage->getFrom()[0]->personal;
                $email->received_date=$oMessage->getDate();
                $email->attachment=$oMessage->getAttachments()->count() > 0 ? 1 : 0;
                $email->from_email=$oMessage->getFrom()[0]->mail;
                $aAttachment = $oMessage->getAttachments();
                $flag=$oMessage->getFlags();
                $email->is_read= $flag['seen'];
                //Fetching attachments
                $aAttachment->each(function ($oAttachment) {
                    $oAttachment->save();
                });
                $email->token=$oMessage->getUid().'/'.$afolder->name.'/'.$oMessage->getDate();
                $email->save();
            }
            catch (\Exception $e) {
            }
        }
        $message=Email::orderby('id','DESC')->select('id','from','subject','attachment','received_date','is_read')->paginate(15);
        return view('inbox',['paginator'=>$message]);
    }

    public function sentmaillist(){
        $oClient = Client::account();
        $oClient->connect();
        $afolder = $oClient->getFolders();
        Sentmaillist::where('received_date','>',Carbon::today())->delete();
        $aMessage=$afolder[1]->children[3]->query()->since(Carbon::today())->get();
        foreach($aMessage as $oMessage){
            try{
                $email = new Sentmaillist();
                $email->subject    =    $oMessage->getSubject();
                $email->body       =    $oMessage->getHTMLBody();
                $email->from       =    $oMessage->getTo()[0]->personal;
                $email->received_date=$oMessage->getDate();
                $email->attachment=$oMessage->getAttachments()->count() > 0 ? 1 : 0;
                $email->from_email=$oMessage->getTo()[0]->mail;
                $aAttachment = $oMessage->getAttachments();
                //Fetching attachments
                $aAttachment->each(function ($oAttachment) {
                    $oAttachment->save();
                });
                $email->save();
            }
            catch (\Exception $e) {
                echo "Error in sentmail cron".$e;
            }
        }
        $message=Sentmaillist::orderby('received_date','DESC')->select('id','from_email','subject','attachment','received_date')->paginate(15);
        return view('sentmaillist',['paginator'=>$message]);
    }

    public function compose(){
        return view('compose');
    }

    public function sentmail(Request $request){

        $request->validate([
        'email' => 'required',
        'subject' => 'required'
        ]);

        $shipment_array=$request->parameter;
        $multiplied='';
        if(!empty($shipment_array)){
            foreach($shipment_array as $shipment){
                $attachment=Shipment::whereIn('id',$shipment_array)->select('id','attachments')->get();
                $multiplied = $attachment->map(function ($item, $key) {
                    return $item->id."/".$item->attachments;
                });
            }
        }
        $email=$request->email;
        $subject=$request->subject;
        $body=$request->whole;
        $email=str_replace("[","",$email);
        $email=str_replace("]","",$email);
        $email=preg_replace('/"/',"",$email);
        $email_array=explode(",",$email);
        try{
            //application attachment mail sending
            $data=[
            'email' => $email_array,'body'=>$body];
            $file_uplod=$request->file('attachment');
            Mail::send('email', $data,function ($message) use($email_array,$subject,$multiplied,$file_uplod) {
                $message->to($email_array);
                $message->subject($subject);
                if(!empty($multiplied)){
                    foreach($multiplied as $file){
                        $message->attach(public_path().'/uploads/docreceipt/'.$file);
                    }
                }
                if(!empty($file_uplod)){
                $message->attach($file_uplod->getRealPath(),
                [
                    'as' => $file_uplod->getClientOriginalName(),
                    'mime' => $file_uplod->getClientMimeType(),
                ]);
                }
            });
            $request->session()->flash('success', 'Mail Sent successfully!');
            return redirect('home');
            }
        catch (\Exception $e) {
            $request->session()->flash('error', "Something went wrong try Again!");
            return redirect('home');
        }
    }

    public function showMail($id){
        // get the id
        $message = Email::findOrFail($id);
        $token=$message->token;
        $parts = explode('/', $token);
        /** @var \Webklex\IMAP\Folder $folder **/
        $oClient = Client::account();
        $oClient->connect();
        $afolder=$oClient->getFolder('INBOX');
        //$folder = $client->getFolder($parts[1]);
        /** @var \Webklex\IMAP\Message $message **/
        if($parts[0]){
            $mail = $afolder->getMessage($parts[0]);
            /** @var boolean $check **/
            if($mail->getDate() == $parts[2])
            {
                $mail->setFlag(['Seen']);
            }
        }
        $message->is_read=1;
        $message->save();
        // show the view and pass the nerd to it        
        $mail="From";
        return view('showmail',compact('message'),compact('mail'));
    }

    public function showmailsent($id){
        // get the id
        $message = Sentmaillist::findOrFail($id);
        // show the view and pass the nerd to it
        $mail="To";
        return view('showmail',compact('message'),compact('mail'));
    }

    public function getSentmail(){
        $sentmail = Sentmaillist::groupBy('from_email')->pluck('from_email');
        return $sentmail;
    }

}
