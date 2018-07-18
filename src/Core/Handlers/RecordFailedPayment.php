<?php

namespace App\Core\Handlers;

use App\Core\Handlers\HandlerInterface;

class RecordFailedPayment implements HandlerInterface
{
	public function handle($event)
	{
		echo('record failed payment');
		$event->order->payment()->create([
			'failed' => true
			]);
	}
}