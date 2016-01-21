<div class="form-group">
	{!! Form::label('Categoria', 'Categoria') !!}
	{!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control']) !!}
</div>

{{-- Name Form Input --}}
<div class="form-group">
	{!! Form::label('Nome', 'Nome') !!}
	{!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

{{-- Descriçaõ Form Input --}}
<div class="form-group">
	{!! Form::label('Descricao', 'Descrição') !!}
	{!! Form::textArea('descricao', null, ['class' => 'form-control']) !!}
</div>

{{-- Name Preço Input --}}
<div class="form-group">
	{!! Form::label('Preco', 'Preço') !!}
	{!! Form::text('preco', null, ['class' => 'form-control']) !!}
</div>

