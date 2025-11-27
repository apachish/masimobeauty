<?php

namespace App\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public Coupon $coupon;
    public $editable = [
        "code" => null,
        "type" => null,
        "value" => null,
        "status" => "inactive",
    ];

    public function mount($coupon)
    {
        $this->coupon = $coupon;
        if (!$this->coupon) abort(404);
        $this->editable = [
            "code" => $this->coupon->code,
            "type" => $this->coupon->type,
            "value" => $this->coupon->value,
            "status" => $this->coupon->status,

        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate([
            'editable.code' => 'string|required',
            'editable.type' => 'required|in:fixed,percent',
            'editable.value' => 'required|numeric',
            'editable.status' => 'required|in:active,inactive'
        ]);

        $status = $this->coupon->update($this->editable);
        if ($status) {
            request()->session()->flash('success', 'Coupon Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('coupon.index');

    }

    public function render()
    {
        return view('livewire.admin.coupon.edit')->layout('layouts.admin', ['title' => 'E-SHOP || Edit Coupon  Page']);
    }
}
