<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 10:30 AM
 */
require __DIR__.'/../config/bootstrap.php';

$app->get('/github/basic_php_framework.git/', function ($request, $response, $args) {
    return $response->getBody()->write('app start');
});

$app->run();