<?php

namespace App\Http\Resources;

use App\Http\Resources\PhoneResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'phones'    => PhoneResource::collection($this->phones)
        ];
    }
}
