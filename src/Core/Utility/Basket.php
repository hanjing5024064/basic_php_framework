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
use App\Core\Exceptions\OutStockException;

class Basket
{
    protected $storage;

    protected $product;

    public function __construct(StorageInterface $storage, Products $product)
    {
        $this->storage = $storage;
        $this->product = $product;
    }

    public function add(Products $product, $quantity)
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->update($product, $quantity);
    }

    public function update(Products $product, $quantity)
    {
        //查看是否有库存
        if (!$this->product->find($product->id)->hasStock($quantity)) {
            throw new OutStockException;
        }

        //购物车中商品数量为0, 移除该商品
        if ($quantity == 0) {
            $this->remove($product);
            return;
        }

        //更新购物车中商品数量
        $this->storage->write($product->id, [
            'product_id' => (int)$product->id,
            'quantity' => (int)$quantity,
        ]);
    }

    public function remove(Products $product)
    {
        $this->storage->remove($product->id);
    }

    public function has(Products $product)
    {
        return $this->storage->check($product->id);
    }

    public function get(Products $product)
    {
        return $this->storage->read($product->id);
    }

    public function clear()
    {
        $this->storage->removeAll();
    }

    public function all()
    {
        $ids = [];
        $items = [];

        foreach ($this->storage->readAll() as $product) {
            $ids[] = $product['product_id'];
        }

        $products = $this->product->find($ids);

        foreach ($products as $product) {
            $product->quantity = $this->get($product)['quantity'];
            $items[] = $product;
        }

        return $items;
    }

    public function itemCount()
    {
        return count($this->storage);
    }


    public function subTotal()
    {
        $total = 0;

        foreach ($this->all() as $item) {
            if ($item->outOfStock()) {
                continue;
            }

            $total = $total + $item->price * $item->quantity;
        }

        return $total;
    }

    public function refresh()
    {
        foreach ($this->all() as $item) {
            if (!$item->hasStock($item->quantity)) {
                $this->update($item, $item->stock);
            }
        }
    }

}