<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 12:05 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'failed',
        'transaction_id'
    ];
}
