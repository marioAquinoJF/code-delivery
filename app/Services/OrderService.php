<?php

namespace Delivery\Services;

use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\CupomRepository;

class OrderService
{

    /**
     *
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     *
     * @var orderRepository 
     */
    protected $orderRepository;

    /**
     *
     * @var CupomRepository 
     */
    protected $cupomRepository;

    function __construct(ProductRepository $productRepository, OrderRepository $orderRepository, CupomRepository $cupomRepository)
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        
        try {
            $data['status'] = 0;
            if (isset($data['cupom_code'])) {
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom_code']);
            }
            $items = $data['items'];
            unset($data['items']);
            $order = $this->orderRepository->create($data);
            
            $total = 0;
            foreach ($items as $item) {
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);                
                $total += $item['price'] * $item['quantity'];
            }
            $order->total = $total;
            if (isset($cupom)) {
                $order->total = $total - $cupom->value;
            }
            
            $order->save();
            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }
    public function ordersByClient($clientId)
    {
        return $this->orderRepository->scopeQuery(function($query) use ($clientId){
            return $query->where('client_id','=',$clientId);
        });
    }
}
