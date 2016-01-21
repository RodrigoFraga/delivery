@extends('app')

@section('content')
	<div class="container">
		<h3>Produtos</h3>
		<br>

		<a href="{{ route('admin.produtos.create') }}" class="btn btn-default">Novo Produto</a>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Produto</th>
					<th>Categoria</th>
					<th>Preço</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($produtos as $produto)
				<tr>
					<td> {{ $produto->id }} </td>
					<td> {{ $produto->nome }} </td>
					<td> {{ $produto->categoria->nome }} </td>
					<td> R$ {{ $produto->preco }} </td>
					<td>
						<a href="{{ route('admin.produtos.edit',['id' => $produto->id]) }}" class="btn btn-info">Edita</a>
						<a href="{{ route('admin.produtos.destroy',['id' => $produto->id]) }}" class="btn btn-danger">Exclui</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $produtos->render() !!}
	</div>

@endsection