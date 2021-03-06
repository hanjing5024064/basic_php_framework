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
use App\Model\Payments;
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
        return $this->belongsTo(Addresses::class, 'addresses_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'orders_products')->withPivot('quantity');
    }

    public function payments()
    {
        return $this->hasOne(Payments::class);
    }
}