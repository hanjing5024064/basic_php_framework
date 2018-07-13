<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/13
 * Time: 4:41 PM
 */
namespace App\Model;

use App\Model\Orders;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
        'cellphone',
        'name'
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}