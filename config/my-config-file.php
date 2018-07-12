<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:16 AM
 */
use Slim\App;
use Slim\Views\Twig;
use function DI\get;

return [
    'settings.displayErrorDetails' => true,
    Twig::class => function (App $app) {//https://github.com/slimphp/Twig-View and http://php-di.org/doc/frameworks/slim.html
        $c = $app->getContainer();
        $twig = new \Slim\Views\Twig(__DIR__.'/../src/Template', [
            'cache' => false//'path/to/cache'
        ]);

        $twig->addExtension(new \Slim\Views\TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        return $twig;
    },
];