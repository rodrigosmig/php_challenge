<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['person_id', 'name', 'address', 'city', 'country'];

    public function shipOrders()
    {
        return $this->hasMany(ShipOrder::class);
    }
}
