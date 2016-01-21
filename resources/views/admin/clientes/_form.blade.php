<div class="form-group">
	{!! Form::label('Name', 'Nome') !!}
	{!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Email', 'E-mail') !!}
	{!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Telefone', 'Telefone') !!}
	{!! Form::text('telefone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Endereco', 'Endereço') !!}
	{!! Form::textArea('endereco', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Cidade', 'Cidade') !!}
	{!! Form::text('cidade', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Estado', 'Estado') !!}
	{!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('zipcode', 'Codigo Postal') !!}
	{!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
</div>

