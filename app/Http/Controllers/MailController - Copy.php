<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;
use Webklex\IMAP\Facades\Client;
use Excel;
use DB;
use Flash;
use App\comments;
use Illuminate\Support\Facades\Mail;
use App\Email;
use App\shipment;

class MailController1 extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inbox(){

        /* connect to gmail */
    //$hostname = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
    // $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
    // $username = 'kayalvizhiengg@gmail.com';
    // $password = 'kayal@excelencia';

    // $inbox = imap_open($hostname, $username, $password) or die('Cannot connect: ' . imap_last_error());

    // $emails = imap_search($inbox, 'ALL');

    // if ($emails) {
    //     $output = '';
    //     $mails = array();

    //     rsort($emails);
    //     $i=0;
                    // foreach ($emails as $email_number) {
                    //     $header = imap_headerinfo($inbox, $email_number);
                    //     $message = quoted_printable_decode (imap_fetchbody($inbox, $email_number, 1));

                    //     $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                    //     $toaddress = $header->toaddress;
                    //     echo $i++;echo "<br>";echo $message;
                    //     if(!imap_search($inbox, 'ALL')){
                    //         /*Store from and message body to database*/
                    //         DB::table('email')->insert(['from'=>$toaddress, 'body'=>$message]);
                    //         return view('inbox');
                    //     }
                    //     else{
                    //         $data = Email::all();
                    //     }
                    // }

    //     foreach($emails as $email_number) {
		
	// 	/* get information specific to this email */
	// 	$overview = imap_fetch_overview($inbox,$email_number,0);
	// 	$message = imap_fetchbody($inbox,$email_number,2);
		
	// 	/* output the email header information */
	// 	$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
	// 	//$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
	// 	$output.= '<span class="from">'.$overview[0]->from.'</span>';
	// 	$output.= '<span class="date">on '.$overview[0]->date.'</span>';
	// 	$output.= '</div>';
		
	// 	/* output the email body */
	// 	$output.= '<div class="body">'.$message.'</div>';
	// }
	
	// echo $output;
    // }
    // //return view('inbox',compact('message'));
    //     imap_close($inbox);
    

        $oClient = Client::account();
        $oClient->connect();
        $afolder = $oClient->getFolders();
        //$aFolder = $aFolder->query()->limit(10, 2)->get();
        echo "<pre>";print_r($afolder);exit;
        echo '<table style="border-collapse:collapse;border:1px solid black;">';
        $aMessage=$afolder[3]->children[3]->getMessages();
        $message=$aMessage->paginate($perPage = 5, $page = null, $pageName = 'imap_blade_example');
        // foreach($aFolder[0] as $oFolder){

            //Get all Messages of the current Mailbox $oFolder
            /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
            //echo "<pre>";print_r($aMessage);exit;
             //$aMessage = $oFolder->limit(10, 2)->get();
             //$aMessage = $oFolder->getMessages();
            
            // /** @var \Webklex\IMAP\Message $oMessage */
            return view('inbox',['paginator'=>$message]);
             $x=0;
            foreach($message as $key=>$oMessage){
                $x++;
                echo '<tr style="border:1px solid black;"><td>'.$x.'</td><td style="border:1px solid black;">';
                echo $oMessage->subject.'<br />';
                //echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
                echo '<td>'.$oMessage->getHTMLBody(true).'</td>';
                echo '<td>'.$oMessage->getTextBody(true).'</td>';
                echo '</td><td>'.$x.'</td></tr>';
            }
        // }
        //echo '<table>';
        exit;
        return view('inbox');
    }

    public function compose(){
        //Mail::to("kaviyarasan.sadasivam@excelenciaconsulting.com")->send();
        return view('compose');
        Mail::send('x', ['user' => "dsadsad"], function ($m) {
            $m->from('hello@app.com', 'Your Application');

            $m->to("kaviyarasan.sadasivam@excelenciaconsulting.com", "mail test laravel")->subject('Your Reminder!');
        });
    }

    public function sentmail(Request $request){
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
        try{
            $data=[
            'email' => $email,'body'=>$body];
            Mail::send('x', $data,function ($message) use($email,$subject,$multiplied) {
                $message->to($email);
                $message->subject($subject);
                if(!empty($multiplied)){
                    foreach($multiplied as $file){
                        $message->attach(public_path().'/uploads/'.$file);
                    }
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
        $m = $message->body;
        // show the view and pass the nerd to it
        return view('showmail',compact('m'));
    }

}
