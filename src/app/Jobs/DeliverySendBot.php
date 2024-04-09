<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class DeliverySendBot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $application;
    public $telegramId;
    public $latitude;
    public $longitude;

    const token = 'https://api.telegram.org/bot6263518001:AAEevMJVknsVxMA-JSd6dTcUO4N1Lc3aiOY/';

    public function __construct($application)
    {
        $this->application = $application;
        $this->telegramId = $application->courier->telegram_id;
        $this->latitude = $application->firma->lang;
        $this->longitude = $application->firma->long;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productText = '';

        foreach ($this->application->application_model_products as $application_model_product) {
            $productText .= "<b>Продукт : </b> " . $application_model_product->model_product->name_size . " , ";
            $productText .= "<b>Количество : </b> " . $application_model_product->count . "\n";
        }

        $inline_keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '✅ Принятие', 'callback_data' => 'accept_button'],
                    ['text' => '🚫 Отмена', 'callback_data' => 'cancel_button'],
                ],
            ],
        ];

        $count = $this->application->application_model_products->count();
        $reply_markup = json_encode($inline_keyboard);
        $data = \Carbon\Carbon::parse($this->application->delivery_time)->format('d-m-Y, H:i');
        $phone = $this->application->firma->prone1;
        
        $message = "<b>Новый заказ</b>\n\n" .
            "Фирма : {$this->application->firma->name}\n\n" .
            "<b>Тел :</b><a href='tel:$phone'>$phone</a>\n\n" .
            "<b>Количество продуктов: {$count}</b>\n" . $productText . "\n" .
            "Срок поставки: {$data}\n";

        $response = Http::post(self::token . 'sendMessage', [
            'chat_id' => $this->telegramId,
            'parse_mode' => 'HTML',
            'text' => $message,
        ]);

        if (empty($this->longitude) or empty($this->latitude)) {
            $emptyLocationText = Http::post(self::token . 'sendMessage', [
                'chat_id' => $this->telegramId,
                'parse_mode' => 'HTML',
                'text' => "<b>Нет местоположения</b> \n\n",
            ]);
        } else {

            $locationResponse = Http::post(self::token . 'sendLocation', [
                'chat_id' => $this->telegramId,
                'latitude' => $this->longitude,
                'longitude' => $this->latitude,
                'text' => 'Местоположения',
                'reply_markup' => $reply_markup,
            ]);
        }

        // $filePath = public_path('test/1.jpg');

        // $document = Http::attach('document', file_get_contents($filePath), '1.jpg')->post(self::token . 'sendDocument', [
        //     'chat_id' => $this->telegramId,
        // ]);

        // $response = Http::attach('photo', file_get_contents($filePath), '1.jpg')->post(self::token . 'sendPhoto', [
        //     'chat_id' => $this->telegramId,
        // ]);
        // dd($response->json());
    }
}
