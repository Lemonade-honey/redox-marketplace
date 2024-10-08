<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Categorie;
use App\Models\Master\Product;
use App\Models\Master\ProductImage;
use DB;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{

    public function __construct(private \App\Services\Interfaces\FileTempService $fileTempService)
    {

    }

    public function index()
    {
        return view("pages.product.index");
    }

    public function create()
    {
        $categories = Categorie::orderBy("name")->get();
        $bread      = [
            route('master.product.index') => 'Products',
        ];

        return view("pages.product.create", compact("categories", "bread"));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255", "min:3"],
            "categorie" => ["required", "exists:categories,id"],
            "files" => ["required", "array"],
            "description" => "required",
            "price" => ["required", "numeric", "min:0", "max:100000000"],
            "configs" => ["nullable", "array"]
        ]);

        try {
            DB::beginTransaction();
            $product = Product::create([
                "name" => $request->input("name"),
                "categorie_id" => $request->input("categorie"),
                "description" => $request->input("description"),
                "price" => $request->input("price"),
                "configs" => $request->input('configs') ?? []
            ]);

            $folder = \Illuminate\Support\Str::random();

            foreach ($request->input('files') as $key => $value) {
                $path = $this->fileTempService->saveFileTemp($value, "products/$folder");

                if ($path) {
                    ProductImage::create([
                        "product_id" => $product->id,
                        "image" => $path
                    ]);
                }
            }

            DB::commit();

            logNotice("product success to create", [
                "datas" => $product,
                "by" => auth()->user()->id
            ]);

            return redirect()->route("master.product.detail", $product->id)->with("success", "berhasil menambah product baru");
        } catch (\Throwable $th) {
            DB::rollBack();

            logError("product failed to create", $th);

            return back()->with("error", "gagal menambah product baru");
        }
    }

    public function edit($id)
    {
        $categories = Categorie::orderBy("name")->get();
        $product    = Product::with("categorie", "images")->findOrFail($id);
        $bread      = [
            route('master.product.index') => 'Products',
            route('master.product.detail', $product->id) => "Detail Product"
        ];

        return view("pages.product.edit", compact("product", "categories", "bread"));
    }

    public function editPost(Request $request, $id)
    {
        $request->validate([
            "name" => ["required", "string", "max:255", "min:3"],
            "categorie" => ["required", "exists:categories,id"],
            "files" => ["nullable", "array"],
            "description" => "required",
            "price" => ["required", "numeric", "min:0", "max:100000000"],
            "configs" => ["nullable", "array"]
        ]);

        $product = Product::findOrFail($id);

        try {
            DB::beginTransaction();
            $product->name         = $request->input("name");
            $product->categorie_id = $request->input("categorie");
            $product->price        = $request->input("price");
            $product->configs      = $request->input("configs") ?? [];
            $product->save();

            if (count($request->input('files')) > 0) {
                $folder = \Illuminate\Support\Str::random();

                foreach ($request->input('files') as $key => $value) {
                    $path = $this->fileTempService->saveFileTemp($value, "products/$folder");

                    if ($path) {
                        ProductImage::create([
                            "product_id" => $product->id,
                            "image" => $path
                        ]);
                    }
                }
            }

            DB::commit();

            logNotice("product success to update", [
                "datas" => $product,
                "by" => auth()->user()->id
            ]);

            return back()->with("success", "berhasil menambah product baru");
        } catch (\Throwable $th) {
            DB::rollBack();

            logError("product failed to update", $th);

            return back()->with("error", "gagal mengupdate product");
        }
    }

    public function deleteImagePost($id, $idImage)
    {
        $productImage = ProductImage::findOrFail($idImage);

        if (Storage::disk("public")->exists($productImage->image)) {
            Storage::disk("public")->delete($productImage->image);
        }

        $productImage->delete();

        return back()->with('success', 'gambar product berhasil dihapus');
    }

    public function detail($id)
    {
        $product = Product::with("categorie", "images")->findOrFail($id);
        $bread   = [
            route('master.product.index') => 'Products',
        ];

        return view("pages.product.detail", compact("product", "bread"));
    }

    public function detailPost(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:ACTIVE,NOT ACTIVE'],
            'stock' => ["required", 'numeric', 'min:0', 'max:5000']
        ]);

        $product = Product::findOrFail($id);

        try {
            $product->stocks = $request->input("stock");
            $product->save();

            logNotice("product stocks success to update", [
                "datas" => $product,
                "by" => auth()->user()->id
            ]);

            return back()->with("success", "berhasil menambah stock");
        } catch (\Throwable $th) {
            logError("product stock failed to update", $th);

            return back()->with("error", "gagal mengupdate product stock");
        }
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route("master.product.index")->with("success", "berhasil menghapus product");
    }
}
