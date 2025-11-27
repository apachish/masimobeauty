<?php

namespace App\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Livewire\Component;

class Create extends Component
{
    public $coupon = [
        "code"=>null,
        "type"=>null,
        "value"=>null,
        "status"=>"inactive",
    ];
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'coupon.code'=>'string|required',
            'coupon.type'=>'required|in:fixed,percent',
            'coupon.value'=>'required|numeric',
            'coupon.status'=>'required|in:active,inactive'
        ]);
        $status=Coupon::create($this->coupon);
        if($status){
            request()->session()->flash('success','Coupon Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('coupon.index');
    }


    public function render()
    {
        return view('livewire.admin.coupon.create')
            ->layout('layouts.admin', ['title' => 'E-SHOP || Create Coupon Page']);
    }
}
