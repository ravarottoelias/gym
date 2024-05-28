<?php


namespace App\Http\Controllers;

use App\GymiePayment;
use JavaScript;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\MercadoPagoService;
use Exception;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    private $mpService;

    public function __construct(MercadoPagoService $mpService)
    {
        $this->mpService = $mpService;
    }

    public function webHookMp(Request $request) {
        try {
            Log::info("MercadoPagoController::webHookMp Procesando notificación ...");
            $isValid = null;//$this->validateOriginRequest($request);

            $paymentData = $this->mpService->getPayment($request->data['id']);

            $item = $paymentData->additional_info->items[0];

            Log::info("MercadoPagoController::webHookMp Registrando pago #$paymentData->id ...");
            GymiePayment::updateOrCreate(
                ['payment_identifier' => $paymentData->id],
                [
                    'payment_identifier' => $paymentData->id,
                    'status' => $paymentData->status,
                    'period' => $item->description != null ? $item->description : $item->title,
                    'gateway' => 'MercadoPago',
                    'payload' => trim(json_encode($paymentData)),
                    'notification_payload' => trim(json_encode($request->all())),
                    'notification_verified' => $isValid,
                ]
            );
            Log::info("MercadoPagoController::webHookMp success.");
            return response()->json(['success' => 'success'], 200);  
        } catch (Exception $ex) {
            Log::error("MercadoPagoController::webHookMp: falied.");
            Log::error($ex);
            return response()->json(['success' => 'false'], 500);  
        }
        

    }

    private function validateOriginRequest(Request $request) {
        try {
            // Obtain the x-signature value from the header
            $xSignature = $_SERVER['HTTP_X_SIGNATURE'];
            $xRequestId = $_SERVER['HTTP_X_REQUEST_ID'];

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
                Log::info("HMAC verification passed");
                return true;
            } else {
                Log::info("HMAC verification failed");
                return false;
            }
        } catch(Exception $ex) {
            Log::error("Error al intentar validar origen del pago id: " . $request->data['id']);
            Log::error($ex);

            return null;
        }
    }
}
