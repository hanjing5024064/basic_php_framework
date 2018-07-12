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
use Slim\Views\TwigExtension;
use Interop\Container\ContainerInterface;

return [
    'settings.displayErrorDetails' => true,

    'router' => get(Slim\Router::class),

    Twig::class => function(ContainerInterface $c){
        $twig = new Twig(__DIR__.'/../src/Template', [
            'cache' => false
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        return $twig;
    },


    Products::class => function(){
        return new Products();
    }
];