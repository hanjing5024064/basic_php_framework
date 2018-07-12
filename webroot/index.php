<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 10:30 AM
 */
require __DIR__.'/../config/bootstrap.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/github/basic_php_framework.git/', function (Request $request, Response $response) {
    return $response->getBody()->write('app start');
});

$app->run();