@extends('app')

@section('content')
	<div class="container">
		<h3>Editando Categoria: {{ $categoria->nome }}</h3>
		
		@include('errors._check')
		
		{!! Form::model($categoria, ['route' => ['admin.categorias.update', $categoria->id]]) !!}
			
			@include('admin.cupoms._form')
			
			<div class="form-group">
				{!! Form::submit('Salvar Categoria', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>

@endsection