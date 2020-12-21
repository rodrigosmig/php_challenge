<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Services\ShipOrderService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShipOrderResource;

class ShipOrderController extends Controller
{
    protected $shipOrderService;

    public function __construct(ShipOrderService $shipOrderService)
    {
        $this->shipOrderService = $shipOrderService;
    }

    public function index()
    {
        $shipOrders = $this->shipOrderService->getAllShipOrders();

        return ShipOrderResource::collection($shipOrders);
    }

    public function show($id)
    {
        $ship_order = $this->shipOrderService->findById($id);

        if (! $ship_order) {
            return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }

        return new ShipOrderResource($ship_order);
    }
}
