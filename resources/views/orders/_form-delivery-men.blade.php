
{!!Form::model($order,['route'=>['admin.orders.update',$order->id], 'method'=>'PUT'])!!}
<div class="form-group form-inline">
    {!!Form::label('user_deliveryman_id','E-mail')!!}<br/>
    {!!Form::select('user_deliveryman_id',$delivery_men,$order->user_deliveryman_id,['class'=>'form-control'])!!}

    {!!Form::submit('Atribuir',null,['class'=>'btn btn-primary btn-default'])!!}
</div>
{!!Form::close()!!}