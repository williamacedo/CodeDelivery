<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientService;
//use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
	private $repository;
   private $clientService;

  //private $userRepository;

	public function __construct(ClientRepository $repository, ClientService $clientService)
	{
		$this->repository = $repository;
      $this->clientService = $clientService;
     //$this->userRepository = $userRepository;
	}

   	public function index() 
   	{
   		$clients = $this->repository->paginate(5);

   		return view('admin.clients.index', compact('clients'));
   	}

   	public function create()
   	{
   		return view('admin.clients.create');
   	}

   	public function store(AdminClientRequest $request) 
   	{
   		$data = $request->all();
   		$this->clientService->create($data);
   		
   		return redirect()->route('admin.clients.index');
   	}

   	public function edit($id)
   	{

   		$client = $this->repository->find($id);
         //$states = $this->repository->lists('state', 'id');

   		return view('admin.clients.edit', compact('client'));

   	}

   	public function update(AdminClientRequest $request, $id)
   	{
   		$data = $request->all();
   		$this->clientService->update($data, $id);
   		
   		return redirect()->route('admin.clients.index');
   	}

}
