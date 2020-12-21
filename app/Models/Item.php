<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['id', 'title', 'note', 'quantity', 'price'];

    public function shipOrders()
    {
        return $this->belongsToMany(ShipOrder::class, 'shiporder_items');
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }
}
