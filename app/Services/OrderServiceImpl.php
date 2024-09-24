<?php

namespace App\Services;
use App\Services\Interfaces\OrderService;

class OrderServiceImpl implements OrderService
{

    private $paymentService;

    public function __construct(\App\Services\Interfaces\PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function mappingOrderProducts(array $carts): array|bool
    {
        $products = \App\Models\Master\Product::with("images")->whereIn("id", [array_keys($carts)])->get();

        if (!$products || count($products) < 1) {
            return false;
        }

        $products = $products->map(function ($product) use ($carts) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->images->first()?->image,
                'price' => $product->price,
                'qty' => $carts[$product->id]['qty'],
                'total' => $carts[$product->id]['qty'] * $product->price,
                'configs' => $carts[$product->id]['configs'],
                'massage' => $carts[$product->id]['massage'],
            ];
        })->toArray();

        return $products;
    }

    public function createOrderPayment(\App\Models\Order $order): \App\Models\Payment
    {
        try {

            $user = auth()->user();

            $response = collect($this->paymentService->createBill([
                "title" => $order->id,
                "amount" => $order->total,
                "sender_name" => $user->name,
                "sender_email" => $user->email
            ]));

            $payment = \App\Models\Payment::create([
                "order_id" => $order->id,
                "link_id" => $response["link_id"],
                "link_url" => $response["link_url"],
                "amount" => $response["amount"],
                "expired_date" => $response["expired_date"],
                "full_response" => $response
            ]);

            return $payment;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}