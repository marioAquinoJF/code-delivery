<?php

namespace Delivery\Services;

use Delivery\Repositories\ClientRepository;
use Delivery\Repositories\UserRepository;

class ClientService
{

    /**
     *
     * @var ClientRepository
     */
    protected $repository;

    /**
     *
     * @var UserRepository 
     */
    protected $userRepository;

    function __construct(ClientRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $client = $this->repository->update($data, $id);
        $idu = $client->user->id;
        $this->userRepository->update($data['user'], $idu);
        return $client;
    }

    public function create(array $data)
    {
        $data['user']['password'] = bcrypt(123456);
        $user = $this->userRepository->create($data['user']);
        $data['user_id'] = $user->id;
        $client = $this->repository->create($data);

        return $client;
    }

}
