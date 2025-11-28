<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class NewArrivals extends Component
{
    public $currentSlide = 0;


    public function render()
    {
        $arrivals = Product::where('status','active')->where('condition','new')->orderBy('price','DESC')->get();

        return view('livewire.new-arrivals',compact('arrivals'));
    }
}
