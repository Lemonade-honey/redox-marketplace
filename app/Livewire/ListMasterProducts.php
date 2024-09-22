<?php

namespace App\Livewire;

use App\Models\Master\Product;
use Livewire\Component;

class ListMasterProducts extends Component
{
    use \Livewire\WithPagination;

    public function placeholder()
    {
        return view('livewire.skeleton.loading');
    }
    protected $queryString = ['search' => ['except' => '']];

    public string $search = '';

    public $perPage = 10;

    public function render()
    {
        $products = Product::with("categorie")
            ->when($this->search != '', function ($query) {
                $query->where("name", "LIKE", "%$this->search%")
                    ->orWhereHas("categorie", function ($query) {
                        $query->where("name", "LIKE", "%$this->search%");
                    })
                    ->orWhere("price", $this->search);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.list-master-products', compact("products"));
    }
}
