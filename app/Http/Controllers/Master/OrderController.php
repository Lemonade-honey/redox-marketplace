<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view("pages.master.order.index");
    }

    public function detail($id)
    {
        $order = Order::with("payment", "user.profile")->findOrFail($id);
        $bread = [
            route('master.order.index') => 'Orders'
        ];

        return view("pages.master.order.detail", compact("order", "bread"));
    }

    public function detailPost(Request $request, $id)
    {
        $request->validate([
            "status_order" => "required"
        ]);

        $order = Order::findOrFail($id);
        try {
            $order->status = $request->input("status_order");
            $order->save();

            logInfo("order status success set to " . $request->input("status_order"), [
                'by' => auth()->user()->id
            ]);

            return back()->with("success", "status order berhasil diubah");
        } catch (\Throwable $th) {
            logError("order status failed to set", $th);

            return back()->with("success", "status order berhasil diubah");
        }
    }
}
