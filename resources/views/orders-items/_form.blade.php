
<div class="form-group">
    {!!Form::label('user_deliveryman_id','Entregador')!!}
    {!!Form::select('user_deliveryman_id',$users,$order->user_deliveryman_id,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!!Form::label('status','E-mail')!!}
    {!!Form::select('status',$order::$STATUS,$order->status,['class'=>'form-control'])!!}
</div>