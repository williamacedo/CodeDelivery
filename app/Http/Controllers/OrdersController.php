<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
   private $repository;

   public function __construct(OrderRepository $repository)
   {
      $this->repository = $repository;
   }

	public function index()
   {
      $orders = $this->repository->paginate(10);

      return view('admin.orders.index', compact('orders', 'list_status'));
   }

   public function edit($id, UserRepository $userRepository)
   {
      $list_status = [0=>'Pedente', 1=>'A caminho', 2=>'Entregue'];
      $order = $this->repository->find($id);

      $deliveryman = $userRepository->getDeliveryman(['role'=>'deliveryman'], ['name', 'id']);

      return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
   }

   public function update(Request $request, $id)
   {
      $all = $request->all();
      $this->repository->update($all, $id);

      return redirect()->route('admin.orders.index');
   }
}
