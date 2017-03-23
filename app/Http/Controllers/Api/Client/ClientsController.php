<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\ClientRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Http\Requests\CreateClientRequest;
use Delivery\Services\ClientService;

class ClientsController extends Controller
{

    /**
     *
     * @var ClientRepository
     */
    private $repository;

    /**
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     *
     * @var ClientService
     */
    private $service;

    function __construct(ClientRepository $repository, UserRepository $userRepository, ClientService $service)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->repository->all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequest $request)
    {
       $client = $this->service->create($request->all());
        return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->repository->find($id);

        return view('clients.edit', compact('client', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
  
        $this->service->update($request->all(), $id);
        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.clients.index');
    }

}
