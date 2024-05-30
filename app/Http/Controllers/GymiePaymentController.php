<?php

namespace App\Http\Controllers;

use Auth;
use JavaScript;
use App\GymiePayment;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use App\Services\MercadoPagoService;

class GymiePaymentController extends Controller
{

    private $mpService;

    public function __construct(MercadoPagoService $mpService)
    {
        $this->middleware('auth');
        $this->mpService = $mpService;
    }

    public function payment()
    {
        $now = Carbon::now();
        $currentPeriod = $now->format('M/Y');
        $pastPeriod = $now->subMonth()->format('M/Y');

        $preferenceID = null;

        $gymiePayments = GymiePayment::orderBy('created_at', 'DESC')->paginate(10);

      
        if($gymiePayments->count() && ($gymiePayments->first()->period == $pastPeriod && $gymiePayments->first()->status == 'approved'))
        {
            $balance = 0;
        } else {
            $balance = config('custom.commons.app_monthly_price');

            $data = $this->buildPreferenceData($currentPeriod);

            $preference = $this->mpService->createPreferenceMP($data);
            $preferenceID = $preference->id;
        }    
    

        JavaScript::put([
            'mpPublicKey' => config('services.mercadopago.key'),
            'preferenceMPID' => $preferenceID,
        ]);

        return view('mp-payments.index', compact('gymiePayments', 'balance', 'currentPeriod', 'pastPeriod'));
    }

    private function buildPreferenceData($currentPeriod) : array {
            $payer = [];
            $payer['name'] = Auth::user()->name;
            $payer['email'] = Auth::user()->email;

            $items = [
                [
                    'id' => config('custom.commons.business_name') . '-' . $currentPeriod,
                    'title' => config('custom.commons.app_name') . ' cuota ' . $currentPeriod,
                    'description' => $currentPeriod,
                    'unit_price' => config('custom.commons.app_monthly_price'),
                    'quantity' => 1,
                ],
            ];

            return [
                'items' => $items,
                'payer' => $payer
            ];
    }

    function show(string $id) : View {

        $payment = $this->mpService->getPayment($id);
        
        $payment->date_created =  Carbon::parse($payment->date_created)->format('d/m/Y H:m:s');


        return view('mp-payments.show', compact('payment'));
    }
}
