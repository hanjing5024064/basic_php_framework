<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 6:59 PM
 */
namespace App\Core;

use Countable;
use App\Core\Interfaces\StorageInterface;

class SessionStorage implements StorageInterface, Countable
{
    protected $bucketName;

    public function __construct($bucketName = 'default')
    {
        if(!isset($_SESSION[$bucketName])){
            $_SESSION[$bucketName] = [];
        }

        $this->bucketName = $bucketName;
    }

    public function read($index)
    {
        if($this->check($index)){
            return $_SESSION[$this->bucketName][$index];
        }

        return null;
    }

    public function write($index, $value)
    {
        $_SESSION[$this->bucketName][$index] = $value;
    }

    public function readAll()
    {
        return $_SESSION[$this->bucketName];
    }

    public function check($index)
    {
        return isset($_SESSION[$this->bucketName][$index]);
    }

    public function remove($index)
    {
        if($this->check($index)){
            unset($_SESSION[$this->bucketName][$index]);
        }
    }

    public function removeAll()
    {
        unset($_SESSION[$this->bucketName]);
    }

    public function count()
    {
        return count($this->readAll());
    }
}