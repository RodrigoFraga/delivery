@extends('app')

@section('content')
	<div class="container">
		<h3>Novo Pedido</h3>

		@include('errors._check')

		<div class="container">
			{!! Form::open(['route' => 'consumidor.order.store' ,'class' => 'form']) !!}

				<div class="form-group">
					<label>Total:</label>
					<p id="total"></p>
					<a href="#" id="btnNewItem"class="btn btn-default">Nodo Item</a>

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Produto</th>
								<th>Quantidade</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="form-control" name="items[0][produto_id]">
										@foreach($produtos as $produto)
											<option value="{{ $produto->id }}" data-preco="{{$produto->preco}}">{{ $produto->nome }} -- {{ $produto->preco }}</option>
										@endforeach
									</select>
								</td>
								<td>
									{!! Form::text('items[0][qtd]', 1, ['class' => 'form-control']) !!}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="form-group">
					{!! Form::submit('Criar Pedido', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('post-script')
	<script type="text/javascript">
		$('#btnNewItem').click(function (){
			var row = $('table tbody > tr:last'),
				newRow = row.clone(),
				length = $('table tbody tr').length;

			newRow.find('td').each(function(){
				var td = $(this),
					input = td.find('input, select'),
					name = input.attr('name');

				input.attr('name', name.replace((length - 1) + "", length + ""));
			});

			newRow.find('input').val(1);
			newRow.insertAfter(row);
			calcularTotal();
		});

		$(document.body).on('click', 'select', function(){
			calcularTotal();
		});

		$(document.body).on('blur', 'input', function(){
			calcularTotal();
		});

		
		function calcularTotal(){
			var total = 0,
				trLen = $('table tbody tr').length,
				tr = null, preco, qtd;

				for (var i = 0; i < trLen; i++) {
					tr = $('table tbody tr').eq(i);
					preco = tr.find(':selected').data('preco');
					qtd = tr.find('input').val();
					total += preco * qtd;
				};

				$('#total').html(total);
		}
	</script>
@endsection