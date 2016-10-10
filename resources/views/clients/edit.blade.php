@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Editar client</h2>
        
        @include('errors._check')
        
        {!!Form::model($client,['route'=>['admin.clients.update',$client->id], 'method'=>'PUT'])!!}
        @include('clients._form')
        <div class="form-group">
        {!!Form::submit('Criar',null,['class'=>'btn btn-primary btn-default'])!!}
        </div>
        {!!Form::close()!!}
        
    </div>
</div>
@endsection