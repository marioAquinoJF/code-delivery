@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Categories</h2>
        <a class="btn btn-default" href=" {{route('admin.categories.create') }}">Nova categoria</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-default btn-sm">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      
    </div>
</div>
@endsection