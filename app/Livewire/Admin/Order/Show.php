<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order);

    }
    public function render()
    {
        return view('livewire.admin.order.show')
            ->layout('layouts.admin', ['title' => 'E-SHOP || Show Order Page']);
    }
}
