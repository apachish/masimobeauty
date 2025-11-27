<?php

namespace App\Livewire\Admin\PostCategory;

use App\Models\PostCategory;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $postCategories =PostCategory::orderBy('id','DESC')->paginate(10);

        return view('livewire.admin.post-category.index',compact('postCategories'))
            ->layout('layouts.admin', ['title' => 'E-SHOP ||  Category Post Page']);

    }
}
