<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Client;

/**
 * Class ClientTransformer
 * @package namespace Delivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->user->name,
            'email' => $model->user->email,
            'address' => $model->address,
            'zipcode' => $model->zipcode,
            'city' => $model->city,
            'state' => $model->state
        ];
    }

}
