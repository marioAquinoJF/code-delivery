@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Novo Pedido</h2>
        <div class="container-fluid">
            <div class="row">
                Total: <span id="total"></span>
            </div>
        </div>
        @include('errors._check')
        {!!Form::open(['route'=>'custumer.order.store','class'=>'form'])!!}
        <button type="button" class="btn btn-default" id="buttonNewItem">Add Item</button>
        <div class="panel panel-body">
            <div class="container-fluid">
                @include('orders._form')
            </div>

        </div>
        <div class="form-group">
            {!!Form::submit('Enviar',['class'=>'btn btn-primary btn-default'])!!}
        </div>
        {!!Form::close()!!}

    </div>
</div>
@endsection
@section('post-script')
<script type="text/javascript">
    $("#buttonNewItem").click(function ()
    {

        var row = $('.panel .container-fluid > div.row.fields:last'),
                newRow = row.clone(),
                length = $('.panel .container-fluid div.row.fields').length;
        console.log(row);
        newRow.find('div').each(function ()
        {

            var div = $(this),
                    input = div.find('input,select'),
                    name = input.attr('name');
            input.attr('name', name.replace((length - 1) + '', length + ''));

        });
        newRow.find('input').val(1);
        newRow.insertAfter(row);
        calculateTotal();
    });
    $(document.body).on('click', 'select', function(){
        calculateTotal();
    }); 
     $(document.body).on('blur keyup', 'input', function(){
        calculateTotal();
    }); 
    function calculateTotal()
    {
        var total = 0,
                fieldsLength = $('.panel .container-fluid div.row.fields').length,
                field = null,
                price,
                qtd;
        for (var i = 0; i < fieldsLength; i++) {
            field = $('.panel .container-fluid div.row.fields').eq(i);
            price = field.find(':selected').data('price');
            console.log(field.find('select'));
            qtd = field.find('input').val();
            total += price * qtd;
        }
        
        $('#total').text(total);
    }
    calculateTotal();
</script>
@endsection