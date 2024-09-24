<?php

namespace App\Services;
use App\Services\Interfaces\PaymentService;

class FlipPaymentService implements PaymentService
{

    private $client;

    private $baseUrl;

    private $options;

    public function __construct()
    {
        $secreateKey = env("FLIP_API_KEY");
        $encyps      = 'Basic ' . base64_encode($secreateKey . ":");

        $this->baseUrl = env("FLIP_ENV_URL");

        $this->options = [
            'headers' => [
                "Authorization:Basic " . base64_encode("$secreateKey:"),
                "Content-Type: application/x-www-form-urlencoded"
            ],
            'auth' => ["$secreateKey:", ''],
            'verify' => false
        ];

        $this->client = new \GuzzleHttp\Client();
    }

    private function requiredDatasKeys(array $datas, array $needs)
    {
        foreach ($datas as $key => $value) {
            if (!in_array($key, $needs)) {
                return true;
            }
        }

        return false;
    }

    public function getMyBalance(): int
    {
        $response = $this->client->get("$this->baseUrl/v2/general/balance", $this->options)
            ->getBody()->getContents();

        return json_decode($response, true)['balance'];
    }

    public function createBill(array $datas): mixed
    {
        if ($this->requiredDatasKeys($datas, ["title", "amount", "sender_name", "sender_email"])) {
            throw new \Exception("validate datas error, missing parameter", 422);
        }

        $payloads = array_merge($datas, [
            "step" => 2,
            "type" => "SINGLE",
            // "redirect_url" => "https://github.com/clinic-uad/ioa-web-laravel"
        ]);

        try {
            $response = $this->client->post("$this->baseUrl/v2/pwf/bill", array_merge($this->options, $this->options[] = ['form_params' => $payloads]))
                ->getBody()->getContents();

            return json_decode($response, true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAllBills(): mixed
    {
        $response = $this->client->get("$this->baseUrl/v2/pwf/bill", $this->options)
            ->getBody()->getContents();

        return json_decode($response, true);
    }

    public function getBill(int $billId): mixed
    {
        try {
            $response = $this->client->get("$this->baseUrl/v2/pwf/$billId/bill", $this->options)
                ->getBody()->getContents();

            return json_decode($response, true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }
    }

    public function getAllPayments(array $parameters = null): mixed
    {
        $endpoint = "$this->baseUrl/v2/pwf/payment?";

        if (isset($parameters["start_date"])) {
            $endpoint .= "start_date=$parameters[start_date]&";
        }

        if (isset($parameters["end_date"])) {
            $endpoint .= "end_date=$parameters[end_date]&";
        }

        if (isset($parameters["pagination"]) && is_numeric($parameters["pagination"])) {
            $endpoint .= "pagination=$parameters[pagination]&";
        }

        if (isset($parameters["page"]) && is_numeric($parameters["page"])) {
            $endpoint .= "page=$parameters[page]&";
        }

        if (isset($parameters["sort_by"]) && in_array($parameters["sort_by"], ["id", "bill_link", "bill_title", "sender_bank", "amount", "created_at"])) {
            $endpoint .= "sort_by=$parameters[sort_by]&";
        }

        if (isset($parameters["sort_type"]) && in_array($parameters["sort_type"], ["sort_desc", "sort_asc"])) {
            $endpoint .= "sort_type=$parameters[sort_type]&";
        }

        $response = $this->client->get($endpoint, $this->options)
            ->getBody()->getContents();

        return json_decode($response, true);
    }
}