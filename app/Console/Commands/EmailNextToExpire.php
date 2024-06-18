<?php

namespace App\Console\Commands;

use Utilities;
use Carbon\Carbon;
use App\Subscription;
use Illuminate\Console\Command;
use App\Notifications\EmailExpiredNotification;
use App\Notifications\EmailNextToExpireNotification;

class EmailNextToExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:next-to-expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers email alerts for next to expire subscriptions';

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
                
            $subscriptions = Subscription::where('status', '=', \constSubscription::onGoing)->where('end_date', '=', Carbon::today()->addDays(4))->get();
            
            foreach ($subscriptions as $subscription) {
                $subscription->member->notify(new EmailNextToExpireNotification($subscription, $copyTo));      
            }
        }
        
    }
}
