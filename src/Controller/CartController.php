<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 4:18 PM
 */
namespace App\Controller;

use Slim\Router;
use Slim\Views\Twig;
use App\Model\Products;
use App\Core\Utility\Basket;
use Psr\Http\Message\ResponseInterface as Response;

class CartController
{
    protected $basket;
    protected $product;

    public function __construct(Basket $basket, Products $products)
    {
        $this->basket = $basket;
        $this->product = $products;
    }

    public function index(Response $response, Twig $view){
        return $view->render($response, 'cart/index.twig');
    }

    public function add($slug, $quantity, Response $response, Router $router)
    {
        $product = $this->product->where('slug', $slug)->first();

        if(!$product){
            return $response->withRedirect($router->pathFor('home'));
        }

        die('add');
    }

}
