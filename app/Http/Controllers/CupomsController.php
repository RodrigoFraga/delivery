<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Repositories\CupomRepository;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\AdminCupomRequest;

class CupomsController extends Controller
{
	private $repository;

	public function __construct(CupomRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
    	$cupoms = $this->repository->paginate(10);
    	return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create()
    {
    	return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request)
    {
    	$this->repository->create($request->all());

    	return redirect()->route('admin.cupoms.index');
    }

    public function edit($id)
    {
    	$cupom = $this->repository->find($id);
    	return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update( AdminCupomRequest $request, $id)
    {
    	$cupom = $this->repository->update($request->all(), $id);

    	return redirect()->route('admin.cupoms.index');
    }
}
