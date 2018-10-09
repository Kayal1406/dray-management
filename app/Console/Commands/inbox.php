<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Email;
use Carbon\Carbon;
use Log;
class inbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:inbox';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert inbox email into DB hourly';

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
        //Delete  the yesterday email
        Email::where('received_date','>',Carbon::yesterday())->delete();
        
        //retrieve gmail inbox and insert into DB
        $oClient = Client::account();
        $afolder=$oClient->getFolder('INBOX');
        //$aMessage=$afolder->messages()->get();
        $aMessage=$afolder->query()->since(Carbon::now()->subDays(1))->get();
        
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
                //Fetching attachments
                $aAttachment->each(function ($oAttachment) {
                    $oAttachment->save();
                });
                $email->save();
            }
            catch (\Exception $e) {
                Log::error('Error in inbox cronjob.'.$e);
            }
        }

    }
}
