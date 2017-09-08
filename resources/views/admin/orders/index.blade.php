@extends('app')

@section('content')
	<div class="container">
		<h3>Pedidos</h3>


	<a href="" class="btn btn-default">Novo Pedido</a>
	<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Total</th>
					<th>Data</th>
					<th>Itens</th>
					<th>Entregador</th>
					<th>Ação</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>R$ {{ $order->total }}</td>
					<td>{{ $order->created_at }}</td>
					<td>
					@foreach($order->items as $item)
						<li>{{$item->product->name}}</li>
					@endforeach
					</td>
					<td>
						@if($order->deliveryman)
							{{$order->deliveryman->name}}
						@else
							--
						@endif

					</td>
					<td>
					@if($order->status == 0)
					Pedente
					@elseif($order->status == 1)
					A caminho
					@else
					Entregue
					@endif
					</td>
					<td>
						<a href="{{route('admin.orders.edit', ['id'=>$order->id])}}" class="btn btn-info btn-sm">Editar</a>
					</td>
				</tr>
				@endforeach
			</tbody>
			
		</table>

		{!! $orders->render() !!}

	</div>


@endsection