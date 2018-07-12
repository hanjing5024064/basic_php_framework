<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 12:09 PM
 */
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => 'MyMac#123',
    'database' => 'base_php_fw',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci'
]);

$capsule->bootEloquent();