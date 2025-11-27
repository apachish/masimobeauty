<?php

namespace App\Livewire\Admin\Shipping;

use App\Models\Shipping;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $shippings =Shipping::orderBy('id','DESC')->paginate(10);

        return view('livewire.admin.shipping.index',compact('shippings'))
            ->layout('layouts.admin', ['title' => 'E-SHOP ||  Shipping Page']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::find($id);
        if($shipping){
            $status=$shipping->delete();

            if($status){
                request()->session()->flash('success','Shipping successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('shipping.index');
        }
        else{
            request()->session()->flash('error','Shipping not found');
            return redirect()->back();
        }
    }
}
