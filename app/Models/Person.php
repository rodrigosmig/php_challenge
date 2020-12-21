<?php

namespace App\Models;

use App\Models\Phone;
use App\Models\Address;
use App\Models\ShipOrder;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['id', 'name'];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function shipOrders()
    {
        return $this->hasMany(ShipOrder::class);
    }
}
