<?php

namespace Delivery\Http\Controllers\Api;

use Illuminate\Http\Request;
use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use Authorizer;

class HomeController extends Controller
{

    private $userRepository;

    function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->userRepository->skipPresenter(false)->find($userId);
    }

}
