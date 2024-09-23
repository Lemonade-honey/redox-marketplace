<?php

namespace App\Livewire;

use App\Models\Master\Categorie;
use Livewire\Component;

class ListMasterCategories extends Component
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
        $categories = Categorie::with("products")
            ->when($this->search != '', function ($query) {
                $query->where("name", "LIKE", "%$this->search%");
            })->paginate($this->perPage);

        return view('livewire.list-master-categories', compact("categories"));
    }
}
