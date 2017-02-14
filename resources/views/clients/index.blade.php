@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Client</h2>
        {!!link_to_route('admin.clients.create', 'Novo Client', null, ['class'=>'btn btn-sm btn-default'])!!}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>CEP</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{$client->id}}</td>
                    <td>{{$client->user->name}}</td>
                    <td>{{$client->phone}}</td>
                    <td>{{$client->address}}, {{$client->city}} - {{$client->state}} </td>
                    <td>{{$client->postal_code}}</td>
                    <td>{{$client->cep}}</td>
                    <td>
                        {!!link_to_route('admin.clients.edit', 'Editar', ['id'=>$client->id], ['class'=>'btn btn-sm btn-default'])!!}
                    </td>
                  
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection