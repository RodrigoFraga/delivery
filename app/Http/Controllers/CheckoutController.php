<?php

namespace Delivery\Http\Controllers;

use Delivery\Repositories\ProdutoRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Delivery\Http\Requests\CheckoutRequest;

use Delivery\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    private $produtoRepository;
    private $orderRepository;
    private $userRepository;
	private $service;

	public function __construct(ProdutoRepository $produtoRepository, OrderRepository $orderRepository, 
                                UserRepository $userRepository, OrderService $service)
    {
        $this->produtoRepository = $produtoRepository;
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function index()
    {
        $cliente_id = $this->userRepository->find(\Auth::user()->id)->cliente->id;

        $orders = $this->orderRepository->scopeQuery(function($query) use ($cliente_id){
            return $query->where('cliente_id', '=', $cliente_id);
        })->paginate();

        return view('consumidor.order.index', compact('orders'));
    }

    public function create()
    {
        $produtos = $this->produtoRepository->lists();
    	return view('consumidor.order.create', compact('produtos'));
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $cliente_id = $this->userRepository->find(\Auth::user()->id)->cliente->id;
        $data['cliente_id'] = $cliente_id;
        $this->service->create($data);

        return redirect()->route('consumidor.order.index');
    }
}
