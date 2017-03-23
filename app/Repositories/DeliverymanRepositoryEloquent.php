<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\DeliverymanRepository;
use Delivery\Models\Deliveryman;
use Delivery\Validators\DeliverymanValidator;

/**
 * Class DeliverymanRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class DeliverymanRepositoryEloquent extends BaseRepository implements DeliverymanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Deliveryman::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
