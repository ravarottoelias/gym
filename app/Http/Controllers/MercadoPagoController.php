<?php


namespace App\Http\Controllers;

use JavaScript;
use Illuminate\Support\Carbon;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    private $mpService;

    public function __construct(MercadoPagoService $mpService)
    {
        $this->middleware('auth');
        $this->mpService = $mpService;
    }

    public function payment()
    {
        $payer = [];
        $payer['name'] = Auth::user()->name;
        $payer['email'] = Auth::user()->email;

        $now = Carbon::now();
        $date = $now->format('M/Y');
        $items = [
            [
                'id' => config('custom.commons.business_name'),
                'title' => config('custom.commons.app_name') . ' cuota ' . $date,
                'description' => 'Pago cuota del mes ' . $date,
                'unit_price' => config('custom.commons.app_monthly_price'),
                'quantity' => 1,
            ],
        ];

        $data = [
            'items' => $items,
            'payer' => $payer
        ];

        
        $preference = $this->mpService->createPreferenceMP($data);
        //dd($preference);
        
        JavaScript::put([
            'mpPublicKey' => config('services.mercadopago.key'),
            'preferenceMPID' => $preference->id,
        ]);
        return view('mp-payments.index');
    }
}
