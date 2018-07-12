<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:30 AM
 */
namespace App\Controller;

use Slim\Router;
use Slim\Views\Twig;
use App\Core\Utility\Basket;
use App\Model\Products;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OrderController
{
    protected $basket;
    protected $product;
    protected $router;

    public function __construct(Basket $basket, Products $product, Router $router)
    {
        $this->basket = $basket;
        $this->product = $product;
        $this->router = $router;
    }

    public function index(Response $response, Twig $view)
    {
        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $view->render($response, 'order/index.twig');
    }


    public function create(Response $response, Twig $view)
    {
        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $view->render($response, 'order/index.twig');
    }
}