@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Pedidos</h2>
        <a class="btn btn-default" href=" {{url('auth/register') }}">Novo cliente</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Entregador</th>
                    <th>Aberta em</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->client->name}}</td>
                    <td>{{$order->deliveryMan->name}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order::$STATUS[$order->status]}}</td>
                    <td>                       
                       {!!link_to_route('admin.orders.show', 'Abrir', ['id'=>$order->id], ['class'=>'btn btn-sm btn-info'])!!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection