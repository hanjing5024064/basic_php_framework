<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 8:43 PM
 */
namespace App\Core\Exceptions;

use Exception;

class OutStockException extends Exception
{
    protected $message = '商品库存不足.';
}