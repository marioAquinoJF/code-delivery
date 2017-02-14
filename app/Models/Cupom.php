<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cupom extends Model implements Transformable
{

    use TransformableTrait;

    protected $table = 'cupoms';
    protected $fillable = [
        'code',
        'value'
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

}
