<?php

namespace App\Services;

use App\Models\Person;

class PersonService
{
    protected $entity;

    public function __construct(Person $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Creates persons from an array
     *
     * @return void
     */
    public function createPeople(array $data)
    {
        foreach ($data as $value) {
            $person = $this->entity->create($value);

            $this->assignPhonesToPerson($person, $value['phones']);
        }
        
    }

    /**
     *Aassigns phones to a person
     *
     * @return void
     */
    private function assignPhonesToPerson(Person $person, $phones)
    {
        if (is_array($phones)) {
            foreach ($phones as $phone) {
                $person->phones()->create([
                    'number' => $phone
                ]);
            }
        } else {
            $person->phones()->create([
                'number' => $phones
            ]);
        }
    }

    public function findById(int $id)
    {
        return $this->entity->find($id);
    }

    public function getPeople()
    {
        return $this->entity->all();
    }
}