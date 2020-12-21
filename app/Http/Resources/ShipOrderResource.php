<?php

namespace App\Http\Resources;

use App\Http\Resources\ItemResource;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'orderid'       => $this->id,
            'orderperson'   => [
                'id'        => $this->person->id,
                'name'      => $this->person->name
            ],
            'ship_to'       => new AddressResource($this->address),
            'items'         => ItemResource::collection($this->items),
        ];
    }
}
