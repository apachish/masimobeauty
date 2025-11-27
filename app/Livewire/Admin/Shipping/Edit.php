<?php

namespace App\Livewire\Admin\Shipping;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{

    public Shipping $shipping;
    public $editable;

    public function mount($shipping)
    {
        $this->shipping = $shipping;
        $this->editable = [
            "type"=>data_get($shipping, 'type'),
            "price"=>data_get($shipping, 'price'),
            "status"=>data_get($shipping, 'status'),
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
            'editable.type'=>'string|required',
            'editable.price'=>'nullable|numeric',
            'editable.status'=>'required|in:active,inactive'
        ]);

        // return $data;
        $status=$this->shipping->update($this->editable);
        if($status){
            request()->session()->flash('success','Shipping successfully updated');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('shipping.index');
    }


    public function render()
    {
        return view('livewire.admin.shipping.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍCreate Shipping Page']);
    }
}
