<?php

namespace App\Core\Handlers;

use App\Core\Handlers\HandlerInterface;

class UpdateStock implements HandlerInterface
{
	public function handle($event)
	{
		echo('update stock');
		foreach ($event->basket->all() as $product) {
			$product->decrement('stock', $product->quantity);
		}
	}
}