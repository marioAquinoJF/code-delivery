@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        {!!$orders->render()!!}
        <h2>Pedidos</h2>
        <a class="btn btn-default" href=" {{url('admin/orders/create') }}">Novo Pedido</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Aberta em</th>
                    <th>Itens</th>
                    <th>Entregador</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>R$ {{$order->total}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <ul>
                        @foreach($order->items as $item)
                        <li>
                            {{$item->product->name}}
                        </li>
                        @endforeach
                        </ul>
                    </td>                    
                    <td>
                        {{ $order->deliveryMan ? $order->deliveryMan->name : '--'}}
                    </td>
                    <td>{{$order::$STATUS[$order->status]}}</td>                    
                    <td>                       
                       {!!link_to_route('admin.orders.show', 'Abrir', ['id'=>$order->id], ['class'=>'btn btn-sm btn-info'])!!}
                      {!!link_to_route('admin.orders.edit', 'Editar', ['id'=>$order->id], ['class'=>'btn btn-sm btn-info'])!!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection