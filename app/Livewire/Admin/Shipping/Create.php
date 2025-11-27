<?php

namespace App\Livewire\Admin\Shipping;

use App\Models\Shipping;
use Livewire\Component;

class Create extends Component
{
    public $shipping = [
        "type" => null,
        "price" => null,
        "status" => "active",
    ];

    /**
     * Store a newly created resource in storage.
     ** @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'shipping.type' => 'string|required',
            'shipping.price' => 'nullable|numeric',
            'shipping.status' => 'required|in:active,inactive'
        ]);
        // return $data;
        $status = Shipping::create($this->shipping);
        if ($status) {
            request()->session()->flash('success', 'Shipping successfully created');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }
        return redirect()->route('shipping.index');
    }

    public function render()
    {
        return view('livewire.admin.shipping.create')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍCreate Shipping Page']);

    }
}
