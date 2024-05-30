<?php

namespace App\Services;

use MercadoPago;
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