<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 10:27 AM
 */
use App\App;
use Slim\Views\Twig;
use App\Core\Middleware\ValidationErrorsMiddleware;

session_start();

require __DIR__.'/../vendor/autoload.php';

$app = new App();

require 'routes.php';
require 'database.php';

$container = $app->getContainer();

$app->add(new ValidationErrorsMiddleware($container->get(Twig::class)));