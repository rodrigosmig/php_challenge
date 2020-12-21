<?php

namespace App\Services;

use XMLReader;
use SimpleXMLElement;
use App\Exceptions\InvalidFileException;

class FileService
{
    protected $xml;
    protected $people;
    protected $ship_orders;

    public function __construct()
    {
        $this->xml          = new XMLReader();
        $this->people       = [];
        $this->ship_orders  = [];
        $this->count = 0;
    }

    public function readPersonFile($file): array
    {
        $this->xml->open($file);

        while($this->xml->read() && $this->xml->name != 'person') {
            ;
        }

        if (($this->xml->name == "")) {
            throw new InvalidFileException("This file is not a valid people xml");            
        }

        while($this->xml->name == 'person') {
            $element    = new SimpleXMLElement($this->xml->readOuterXML());
            $phones     = (array) $element->phones;

            $person = [
                'id' => strval($element->personid),
                'name' => strval($element->personname),
                'phones' => isset($phones['phone']) ? $phones['phone'] : []
            ];

            $this->people[] = $person;
            $this->xml->next('person');
            unset($element);
        }
        
        $this->xml->close();
        
        return $this->people;
    }

    public function readShipOrderFile($file): array
    {
        $this->xml->open($file);

        while($this->xml->read() && $this->xml->name != 'shiporder') {
            ;
        }

        if (($this->xml->name == "")) {
            throw new InvalidFileException("This file is not a valid ship order xml");            
        }

        while($this->xml->name == 'shiporder') {
            $element = new SimpleXMLElement($this->xml->readOuterXML());

            $ship_order = [
                'id'        => strval($element->orderid),
                'person_id' => strval($element->orderperson),
                'shipto'    => (array) $element->shipto,
                'items'     => $this->convertToArray((array) $element->items)
            ];

            $this->ship_orders[] = $ship_order;
            $this->xml->next('shiporder');
            unset($element);
        }
        
        $this->xml->close();
        
        return $this->ship_orders;
    }

    private function convertToArray($data): array
    {
        $this->count++;

        $items = [];

        if (isset($data['item'])) {
            $item = (array) $data['item'];
            
            if (isset($item['title']) && isset($item['note']) && isset($item['quantity']) && isset($item['price'])) {
                return [$item];
            }

            foreach ($item as $value) {
                $items[] = (array) $value;
            }
        }

        return $items;
    }
}