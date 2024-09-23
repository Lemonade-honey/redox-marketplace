<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view("pages.categorie.index");
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2', 'unique:categories,name']
        ]);

        try {
            $categorie = Categorie::create([
                'name' => $request->input("name"),
            ]);

            logNotice("categories success to create", [
                "data" => $categorie,
                "by" => auth()->user()->id
            ]);

            return back()->with("success", "berhasil menambah categorie baru");
        } catch (\Throwable $th) {
            logError("categorie failed to create", $th);

            return back()->with("error", "gagal membuat categories baru");
        }
    }

    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        $berd      = [
            route('master.categorie.index') => "Home"
        ];

        return view("pages.categorie.edit", compact("categorie", "berd"));
    }

    public function editPost(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2', 'unique:categories,name,' . $id]
        ]);

        $categorie = Categorie::findOrFail($id);

        try {
            $categorie->name = $request->input("name");
            $categorie->save();

            logNotice("categorie success to update", [
                "data" => $categorie,
                "by" => auth()->user()->id
            ]);

            return back()->with("success", "categorie berhasil diupdate");
        } catch (\Throwable $th) {
            logError("categorie failed to update", $th);

            return back()->with("error", "categorie gagal diupdate");
        }
    }

    public function delete($id)
    {
        $categorie = Categorie::findOrFail($id);
        logNotice("categorie deleted", [
            "data" => $categorie,
            "by" => auth()->user()->id
        ]);
        $categorie->delete();

        return redirect()->route('master.categorie.index')->with("success", "categorie berhasil dihapus");
    }
}
