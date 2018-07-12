<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:29 AM
 */
$app->get('/github/basic_php_framework.git/', ['App\Controller\HomeController', 'index'])->setName('home');