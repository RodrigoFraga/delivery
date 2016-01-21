@extends('app')

@section('content')
	<div class="container">
		<h3>Pedidos</h3>
		<br>

		<a href="{{ route('consumidor.order.create') }}" class="btn btn-default">Novo Pedido</a>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Total</th>
					<th>Status</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
				<tr>
					<td> #{{ $order->id }} </td>
					<td> {{ $order->total }} </td>
					<td> {{ $order->status }} </td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $orders->render() !!}
	</div>

@endsection