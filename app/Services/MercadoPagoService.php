<?php

namespace App\Services;

use MercadoPago;
use App\Helpers\Utils;
use App\Utils\FormatterUtilities;


class MercadoPagoService
{
	private $token;
	private $apiUrl;

	public function __construct()
	{
		$this->token = config('services.mercadopago.token');
		$this->apiUrl = config('services.mercadopago.api_url');
	}

	/**Obtiene un pago por id        
	 *
	 * @param string $paymentId
	 * @return object
	 */
	public function getPayment($paymentId) : object
	{
	
		$client = new \GuzzleHttp\Client();
		$response = $client->request(
			'GET', 
			"$this->apiUrl/payments/$paymentId",[
			'headers' => [
				'authorization' => 'Bearer ' . $this->token,
				'Accept'     	=> 'application/json',
				'cache-control' => 'no-cache'
			]
		]);

		return json_decode($response->getBody(), false);
	}

    
    public function getPaymentById($payment_id)
    {
		$AUTHORIZATION = "authorization: Bearer " . $this->token;
		$CAHCE_CONTROL = "cache-control: no-cache";
    	$API_MP = $this->apiUrl;
    	$URL = "$API_MP/payments/$payment_id";
    	$METHOD = "GET";
        $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $URL,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $METHOD,
		  CURLOPT_HTTPHEADER => array(
			$AUTHORIZATION,
		    $CAHCE_CONTROL
		  ),
		));

		$response = curl_exec($curl);
		$error = curl_error($curl);
		curl_close($curl);

		$array = json_decode($response, true);
		$array['additional_info']['items'][0]['unit_price'] = FormatterUtilities::formatPrice($array['additional_info']['items'][0]['unit_price']);

		if ($error) {
		 throw $error;
		} else {
		  return $array;
		}
    }

	/**
	 * Crea una preferencia de pago
	 *
	 * @param [type] $data
	 * @return MercadoPago\Preference
	 */
    public function createPreferenceMP($data) : MercadoPago\Preference
    {
        MercadoPago\SDK::setAccessToken($this->token);
        
		$preference = new MercadoPago\Preference();

		$items = $this->buildItems($data['items']);                                   

		$payer = $this->buildPayer($data['payer']);

        $preference->items = $items;
        $preference->payer = $payer;
        $preference->save();

        return $preference;
    }

	private function buildItems($elements)
	{
		$items = collect([]);
		foreach ($elements as $e) {
			$item = new MercadoPago\Item();
			$item->id = $e['id'];
			$item->title = $e['title'];
			$item->quantity = $e['quantity'];
			$item->description = $e['description'];
			$item->unit_price = FormatterUtilities::formatPrice($e['unit_price']);
			$items->push($item);
		}

		return $items->toArray();

	}

	private function buildPayer($payerData)
	{
		$payer = new MercadoPago\Payer();
        $payer->name = $payerData['name'];
        $payer->email = $payerData['email'];

		return $payer;
	}
}