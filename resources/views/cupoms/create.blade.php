@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Novo Cupom</h2>
        @include('errors._check')
        {!!Form::open(['route'=>'admin.cupoms.store','class'=>'form'])!!}
        @include('cupoms._form')
        <div class="form-group">
            {!!Form::submit('Criar',null,['class'=>'btn btn-primary btn-default'])!!}
        </div>
        {!!Form::close()!!}

    </div>
</div>
@endsection