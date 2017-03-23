<?php

namespace Delivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\OrderRepository;
use Delivery\Models\Order;
use Delivery\Presenters\OrderPresenter;

/**
 * Class OrderRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    public function orderByDeliveryman($orderId, $deliverymanId, $presenter = true)
    {
        $result = $this->with(['items', 'client', 'cupom'])->skipPresenter(!$presenter)->findWhere([
            
            'id' => $orderId,
            'user_deliveryman_id' => $deliverymanId
        ]);
        
        if ($result instanceof Collection) {
            $result = $result->first();
        }else{
            if(isset($result['data']) && count($result['data']) === 1){
                $result = [
                    'data' => $result['data'][0]
                ];
            }else{
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Pedido não existe!');
            }
        }
        return $result;
    }

    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function status()
    {
        return $this->model->STATUS;
    }
    public function presenter()
    {
        return OrderPresenter::class;
    }
}
