<?php

namespace App\Services;

use App\Jobs\DeliverySendBot;
use App\Repositorys\CourierBotRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class CourierBotService
{
    protected $courierBotRepository;

    public function __construct(CourierBotRepository $courierBotRepository)
    {
        $this->courierBotRepository = $courierBotRepository;
    }

    public function createDelivery($application)
    {
        dispatch(new DeliverySendBot($application));
        return $this->courierBotRepository->createDelivery($application);
    }
}
