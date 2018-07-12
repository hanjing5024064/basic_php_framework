<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:30 AM
 */
namespace App\Controller;

use Slim\Views\Twig;
use App\Model\Products;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    public function index(Request $request, Response $response, Twig $view, Products $products){

        $products = $products->get();

        return $view->render($response, 'home.twig', [
            'products' => $products
        ]);
    }
}