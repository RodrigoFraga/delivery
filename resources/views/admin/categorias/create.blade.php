@extends('app')

@section('content')
	<div class="container">
		<h3>Nova Categoria</h3>

		@include('errors._check')
		
		{!! Form::open(['route' => 'admin.categorias.store']) !!}
			
			@include('admin.categorias._form')

			<div class="form-group">
				{!! Form::submit('Criar Categoria', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>

@endsection