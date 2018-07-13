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
use App\Core\Exceptions\OutStockException;
use Psr\Http\Message\RequestInterface as Request;
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
        $this->basket->refresh();

        return $view->render($response, 'cart/index.twig');
    }

    public function add($slug, $quantity, Response $response, Router $router, Twig $view)
    {
        $product = $this->product->where('slug', $slug)->first();

        if(!$product){
            return $response->withRedirect($router->pathFor('home'));
        }

        try{
            $this->basket->add($product, $quantity);
        }catch (OutStockException $e){
            return $response->withRedirect($router->pathFor('product.view', [
                'slug' => $slug,
            ]));
        }

        return $response->withRedirect($router->pathFor('cart.index'));
    }

    public function update($slug, Request $request, Response $response, Router $router)
    {
        $product = $this->product->where('slug', $slug)->first();

        if(!$product){
            return $response->withRedirect($router->pathFor('home'));
        }

        try{
            $this->basket->update($product, $request->getParam('quantity'));
        }catch (OutStockException $e){
            //
        }

        return $response->withRedirect($router->pathFor('cart.index'));
    }
}
