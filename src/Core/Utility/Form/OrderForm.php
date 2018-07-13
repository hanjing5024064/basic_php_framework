<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/13
 * Time: 9:29 AM
 */
namespace App\Core\Utility\Form;

use Respect\Validation\Validator as v;

class OrderForm
{
    public static function rules()
    {
        return [
            'cellphone' => v::phone(),
            'name' => v::alpha(' '),
            'address1' => v::alnum(' -'),
            'address2' => v::optional(v::alnum(' -')),
            'city' => v::alnum(' '),
        ];
    }
}
