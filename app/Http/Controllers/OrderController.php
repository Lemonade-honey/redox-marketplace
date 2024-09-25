<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'orders' => $products,
                'total' => $totals,
                'status' => "PENDING"
            ]);

            // create order payment
            $payment = $this->orderService->createOrderPayment($order);

            // hits increment sold product order
            $this->orderService->hitsSoldsProductsByCart($cart->carts);

            // set carts to empty
            $cart->carts = [];
            $cart->save();

            DB::commit();

            logInfo("order $order->id success to create with payment", [
                "datas" => [
                    $order,
                    $payment
                ],
                "by" => auth()->user()->id
            ]);

            return redirect()->route("order.detail", $order->id)->with("success", "berhasil membuat order");
        } catch (\Throwable $th) {
            DB::rollBack();

            logError("order failed to create", $th);

            return back()->with("error", "gagal membuat order. Coba lagi nanti");
        }
    }

    public function detail($id)
    {
        $order = Order::with("payment")->findOrFail($id);

        return view("pages.order.detail", compact("order"));
    }
}
