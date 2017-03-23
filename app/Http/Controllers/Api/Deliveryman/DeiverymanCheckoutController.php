<?php

namespace Delivery\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Services\OrderService;
use Delivery\Http\Requests\CheckoutCreateRequest;
use Authorizer;

class DeiverymanCheckoutController extends Controller
{

    /**
     * @var OrderService
     */
    protected $service;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    private $with = ['client', 'cupom', 'items'];
    function __construct(OrderService $service, UserRepository $userRepository)
    {
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        $orders = $this->service->ordersByDeliveryman($userId, $this->with, true)->paginate();
        return response($orders, 200);
    }

    public function show($orderId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->service->repository()->orderByDeliveryman($orderId, $userId);
    }

    public function updateStatus(Request $request, $id)
    {
        $userId = Authorizer::getResourceOwnerId();
        $order = $this->service->updateStatus($id, $userId, $request->get('status'));
        
        if ($order) {
            return $order;
        }
        return abort(400, 'Pedido não encontrado');
    }

    /*
      public function store(CheckoutCreateRequest $request)
      {

      try {

      $data = $request->all();
      $userId = Authorizer::getResourceOwnerId();
      $client = $this->userRepository->find($userId)->client;
      $data['client_id'] = $client->id;
      $order = $this->service->create($data);

      return response($this->service->order($order->id, ['items']), 200);
      } catch (ValidatorException $e) {
      if ($request->wantsJson()) {
      return response()->json([
      'error' => true,
      'message' => $e->getMessageBag()
      ]);
      }

      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
      }
      }
     */
}
