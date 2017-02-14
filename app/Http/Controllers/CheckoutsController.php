<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Services\OrderService;
use Delivery\Validators\CheckoutValidator;
use Delivery\Http\Requests\CheckoutCreateRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutsController extends Controller
{

    /**
     *
     * @var ProductRepository 
     */
    private $productRepository;

    /**
     * @var OrderService
     */
    protected $service;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    function __construct(ProductRepository $productRepository, OrderService $service, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

        $clientId = auth()->user()->client->id;
        $orders = $this->service->ordersByClient($clientId)->paginate(2);
        return view('custumers.order.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->productRepository->all();
        return view('custumers.order.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CheckoutCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutCreateRequest $request)
    {

        try {

            $data = $request->all();
            $clientId = auth()->user()->client->id;
            $data['client_id'] = $clientId;
            $this->service->create($data);

            return redirect()->route('custumer.order.index');
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
      /
      public function show($id)
      {
      $checkout = $this->repository->find($id);

      if (request()->wantsJson()) {

      return response()->json([
      'data' => $checkout,
      ]);
      }

      return view('checkouts.show', compact('checkout'));
      }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
      /
      public function edit($id)
      {

      $checkout = $this->repository->find($id);

      return view('checkouts.edit', compact('checkout'));
      }

      /**
     * Update the specified resource in storage.
     *
     * @param  CheckoutUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
      /
      public function update(CheckoutUpdateRequest $request, $id)
      {

      try {

      $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

      $checkout = $this->repository->update($id, $request->all());

      $response = [
      'message' => 'Checkout updated.',
      'data' => $checkout->toArray(),
      ];

      if ($request->wantsJson()) {

      return response()->json($response);
      }

      return redirect()->back()->with('message', $response['message']);
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

      /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
      /
      public function destroy($id)
      {
      $deleted = $this->repository->delete($id);

      if (request()->wantsJson()) {

      return response()->json([
      'message' => 'Checkout deleted.',
      'deleted' => $deleted,
      ]);
      }

      return redirect()->back()->with('message', 'Checkout deleted.');
      }
     */
}
