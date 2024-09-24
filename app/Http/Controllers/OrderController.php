<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(\App\Services\Interfaces\OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {

    }

    public function create()
    {
        $cart = \App\Models\Cart::where("user_id", auth()->user()->id)->first();

        abort_if(!$cart || count($cart->carts) < 1, 404, "no carts product");

        $products = $this->orderService->mappingOrderProducts($cart->carts);

        abort_if(!$products, 404, "products not found");

        $totals = collect($products)->sum(function ($product) {
            return $product['total'];
        });

        return view("pages.order.create", [
            "carts" => $products,
            "total" => $totals
        ]);
    }

    public function createOrderPost()
    {
        $cart = \App\Models\Cart::where("user_id", auth()->user()->id)->first();

        abort_if(!$cart || count($cart->carts) < 1, 404, "no carts product");

        $products = $this->orderService->mappingOrderProducts($cart->carts);

        abort_if(!$products, 404, "products not found");

        $totals = collect($products)->sum(function ($product) {
            return $product['total'];
        });

        $order = \App\Models\Order::create([
            'user_id' => auth()->user()->id,
            'orders' => $products,
            'total' => $totals,
            'status' => "PENDING"
        ]);

        return dd("success create order", $order);
    }
}
