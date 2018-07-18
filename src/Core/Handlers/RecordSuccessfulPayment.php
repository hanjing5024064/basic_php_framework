<?php

namespace App\Core\Handlers;

use App\Core\Handlers\HandlerInterface;

class RecordSuccessfulPayment implements HandlerInterface
{
	protected $transactionId;
	public function __construct($transactionId)
	{	
		$this->transactionId = $transactionId;
	}

	public function handle($event)
	{
		echo('record successful payment');
		$event->order->payment()->create([
			'failed' => false,
			'transaction_id' => $this->transactionId
			]);
	}
}