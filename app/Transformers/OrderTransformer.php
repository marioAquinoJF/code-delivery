<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Entities\Order;

/**
 * Class OrderTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
