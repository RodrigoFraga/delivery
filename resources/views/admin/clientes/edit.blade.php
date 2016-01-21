@extends('app')

@section('content')
	<div class="container">
		<h3>Editando Cliente: {{ $cliente->user->name }}</h3>

		@include('errors._check')

		{!! Form::model($cliente, ['route' => ['admin.clientes.update', $cliente->id]]) !!}
			
			@include('admin.clientes._form')
			
			<div class="form-group">
				{!! Form::submit('Salvar Cliente', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>

@endsection