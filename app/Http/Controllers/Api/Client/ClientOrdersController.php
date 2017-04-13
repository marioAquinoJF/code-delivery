<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Controllers\Controller;
use Delivery\Services\OrderService;

class ClientOrdersController extends Controller
{

    /**
     *
     * @var OrderService
     */
    private $service;

    function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        $client = $this->userRepository->find($userId)->client;
        $orders = $this->service->ordersByClient($client->id)->all();
        return response($orders, 200);
    }

}
