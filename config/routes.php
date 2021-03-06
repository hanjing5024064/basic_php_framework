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
$app->get($basePath.'cart', ['App\Controller\CartController', 'index'])->setName('cart.index');
$app->get($basePath.'cart/add/{slug}/{quantity}', ['App\Controller\CartController', 'add'])->setName('cart.add');
$app->post($basePath.'/cart/update/{slug}', ['App\Controller\CartController', 'update'])->setName('cart.update');

$app->get($basePath.'order', ['App\Controller\OrderController', 'index'])->setName('order.index');
$app->post($basePath.'order', ['App\Controller\OrderController', 'create'])->setName('order.create');
$app->get($basePath.'order/{hash}', ['App\Controller\OrderController', 'show'])->setName('order.show');

$app->get($basePath.'braintree/token', ['App\Controller\BraintreeController', 'token'])->setName('braintree.token');