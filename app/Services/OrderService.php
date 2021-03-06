<?php

namespace Delivery\Services;

use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\CupomRepository;
use Delivery\Models\Order;

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
            if (isset($data['cupom_id'])){
                unset($data['cupom_id']);
            }

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
                $item['price'] = (float) $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += ($item['price'] * (float) $item['quantity']);
            }
            $order->total = $total;
            if (isset($cupom)) {
                $order->total = $total - $cupom->value;
                $cupom->order_id = $order->id;
                $cupom->save();
            }

            $order->save();
            \DB::commit();
            return $order;
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    public function ordersByClient($clientId, $with = [], $presenter = true)
    {
        return $this->orderRepository->with($with)->skipPresenter(!$presenter)->scopeQuery(function($query) use ($clientId) {
                    return $query->where('client_id', '=', $clientId);
                });
    }

    public function ordersByDeliveryman($deliverymanId, $with = [], $presenter = true)
    {
        return $this->orderRepository->with($with)->skipPresenter(!$presenter)->scopeQuery(function($query) use ($deliverymanId) {
                    return $query->where('user_deliveryman_id', '=', $deliverymanId);
                });
    }

    public function order($orderId, array $relations = [])
    {
        if (count($relations) > 0):
            return $this->orderRepository->with($relations)->find($orderId);
        endif;
        return $this->orderRepository->find($orderId);
    }

    public function updateStatus($orderId, $deliveryman, $status)
    {
        $order = $this->orderRepository->orderByDeliveryman($orderId, $deliveryman);

        if ($order instanceof Order) {
            $order->status = $status;
            $order->save();
            return $order;
        }
        return false;
    }

    public function repository()
    {
        return $this->orderRepository;
    }

}
