<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:16 AM
 */
use Slim\Views\Twig;
use function DI\get;
use App\Model\Products;
use App\Core\SessionStorage;
use App\Core\Utility\Basket;
use Slim\Views\TwigExtension;
use Interop\Container\ContainerInterface;
use App\Core\Interfaces\StorageInterface;
use App\Core\Interfaces\ValidatorInterface;
use App\Core\Utility\Validator;

return [
    'settings.displayErrorDetails' => true,

    'router' => get(Slim\Router::class),

    Twig::class => function (ContainerInterface $c) {
        $twig = new Twig(__DIR__ . '/../src/Template', [
            'cache' => false
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('basket', $c->get(Basket::class));

        return $twig;
    },

    ValidatorInterface::class => function (){
        return new Validator();
    },

    StorageInterface::class => function () {
        return new SessionStorage('bpf');
    },
    Basket::class => function (ContainerInterface $c) {
        return new Basket(
            $c->get(SessionStorage::class),
            $c->get(Products::class)
        );
    },

    Products::class => function () {
        return new Products();
    }
];