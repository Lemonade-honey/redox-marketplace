<?php

namespace App\Services;
use App\Services\Interfaces\OrderService;

class OrderServiceImpl implements OrderService
{
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
}