<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 6:54 PM
 */
namespace App\Core\Interfaces;

interface StorageInterface
{
    public function read($index);
    public function write($index, $value);
    public function readAll();
    public function check($index);
    public function remove($index);
    public function removeAll();
}