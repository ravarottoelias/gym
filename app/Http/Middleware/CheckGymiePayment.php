<?php

namespace App\Http\Middleware;

use Closure;
use App\GymiePayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CheckGymiePayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('custom.commons.isGymiePaymentEnabled')){
            $now = Carbon::now();
            $pastPeriod = $now->subMonth()->format('M/Y');

            $lastPayment = Cache::remember('gymieLastPayment', 5, function () use ($pastPeriod) {
                Log::info("message");
                $payment = GymiePayment::where('status', 'approved')
                    ->where('period', $pastPeriod)
                    ->orderBy('created_at', 'DESC')
                    ->first();

                if($payment == null){
                    return 0;
                }
            });

            
            if($lastPayment == 0){
                if($now->day > 10)
                    return redirect()->route('gymie_payments');
                return $next($request);
            }
        }

        return $next($request);
    }
}
