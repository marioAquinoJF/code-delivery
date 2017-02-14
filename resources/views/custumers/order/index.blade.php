@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        {!!$orders->render()!!}
    </div>
</div>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        
        <h2>Pedidos</h2>
        <a class="btn btn-default" href=" {{url('custumer/order/create') }}">Novo Pedido</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>R$ {{$order->total}}</td>
                    <td>{{$order::$STATUS[$order->status]}}</td>                    
                    <td>                       
                        {!!link_to_route('custumer.order.show', 'Abrir', ['id'=>$order->id], ['class'=>'btn btn-sm btn-info'])!!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        {!!$orders->render()!!}
    </div>
</div>
@endsection