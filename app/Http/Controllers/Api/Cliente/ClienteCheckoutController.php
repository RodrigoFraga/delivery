<?php

namespace Delivery\Http\Controllers\Api\Cliente;

use Illuminate\Http\Request;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\CheckoutRequest;

class ClienteCheckoutController extends Controller
{
    private $orderRepository;
    private $userRepository;
	private $service;

    private $with = ['items', 'cliente', 'cupom'];

	public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, OrderService $service)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();

        $cliente_id = $this->userRepository->find($id)->cliente->id;

        $orders = $this->orderRepository
                        ->skipPresenter(false)
                        ->with($this->with)
                        ->scopeQuery(function($query) use ($cliente_id){
            return $query->where('cliente_id', '=', $cliente_id);
        })->paginate();

        return $orders;
    }


    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();

        $cliente_id = $this->userRepository->find($id)->cliente->id;
        $data['cliente_id'] = $cliente_id;
        $o = $this->service->create($data);
        return $this->orderRepository
                    ->skipPresenter(false)
                    ->with($this->with)->find($o->id);
    }

    public function show($id)
    {
        return $this->orderRepository
                    ->skipPresenter(false)
                    ->with($this->with)
                    ->find($id);
    }
}
