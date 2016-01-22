<?php

namespace Delivery\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Delivery\Http\Controllers\Controller;

class DeliverymanCheckoutController extends Controller
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

        $orders = $this->orderRepository
                        ->skipPresenter(false)
                        ->with(['items'])->scopeQuery(function($query) use ($id){
            return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();

        return $orders;
    }

    public function show($id)
    {
        return $this->orderRepository
                    ->skipPresenter(false)
                    ->getByIdAndDeliveryman($id, Authorizer::getResourceOwnerId());
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->service->updateStatus($id, Authorizer::getResourceOwnerId(), $request->get('status'));
    }
}
