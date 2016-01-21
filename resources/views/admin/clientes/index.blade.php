@extends('app')

@section('content')
	<div class="container">
		<h3>Clientes</h3>
		<br>

		<a href="{{ route('admin.clientes.create') }}" class="btn btn-default">Novo cliente</a>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Cliente</th>
					<th>Telefone</th>
					<th>Endereco</th>
					<th>Cidade</th>
					<th>Estado</th>
					<th>Codigo Postal</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($clientes as $cliente)
				<tr>
					<td> {{ $cliente->id }} </td>
					<td> {{ $cliente->user->name }} </td>
					<td> {{ $cliente->telefone }} </td>
					<td> {{ $cliente->endereco }} </td>
					<td> {{ $cliente->cidade }} </td>
					<td> {{ $cliente->estado }} </td>
					<td> {{ $cliente->zipcode }} </td>
					<td>
						<a href="{{ route('admin.clientes.edit',['id' => $cliente->id]) }}" class="btn btn-info">Edita</a>
						<a href="{{ route('admin.clientes.destroy',['id' => $cliente->id]) }}" class="btn btn-danger">Exclui</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $clientes->render() !!}
	</div>

@endsection