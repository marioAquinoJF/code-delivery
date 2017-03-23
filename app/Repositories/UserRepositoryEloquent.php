<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\UserRepository;
use Delivery\Models\User;
use Delivery\Validators\UserValidator;
use Delivery\Criteria\DeliveryManCriteriaCriteria;
use Delivery\Presenters\UserPresenter;

/**
 * Class UserRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    protected $skipPresenter = true;

    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function deliveryMan()
    {
        $this->pushCriteria(app(DeliveryManCriteriaCriteria::class));
        return $this;
    }

    public function presenter()
    {
        return UserPresenter::class;
    }

}
