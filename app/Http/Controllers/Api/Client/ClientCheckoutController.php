<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
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
    private $service;

    /**
     * @var UserRepository
     */
    private $userRepository;
    private $with = ['client', 'cupom', 'items'];

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
        $orders = $this->service->ordersByClient($client->id, $this->with, true)->all();
        return response($orders, 200);
    }

    public function show($orderId)
    {
        return $this->service
                ->repository()
                ->skipPresenter(false)
                ->with($this->with)
                ->find($orderId);
    }

    public function store(CheckoutCreateRequest $request)
    {


            $data = $request->all();

            $userId = Authorizer::getResourceOwnerId();
            $client = $this->userRepository->find($userId)->client;
            $data['client_id'] = $client->id;
            $order = $this->service->create($data);

            return response($this->service
                ->repository()
                ->skipPresenter(true)
                ->with($this->with)
                ->find($order->id), 200);
       
    }

}
