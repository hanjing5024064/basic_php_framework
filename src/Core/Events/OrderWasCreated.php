<?php

namespace App\Core\Events;

use App\Model\Orders;
use App\Core\Utility\Basket;

class OrderWasCreated extends Event
{
	public $order;
	public $basket;

	public function __construct(Orders $order, Basket $basket)
	{
		$this->order = $order;
		$this->basket = $basket;
	}
}