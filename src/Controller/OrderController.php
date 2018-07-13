<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 11:30 AM
 */
namespace App\Controller;

use App\Model\Addresses;
use App\Model\Customers;
use App\Model\Orders;
use Slim\Router;
use Slim\Views\Twig;
use App\Model\Products;
use App\Core\Utility\Basket;
use App\Core\Utility\Form\OrderForm;
use App\Core\Interfaces\ValidatorInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OrderController
{
    protected $basket;
    protected $product;
    protected $router;
    protected $validator;

    public function __construct(Basket $basket, Products $product, Router $router, ValidatorInterface $validator)
    {
        $this->basket = $basket;
        $this->product = $product;
        $this->router = $router;
        $this->validator = $validator;
    }

    public function index(Response $response, Twig $view)
    {
        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        return $view->render($response, 'order/index.twig');
    }


    public function create(Request $request, Response $response, Twig $view, Customers $customer, Addresses $address, Orders $order)
    {
        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        $validatResult = $this->validator->validate($request, OrderForm::rules());

        if(!$validatResult){//校验失败
            return $response->withRedirect($this->router->pathFor('order.index'));
        }

        //保存订单
        $hash = bin2hex(random_bytes(32));
        $customer = $customer->firstOrCreate([
            'cellphone' => $request->getParam('cellphone'),
            'name' => $request->getParam('name'),
        ]);

        $address = $address->firstOrCreate([
            'address' => $request->getParam('address'),
            'city' => $request->getParam('city'),
        ]);

        $order = $customer->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'total' => $this->basket->subTotal() + 5,
            'addresses_id' => $address->id,
        ]);

        $allItems = $this->basket->all();
        $order->products()->saveMany(
            $allItems,
            // ['quantity' => 1,5,3]
            $this->getQuantities($allItems)
        );
    }

    protected function getQuantities($items)
    {
        $quantity = [];

        foreach($items as $item){
            $quantity[] = ['quantity' => $item->quantity];
        }

        return $quantity;
    }
}