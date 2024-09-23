<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Master\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $cartUser;

    public function __construct()
    {
        $cartUser = Cart::where('user_id', auth()->user()->id)->first();
        if (!$cartUser) {
            $cartUser = Cart::create(['user_id' => auth()->user()->id, 'carts' => []]);
        }

        $this->cartUser = $cartUser;
    }

    public function saveToCart(Request $request, $productId)
    {
        $request->validate([
            "qty" => ["required", "numeric", "min:0"]
        ]);

        $product = Product::findOrFail($productId);

        try {
            $configs = collect($request->except(["_token", "qty", "massage"]))->toArray();

            $item[$product->id] = [
                'name' => $product->name,
                'qty' => $request->input("qty"),
                'price' => $product->price,
                'total' => (int) $request->input("qty") * (int) $product->price,
                "massage" => $request->input("massage"),
                "configs" => $configs
            ];

            $this->cartUser->carts = array_merge($this->cartUser->carts, $item);

            $this->cartUser->save();

            return back()->with("success", "product berhasil masuk kedalam keranjang");
        } catch (\Throwable $th) {
            logError("cart product failed to save", $th);
        }
    }

    public function deleteProductCart($productId)
    {
        $old = $this->cartUser->carts;

        $new = collect($old)->filter(function ($value, $key) use ($productId) {
            return $key != $productId;
        });

        $this->cartUser->carts = $new;
        $this->cartUser->save();

        return back()->with('success', 'product berhasil dihapus dari cart');
    }
}
