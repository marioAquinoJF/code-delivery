<?php

namespace Delivery\Http\Controllers;

use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Services\OrderService;
use Delivery\Http\Requests\CheckoutCreateRequest;
use Authorizer;

class ClientCheckoutController extends Controller
{

    /**
     *
     * @var ProductRepository 
     */
    private $productRepository;

    /**
     * @var OrderService
     */
    protected $service;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    function __construct(ProductRepository $productRepository, OrderService $service, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        $client = $this->userRepository->find($userId)->client;
        $orders = $this->service->ordersByClient($client->id)->all();
        return response($orders, 200);
    }

    public function show($orderId)
    {
        $order = $this->service->order($orderId,['items','client','cupom']);
        $order->items->each(function($item){
            $item->product;
        });
        return response($order, 200);
    }

    public function store(CheckoutCreateRequest $request)
    {

        try {

            $data = $request->all();
            $userId = Authorizer::getResourceOwnerId();
            $client = $this->userRepository->find($userId)->client;
            $data['client_id'] = $client->id;
            $order = $this->service->create($data);

            return response($this->service->order($order->id,['items']), 200);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                            'error' => true,
                            'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

}
