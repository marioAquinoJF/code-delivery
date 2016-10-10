@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Products</h2>
        <a class="btn btn-default" href=" {{route('admin.products.create') }}">Novo Produto</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{($product->category->name)}}</td>
                    <td>
                        <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-default btn-sm">Editar</a>
                       {!!Form::open(['route'=>['admin.products.destroy',$product->id],'class'=>'form', 'method'=>'DELETE'])!!}
                        
     
                            {!!Form::submit('del',null,['class'=>'btn btn-danger btn-default'])!!}
        
                        {!!Form::close()!!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection