<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Email;
use App\Sentmaillist;
use Carbon\Carbon;
use Log;
class sentmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sentmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve sentmail to DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Get the last time email get updated
        // $email=Sentmaillist::orderBy('created_at','DESC')->select('created_at')->first();
        // $last_date=$email['created_at'];
        //echo $last_date;
        //exit; 
        //retrieve gmail inbox and insert into DB
        $oClient = Client::account();
        $oClient->connect();
        $afolder = $oClient->getFolders();
        //echo "<pre>";print_r($afolder);exit;
        //$aMessage=$afolder[1]->children[3]->getMessages();
        Sentmaillist::where('received_date','>',Carbon::yesterday())->delete();
        $aMessage=$afolder[1]->children[3]->query()->since(Carbon::now()->subDays(1))->get();
        foreach($aMessage as $oMessage){
            try{
                $email=new Sentmaillist();
                $email->subject=$oMessage->getSubject();
                $email->body=$oMessage->getHTMLBody();
                $email->from=$oMessage->getTo()[0]->personal;
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
                //echo "Error in sentmail cron".$e;
                Log::error('Error in sentmail cronjob.'.$e);
            }
        }
    }
}
