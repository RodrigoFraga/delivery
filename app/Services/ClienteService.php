<?php

namespace Delivery\Services;

use Delivery\Repositories\ClienteRepositoryEloquent;
use Delivery\Repositories\UserRepositoryEloquent;


class ClienteService 
{
	private $clienteRepository;
	private $userRepository;
	
	function __construct(ClienteRepositoryEloquent $clienteRepository, UserRepositoryEloquent $userRepository)
	{
		$this->clienteRepository = $clienteRepository;
		$this->userRepository = $userRepository;
	}

	public function create(array $data)
	{
		$data['user']['password'] = bcrypt(123456);
    	$user = $this->userRepository->create($data['user']);
    	
    	$data['user_id'] = $user->id;

    	$this->clienteRepository->create($data);
	}

	public function update(array $data, $id)
	{
    	$this->clienteRepository->update($data, $id);
    	
    	$userId = $this->clienteRepository->find($id, ['user_id'])->user_id;
    	
    	$this->userRepository->update($data['user'], $userId);
	}
}