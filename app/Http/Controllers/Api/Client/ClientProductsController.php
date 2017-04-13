<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\ProductRepository;
use Authorizer;

class ClientProductsController extends Controller
{

    /**
     *
     * @var ProductRepository 
     */
    private $repository;


    private $with = ['client', 'cupom', 'items'];

    function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = $this->repository->skipPresenter(false)->all();
        return response($products, 200);
    }

   

}
