<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Response;
use App\Services\PersonService;
use App\Services\ShipOrderService;
use Illuminate\Database\QueryException;
use App\Exceptions\InvalidFileException;
use App\Http\Requests\UploadFormRequest;

class FileController extends Controller
{
    protected $fileService;
    protected $personService;
    protected $shipOrderService;
    
    public function __construct(
        FileService $fileService,
        PersonService $personService,
        ShipOrderService $shipOrderService
    ) {
        $this->fileService      = $fileService;
        $this->personService    = $personService;
        $this->shipOrderService = $shipOrderService;
    }

    public function uploadXmlPerson(UploadFormRequest $request)
    {
        $people = $this->fileService->readPersonFile($request->file);

        try {
            $this->personService->createPeople($people);
        } catch (QueryException $e) {
            return response()->json(['message' => "File contains entity already processed"], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (InvalidFileException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['message' => "File successfully imported"]);
    }

    public function uploadXmlShipOrder(UploadFormRequest $request)
    {
        $ship_orders = $this->fileService->readShipOrderFile($request->file);

        try {
            $this->shipOrderService->createShipOrders($ship_orders);
        } catch (QueryException $e) {
            return response()->json(['message' => "File contains entity already processed"], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (InvalidFileException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['message' => "File successfully imported"]);
    }
}
