<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Services\PersonService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function index()
    {
        $people = $this->personService->getPeople();

        return PersonResource::collection($people);
    }

    public function show($id)
    {
        $person = $this->personService->findById($id);

        if (! $person) {
            return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }

        return new PersonResource($person);
    }
}
