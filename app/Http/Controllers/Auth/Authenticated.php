<?php

namespace Delivery\Http\Controllers\Auth;

use Delivery\Models\User;
use Illuminate\Support\Facades\Request;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use Authorizer;

class Authenticated extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('oauth');
        $this->userRepository = $userRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function userAuthenticated()
    {
        return $this->userRepository->find(Authorizer::getResourceOwnerId());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    public function postRegister(Request $request)
    {
        return redirect('/admin/clients/create');
    }

}
