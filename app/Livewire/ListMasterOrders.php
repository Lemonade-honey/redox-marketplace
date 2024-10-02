<?php

namespace App\Livewire;

use Livewire\Component;

class ListMasterOrders extends Component
{
    use \Livewire\WithPagination;

    public function placeholder()
    {
        return view('livewire.skeleton.loading');
    }
    protected $queryString = [
        'orderStatus' => ['except' => 'All'],
        'paymentStatus' => ['except' => 'All'],
        'search' => ['except' => '']
    ];

    public string $search = '';

    public string $orderStatus = 'All';

    public string $paymentStatus = 'All';

    public $perPage = 10;

    public function render()
    {
        $orders = \App\Models\Order::with("user", "payment")
            ->when($this->search != '', function ($query) {
                $query->where("id", "%$this->search%")
                    ->orWhereHas("user", function ($query) {
                        $query->where("email", "LIKE", "%$this->search%");
                    });
            })
            ->when($this->paymentStatus != 'All', function ($query) {
                $query->whereHas("payment", function ($query) {
                    $query->where("status", "LIKE", "%$this->paymentStatus%");
                });
            })
            ->when($this->orderStatus != 'All', function ($query) {
                $query->where("status", "LIKE", "%$this->orderStatus%");
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.list-master-orders', compact("orders"));
    }
}
