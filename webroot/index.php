<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 10:30 AM
 */
require __DIR__.'/../config/bootstrap.php';

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

$app->get('/github/basic_php_framework.git/', function (Response $response, Twig $twig) {
    return $twig->render($response, 'home.twig');
});

$app->run();