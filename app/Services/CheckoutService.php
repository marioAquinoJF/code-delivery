<?php

namespace Delivery\Services;

use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;

class CheckoutService
{

    /**
     *
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     *
     * @var UserRepository 
     */
    protected $userRepository;

    /**
     *
     * @var OrderRepository 
     */
    protected $orderRepository;

    function __construct(ProductRepository $productRepository, UserRepository $userRepository, OrderRepository $orderRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    public function update(array $data, $id)
    {
        
    }

    public function create(array $data)
    {
        
    }
    
    public function productList(){
        return $this->productRepository->listing();
    }

}
