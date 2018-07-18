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
use App\Model\Orders;
use Braintree\Gateway;
use App\Model\Products;
use App\Model\Addresses;
use App\Model\Customers;
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

    public function show($hash, Request $request, Response $response, Twig $view, Orders $order)
    {
        $order = $order->with(['addresses', 'products'])->where('hash', $hash)->first();

        if(!$order){
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $view->render($response, 'order/show.twig', [
            'order' => $order,
        ]);
    }

    public function create(Request $request, Response $response, Twig $view, Customers $customer, Addresses $address, Orders $order, Gateway $gateway)
    {
        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            return $response->withRedirect($this->router->pathFor('cart.index'));
        }

        //非支付则返回订单首页
        if(!$request->getParam('payment_method_nonce')){
            return $request->withRedirect($this->router->pathFor('order.index'));
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

        /*
        通过braintree实现支付
        */
        $amount = $this->basket->subTotal() + 5;
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $request->getParam('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        var_dump($result);
        if ($result->success) {
            // See $result->transaction for details
        } else {
            // Handle errors
        }
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