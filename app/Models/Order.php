<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    static $STATUS = [
        'aberto',
        'encaminhado',
        'fechado'
    ];
    protected $table = 'orders';
    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryMan()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id')->with('client');
    }
    public function getTotalAttribute()
    {
        return $this->items()->sum('price');
    }
}
