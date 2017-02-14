@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        {!!$cupoms->render()!!}
        <h2>Cupons</h2>
        {!!link_to_route('admin.cupoms.create', 'Novo Cupom', null, ['class'=>'btn btn-sm btn-default'])!!}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Valor</th>
                    <th>Usado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cupoms as $cupom)
                <tr>
                    <td>{{$cupom->id}}</td>
                    <td>{{$cupom->code}}</td>
                    <td>{{$cupom->value}}</td>
                    <td>{{$cupom->used}} </td>
                    <td>
                        {!!link_to_route('admin.cupoms.edit', 'Editar', ['id'=>$cupom->id], ['class'=>'btn btn-sm btn-default'])!!}
                    </td>
                  
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection