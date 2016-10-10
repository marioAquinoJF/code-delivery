@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Editar Pedido</h2>
        <div class="row">
            <div class="col-sm-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-heading">
                        <h4>  Dados do pedido</h4>
                    </li>
                    <li class="list-group-item">
                        Cliente: {{$order->client->name}}
                    </li>
                    <li class="list-group-item">
                        Total: {{$order->total}}
                    </li>
                    <li class="list-group-item">
                        Aberta em: {{$order->created_at}}
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                @include('errors._check')
                {!!Form::model($order,['route'=>['admin.orders.update',$order->id], 'method'=>'PUT'])!!}
                @include('orders._form')
                <div class="form-group">
                    {!!Form::submit('Editar',null,['class'=>'btn btn-primary btn-default'])!!}
                </div>
                {!!Form::close()!!}
            </div>
        </div>


    </div>
</div>
@endsection