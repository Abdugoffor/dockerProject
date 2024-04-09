<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Services\CourierBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeliveryBotController extends Controller
{
    protected $courierBotService;

    public function __construct(CourierBotService $courierBotService)
    {
        $this->courierBotService = $courierBotService;
    }
    public function store(Applications $application)
    {
        return $this->courierBotService->createDelivery($application);
    }
}
