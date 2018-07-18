<?php

namespace App\Core\Handlers;

use App\Core\Handlers\HandlerInterface;

class EmptyBasket implements HandlerInterface
{
	public function handle($event)
	{
		echo('empty basket');
		$event->basket->clear();
	}
}