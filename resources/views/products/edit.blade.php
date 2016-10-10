@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Editar produto</h2>
        
        @include('errors._check')
        
        {!!Form::model($product,['route'=>['admin.users.update',$product->id], 'method'=>'PUT'])!!}
        @include('users._form')
        <div class="form-group">
        {!!Form::submit('Criar',null,['class'=>'btn btn-primary btn-default'])!!}
        </div>
        {!!Form::close()!!}
        
    </div>
</div>
@endsection