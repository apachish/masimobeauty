<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SlideProducts extends Component
{
    public $currentSlide = 0;
    public $title = null;

    public function render()
    {
        $arrivals = Product::where('status','active')->where('condition','new')->orderBy('price','DESC')->get();

        return view('livewire.slide-products',compact('arrivals'));
    }
}
