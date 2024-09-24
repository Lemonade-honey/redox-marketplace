<?php

namespace App\Http\Controllers;

use DB;
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

        try {
            $products = $this->orderService->mappingOrderProducts($cart->carts);

            abort_if(!$products, 404, "products not found");

            $totals = collect($products)->sum(function ($product) {
                return $product['total'];
            });

            DB::beginTransaction();
            $order = \App\Models\Order::create([
                'user_id' => auth()->user()->id,
                'orders' => $products,
                'total' => $totals,
                'status' => "PENDING"
            ]);

            $payment = $this->orderService->createOrderPayment($order);

            DB::commit();

            return dd("success create order", $order, $payment);
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            dd($th);
        }
    }
}
