<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Person;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class ShipOrder extends Model
{
    protected $fillable = ['id', 'person_id', 'address_id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'shiporder_items');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
