<?php

namespace App\Http\Controllers;

use Auth;
use JavaScript;
use App\GymiePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\MercadoPagoService;

class GymiePaymentController extends Controller
{

    private $mpService;

    public function __construct(MercadoPagoService $mpService)
    {
        //$this->middleware('auth');
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
            //$payer['email'] = Auth::user()->email;

            $items = [
                [
                    'id' => config('custom.commons.business_name') . '-' . $currentPeriod,
                    'title' => config('custom.commons.app_name') . ' cuota ' . $currentPeriod,
                    'description' => 'Pago cuota del mes ' . $currentPeriod,
                    'unit_price' => config('custom.commons.app_monthly_price'),
                    'quantity' => 1,
                ],
            ];

            return [
                'items' => $items,
                'payer' => $payer
            ];
    }

    public function webHookMp(Request $request) {

        // Obtain the x-signature value from the header
        $xSignature = $_SERVER['HTTP_X_SIGNATURE'];
        $xRequestId = $_SERVER['HTTP_X_REQUEST_ID'];

        Log::info("HTTP_X_SIGNATURE: " . $_SERVER['HTTP_X_SIGNATURE']);
        Log::info("HTTP_X_REQUEST_ID: " . $_SERVER['HTTP_X_REQUEST_ID']);

        // Obtain Query params related to the request URL
        $queryParams = $_GET;

        // Extract the "data.id" from the query params
        $dataID = isset($request->id) ? $request->id : '';
        Log::info("data.id: " . $dataID);

        // Separating the x-signature into parts
        $parts = explode(',', $xSignature);

        // Initializing variables to store ts and hash
        $ts = null;
        $hash = null;

        // Iterate over the values to obtain ts and v1
        foreach ($parts as $part) {
            // Split each part into key and value
            $keyValue = explode('=', $part, 2);
            if (count($keyValue) == 2) {
                $key = trim($keyValue[0]);
                $value = trim($keyValue[1]);
                if ($key === "ts") {
                    $ts = $value;
                } elseif ($key === "v1") {
                    $hash = $value;
                }
            }
        }

        // Obtain the secret key for the user/application from Mercadopago developers site
        $secret = config('services.mercadopago.notification_token');

        // Generate the manifest string
        $manifest = "id:$dataID;request-id:$xRequestId;ts:$ts;";

        // Create an HMAC signature defining the hash type and the key as a byte array
        $sha = hash_hmac('sha256', $manifest, $secret);
        if ($sha === $hash) {
            // HMAC verification passed
            Log::info("HMAC verification passed");
            echo "HMAC verification passed";
        } else {
            // HMAC verification failed
            Log::info("HMAC verification failed");
            echo "HMAC verification failed";
        }

        
    }
}
