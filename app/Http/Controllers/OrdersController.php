<?php

namespace Delivery\Http\Controllers;

use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Http\Controllers\Controller;

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
    	return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $list_status = ['0' => 'Pendente', '1' => 'A Caminho', '2' => 'Entregue', '3' => 'Cancelado'];

        $deliveryman = $userRepository->getDeliverymen();
        
        $order = $this->repository->find($id);
        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);
        
        return redirect()->route('admin.orders.index');
    }
}
