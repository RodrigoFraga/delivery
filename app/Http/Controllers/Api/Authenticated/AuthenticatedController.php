<?php

namespace Delivery\Http\Controllers\Api\Authenticated;

use Illuminate\Http\Request;
use Delivery\Repositories\UserRepository;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Delivery\Http\Controllers\Controller;

class AuthenticatedController extends Controller
{
    private $userRepository;

	public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();

        return $this->userRepository->find($id);
    }
}
