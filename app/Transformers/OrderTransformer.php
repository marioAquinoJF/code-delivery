<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{

    //protected $defaultIncludes = ['cupom', 'items'];
    protected $availableIncludes = ['cupom', 'items', 'client','deliveryman'];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id' => (int) $model->id,
            'total' => (float) $model->total,
            'status' => $model::$STATUS[$model->status],
            'total_items'=>$model->items->count(),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCupom(Order $model)
    {
        // dd($model->cupom());
        if ($model->cupom === null) {
            return null;
        }
        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeClient(Order $model)
    {
        // dd($model->cupom());
        if ($model->cupom === null) {
            return null;
        }
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeItems(Order $model)
    {

        return $this->collection($model->items, new OrderItemTransformer());
    }

    public function includeDeliveryman(Order $model)
    {
        if ($model->deliveryMan) {
            return $this->item($model->deliveryMan, new DeliverymanTranformer());
        }
    }

}
