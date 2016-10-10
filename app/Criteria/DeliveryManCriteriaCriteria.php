<?php

namespace Delivery\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class DeliveryManCriteriaCriteria
 * @package namespace Delivery\Criteria;
 */
class DeliveryManCriteriaCriteria implements CriteriaInterface
{

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('role', '=', 'deliveryMan')->orderBy('name');
        return $model;
    }

}
