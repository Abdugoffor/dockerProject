<?php

namespace App\Repositorys;

use App\Models\DeliveryBot;

class CourierBotRepository
{
    public function createDelivery($application)
    {
        $count = $application->application_model_products->count();
        // dd($application, $count, $application->firma->lang, $application->firma->long);
        $data = DeliveryBot::create([
            'application_id' => $application->id,
            'count' => $count,
            'courier_id' => $application->customer_id,
            'lang' => $application->firma->lang != 0 ? $application->firma->lang : '',
            'long' => $application->firma->long != 0 ? $application->firma->long : '',
        ]);

        return redirect()->back()->with('text', 'Информация отправлена ​​курьеру');
    }
}
