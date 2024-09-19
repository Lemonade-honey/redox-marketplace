<?php

namespace App\Http\Controllers;

use App\Models\Master\Product;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $products = Product::with("categorie")->paginate(8);

        return view("market.index", compact("products"));
    }

    public function detailProdcut($id)
    {

        $product = Product::with("categorie")->findOrFail($id);

        return view("market.detail", compact("product"));
    }
}
