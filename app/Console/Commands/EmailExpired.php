<?php

namespace App\Console\Commands;

use App\User;
use Utilities;
use App\Member;
use Carbon\Carbon;
use App\SmsTrigger;
use App\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Notifications\EmailExpiredNotification;

class EmailExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers email alerts for expired subscriptions';

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
        $allowEmails = Utilities::getSetting('email');
        if($allowEmails == true) {
            $copyTo = array();
            if(Utilities::getSetting('enabled_email_cc') == true) 
                array_push($copyTo, trim(Utilities::getSetting('primary_email')));
                
            $subscriptions = Subscription::where('status', '=', \constSubscription::Expired)->where('end_date', '=', Carbon::today()->subDay())->get();
            
            foreach ($subscriptions as $subscription) {
                $subscription->member->notify(new EmailExpiredNotification($subscription, $copyTo));      
            }
        }
        
    }
}
