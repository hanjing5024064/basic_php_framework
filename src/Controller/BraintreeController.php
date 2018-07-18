<?php

namespace App\Controller;

use Braintree\Gateway;
use Psr\Http\Message\ResponseInterface as Response;

class BraintreeController
{
	public function token(Response $response, Gateway $gateway)
	{
		$clientToken = $gateway->clientToken()->generate();

		return $response->withJson([
			'token' => $clientToken
			]);
	}
}