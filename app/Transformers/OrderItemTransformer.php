<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['product'];

    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'id' => (int) $model->id,
            'price' => $model->price,
            'quantity' => $model->quantity,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
    public function includeProduct(OrderItem $model)
    {
        return $this->item($model->product, new ProductTransformer());
    }

}
