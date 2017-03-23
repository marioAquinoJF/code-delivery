@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">        
        <div class="row">
            <div class="col-sm-4">
                <br/>

                <ul class="list-group">
                    <li class="list-group-item list-group-item-heading">
                        <h4>  Dados do pedido</h4>
                    </li>
                    <li class="list-group-item">
                        <b>Cliente:</b> {{$order->client->name}}
                    </li>
                    <li class="list-group-item">
                        <b>Endereço:</b> {{$client->address}}, {{$client->city}} - {{$client->state}}.<br/>
                        <b>CEP:</b> {{$client->zipcode}}
                    </li>
                    <li class="list-group-item">
                        <b>Entregador:</b> {{$order->deliveryMan ? $order->deliveryMan->name : 'sem entregador'}}
                    </li>
                    <li class="list-group-item">
                        <b>Total:</b> {{$order->total}}
                    </li>
                    <li class="list-group-item">
                        <b>Aberta em:</b> {{$order->created_at}}
                    </li>
                    <li class="list-group-item">
                        <b>Status:</b> {{$order::$STATUS[$order->status]}}
                    </li>
                </ul>
            </div>
            
            <div class="col-sm-6">
                
                <h3>Itens Pedidos</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço Unit.</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $orderItem)
                        <tr>
                            <td>{{$orderItem->id}}</td>
                            <td>{{$orderItem->product->name}}</td>
                            <td>{{$orderItem->quantity}}</td>
                            <td>R$ {{number_format($orderItem->price,2,',','')}}</td>
                            <td>R$ {{number_format($orderItem->price * $orderItem->quantity,2,',','')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2">
                <br/>

                <!--ul class="list-group">
                    <li class="list-group-item">
                        {!!Form::model($order,['route'=>['admin.orders.update',$order->id], 'method'=>'PUT'])!!}
                        @include("orders._form")
                         {!!Form::submit('Alterar',null,['class'=>'btn btn-primary btn-default'])!!}
                        {!!Form::close()!!}
                    </li>

                </ul-->
            </div>
        </div>
    </div>
</div>
@endsection