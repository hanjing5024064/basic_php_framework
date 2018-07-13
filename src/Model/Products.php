<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 12:05 PM
 */
namespace App\Model;

use App\Model\Orders;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $quantity = null;

    public function hasLowStock(){
        if($this->outOfStock()){
            return false;
        }

        return $this->stock <= 3;
    }
    public function outOfStock(){
        return $this->stock === 0;
    }
    public function inStock(){
        return $this->stock >= 1;
    }
    public function hasStock($quantity){
        return $this->stock >= $quantity;
    }

    public function order()
    {
        return $this->belongsToMany(Orders::class, 'orders_products')->withPivot('quantity');
    }
}