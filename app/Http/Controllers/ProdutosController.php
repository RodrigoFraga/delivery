<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Repositories\ProdutoRepository;
use Delivery\Repositories\CategoriaRepository;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\AdminProdutoRequest;

class ProdutosController extends Controller
{
	private $repository;
    private $categoriaRepository;

	public function __construct(ProdutoRepository $repository, CategoriaRepository $categoriaRepository)
    {
        $this->repository = $repository;
        $this->categoriaRepository = $categoriaRepository;
    }


    public function index()
    {
    	$produtos = $this->repository->paginate(10);
    	return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = $this->categoriaRepository->lists();
    	return view('admin.produtos.create', compact('categorias'));
    }

    public function store(AdminProdutoRequest $request)
    {
    	$this->repository->create($request->all());

    	return redirect()->route('admin.produtos.index');
    }

    public function edit($id)
    {
    	$produto = $this->repository->find($id);
        $categorias = $this->categoriaRepository->lists();

    	return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    public function update( AdminProdutoRequest $request, $id)
    {
    	$produto = $this->repository->update($request->all(), $id);

    	return redirect()->route('admin.produtos.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.produtos.index');
    }
}
