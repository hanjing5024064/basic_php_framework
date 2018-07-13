<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 9:49 PM
 */
namespace App\Core\Interfaces;

use Psr\Http\Message\ServerRequestInterface as Request;

interface ValidatorInterface
{
    public function validate(Request $request, array $rules);
}