<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Repositories\ClienteRepository;
use Delivery\Services\ClienteService;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\AdminClienteRequest;

class ClientesController extends Controller
{
    private $repository;
	private $service;

	public function __construct(ClienteRepository $repository, ClienteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function index()
    {
    	$clientes = $this->repository->paginate(10);
    	return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
    	return view('admin.clientes.create');
    }

    public function store(AdminclienteRequest $request)
    {
    	$this->service->create($request->all());

    	return redirect()->route('admin.clientes.index');
    }

    public function edit($id)
    {
    	$cliente = $this->repository->find($id);

    	return view('admin.clientes.edit', compact('cliente'));
    }

    public function update( AdminclienteRequest $request, $id)
    {
    	$cliente = $this->service->update($request->all(), $id);

    	return redirect()->route('admin.clientes.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.clientes.index');
    }
}
