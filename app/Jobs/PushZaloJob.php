<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PushZaloJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle()
    {
        ini_set('max_execution_time', '90000');
        ini_set('memory_limit', '500M');
        set_time_limit(90000);

        // xử lý foreach các item call api và lưu vào DB kết quả trả về
        foreach ($this->data as $item) {
//            dd($item);
            if ($item['phone']) {
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'access_token' => 'vlIDVzLwm5Zgz89qs7RDMU7rWNZVOQnTfUcDCk8fXaQgqQiR-2svMQNJz2AVHBPefuJ-Fjraob-pxySOY2BBVhFmvI7F6V43di_18QG6-t7RsiGdu52E1g2BXqFyTvWxjFgtPTXthpgMcu5RsbQp78lSd5lBDROKY-IWGxbfgW_bW-4ecWp3Uk64xLsoRjSQy9tdRf9EsXN-ki94ZsRFQFNhzWscAzShpgBQJgXrwMlwegOee4sNSyQ2hYELGgLboRAKE_PujNUYXBG6cKsTM-FQiH7OJRrrlw-5DmkwUnNPOCTT'
                    ],
                ]);

                $url = 'https://business.openapi.zalo.me/message/template';

                $body = json_encode(
                    [
                        "mode" => "development",
                        "phone" => '84975275297',
                        "template_id" => "239437",
                        "template_data" => [
                            "ten_co_so" => $item['ten_co_so'],
                            "customer_name" => $item['customer_name'],
                            "ma_don_hang" => $item['ma_don_hang'],
                            "thoigan" => $item['thoigan'],
                        ],
                        "tracking_id" => "tracking_id",
                    ]);

                $response = $client->post($url, ['body' => $body]);

                dump(json_decode($response->getBody()->getContents()));
            }
        }
    }
}
