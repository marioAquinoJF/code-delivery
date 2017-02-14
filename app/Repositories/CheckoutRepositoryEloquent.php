<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\CheckoutRepository;
use Delivery\Models\Checkout;
use Delivery\Validators\CheckoutValidator;

/**
 * Class CheckoutRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class CheckoutRepositoryEloquent extends BaseRepository implements CheckoutRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Checkout::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
