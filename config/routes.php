<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:29 AM
 */
$basePath = '/github/basic_php_framework.git/';//生产环境设置为'/'

$app->get($basePath, ['App\Controller\HomeController', 'index'])->setName('home');

$app->get($basePath.'product/{slug}', ['App\Controller\ProductController', 'view'])->setName('product.view');