<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Repositories\CategoriaRepository;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\AdminCategoriaRequest;

class CategoriasController extends Controller
{
	private $repository;

	public function __construct(CategoriaRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
    	$categorias = $this->repository->paginate(10);
    	return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
    	return view('admin.categorias.create');
    }

    public function store(AdminCategoriaRequest $request)
    {
    	$this->repository->create($request->all());

    	return redirect()->route('admin.categorias.index');
    }

    public function edit($id)
    {
    	$categoria = $this->repository->find($id);
    	return view('admin.categorias.edit', compact('categoria'));
    }

    public function update( AdminCategoriaRequest $request, $id)
    {
    	$categoria = $this->repository->update($request->all(), $id);

    	return redirect()->route('admin.categorias.index');
    }
}
