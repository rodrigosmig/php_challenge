<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Person;
use App\Models\ShipOrder;
use App\Services\PersonService;

class ShipOrderService
{
    protected $entity;
    protected $personService;

    public function __construct(
        ShipOrder $entity,
        Item $item,
        PersonService $personService
    ) {
        $this->entity           = $entity;
        $this->item             = $item;
        $this->personService    = $personService;
    }

    /**
     * Creates ship orders from a given array
     *
     * @return void
     */
    public function createShipOrders(array $data)
    {
        foreach ($data as $value) {
            $person = $this->getPerson($value['person_id']);
            $address = $this->createAddress($person, $value['shipto']);
            $items_ids = $this->createItems($value['items']);
            
            $ship_order = $person->shipOrders()->create([
                'id' => $value['id'],
                '$person_id' => $person->id,
                'address_id' => $address->id,
            ]);
            
            $ship_order->items()->sync($items_ids);
        }
        
    }

    private function getPerson(int $id)
    {
        $service = app(PersonService::class);

        return $service->findById($id);
    }

    private function createAddress(Person $person, array $address)
    {
        return $person->addresses()->create($address);
    }

    private function createItems(array $items)
    {
        $items_ids = [];

        foreach ($items as $item) {
            $item = $this->item->create($item);
            $items_ids[] = $item->id;
        }
        
        return $items_ids;
    }

    public function findById(int $id)
    {
        return $this->entity->find($id);
    }

    public function getAllShipOrders()
    {
        return $this->entity->all();
    }
}