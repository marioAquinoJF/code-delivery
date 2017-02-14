<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'zipcode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
