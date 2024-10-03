<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class ListLatestOrders extends Component
{

    public function placeholder()
    {
        return view('livewire.skeleton.list');
    }

    public function render()
    {
        $orders = \App\Models\Order::with("payment")
            ->latest()
            ->limit(5)
            ->get();

        // sleep(5);
        return view('livewire.dashboard.list-latest-orders', compact('orders'));
    }
}
