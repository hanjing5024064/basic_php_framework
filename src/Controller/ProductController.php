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
use App\Model\Products;
use Psr\Http\Message\ResponseInterface as Response;

class ProductController
{
    protected $view;
    protected $router;

    public function __construct(Twig $view, Router $router){
        $this->view = $view;
        $this->router = $router;
    }


    public function view($slug, Response $response, Products $products){
        $product = $products->where('slug', $slug)->first();

        if(!$product){
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $this->view->render($response, 'Product/view.twig', [
            'product' => $product,
        ]);
    }
}