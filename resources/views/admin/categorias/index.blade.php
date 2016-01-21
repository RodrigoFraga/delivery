@extends('app')

@section('content')
	<div class="container">
		<h3>Categorias</h3>
		<br>

		<a href="{{ route('admin.categorias.create') }}" class="btn btn-default">Nova Categoria</a>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categorias as $categoria)
				<tr>
					<td> {{ $categoria->id }} </td>
					<td> {{ $categoria->nome }} </td>
					<td>
						<a href="{{ route('admin.categorias.edit',['id' => $categoria->id]) }}" class="btn btn-info">Edita</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $categorias->render() !!}
	</div>

@endsection