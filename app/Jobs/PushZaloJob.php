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
            if ($this->data['phone']) {
                $client = new Client([
                    'headers' => ['Content-Type' => 'application/json']
                ]);

                $url = 'https://business.openapi.zalo.me/message/template';

                $body = json_encode(
                    [
                        "mode" => "development",
                        "phone" => "84987654321",
                        "template_id" => "7895417a7d3f9461cd2e",
                        "template_data" => [
                            "ky" => "1",
                            "thang" => "4/2020",
                            "start_date" => "20/03/2020",
                            "end_date" => "20/04/2020",
                            "customer" => "Nguyễn Thị Hoàng Anh",
                            "cid" => "PE010299485",
                            "address" => "VNG Campus, TP.HCM",
                            "amount" => "100",
                            "total" => "100000",
                        ],
                        "tracking_id" => "tracking_id",
                    ]);

                $response = $client->post($url, ['body' => $body]);

                dump(json_decode($response->getBody()->getContents()));
            }
        }
    }
}
