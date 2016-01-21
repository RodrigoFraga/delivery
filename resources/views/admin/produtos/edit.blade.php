@extends('app')

@section('content')
	<div class="container">
		<h3>Editando Produto: {{ $produto->nome }}</h3>

		@include('errors._check')

		{!! Form::model($produto, ['route' => ['admin.produtos.update', $produto->id]]) !!}
			
			@include('admin.produtos._form')
			
			<div class="form-group">
				{!! Form::submit('Salvar Produto', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>

@endsection