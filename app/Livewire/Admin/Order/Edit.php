<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Edit extends Component
{
    public $order;
    public $status;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order);

    }
    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate([
            'status'=>'required|in:new,process,delivered,cancel'
        ]);
        // return $request->status;
        if($this->status=='delivered'){
            foreach($this->order->cart as $cart){
                $product=$cart->product;
                // return $product;
                $product->stock -=$cart->quantity;
                $product->save();
            }
        }
        $status=$this->order->update(["status"=>$this->status]);
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }

    public function render()
    {
        return view('livewire.admin.order.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍEdit Order Page']);
    }
}
