<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 7:03 PM
 */
namespace App\Core\Utility;

use App\Model\Products;
use App\Core\Interfaces\StorageInterface;

class Basket
{
    protected $storage;

    protected $product;

    public function __construct(StorageInterface $storage, Products $product)
    {
        $this->storage = $storage;
        $this->product = $product;
    }
}