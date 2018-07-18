<?php

namespace App\Controller;

use Braintree\Gateway;
use Psr\Http\Message\ResponseInterface as Response;

class BraintreeController
{
	public function token(Response $response)
	{
		$gateway = new Gateway([
		  'environment' => 'sandbox',
		  'merchantId' => 'rdnhxtnwc75bxmc2',
		  'publicKey' => 'dj7sjg4kpftrv8hm',
		  'privateKey' => '29a36a23c5e6c4c012346808d6e757e7'
		]);

		$clientToken = $gateway->clientToken()->generate();

		return $response->withJson([
			'token' => $clientToken
			]);
	}
}