<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/13
 * Time: 4:38 PM
 */
namespace App\Model;

use App\Model\Customers;
use App\Model\Products;
use App\Model\Addresses;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'hash',
        'total',
        'paid',
        'addresses_id'
    ];

    public function address()
    {
        return $this->belongTo(Addresses::class);
    }

    public function customer()
    {
        return $this->belongTo(Customers::class);
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'orders_products')->withPivot('quantity');
    }
}