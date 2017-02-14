<div class="row">
    <div class="form-group col-lg-6">
        {!!Form::label('product','Produto')!!}
    </div>
    <div class="form-group col-lg-6">
        {!!Form::label('quantity','Quantidade')!!}
    </div>
</div>
<div class="row fields">
    <div class="form-group col-lg-6">
        <select name="items[0][product_id]" class='form-control'>
            @foreach($products as $product)
            <option data-price="{{$product->price}}" value="{{$product->id}}">
                {{$product->name . '-' . $product->price}}
            </option>
            @endforeach
        </select>
       
    </div>
    <div class="form-group col-lg-6">
        {!!Form::text('items[0][quantity]','1',['class'=>'form-control'])!!}
    </div>
</div>