<?php

namespace App\Core\Handlers;

use App\Core\Handlers\HandlerInterface;

class MarkOrderPaid implements HandlerInterface
{
	public function handle($event)
	{
		echo('mark order paid');
		$event->order->update([
			'paid' => true,
			]);
	}
}