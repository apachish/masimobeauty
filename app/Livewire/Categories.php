<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public function render()
    {
        $categories =Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->take(3)->get();

        return view('livewire.categories',compact('categories'));
    }
}
