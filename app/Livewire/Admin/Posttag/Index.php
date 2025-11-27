<?php

namespace App\Livewire\Admin\Posttag;

use App\Models\PostTag;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $postTags=PostTag::orderBy('id','DESC')->paginate(10);

        return view('livewire.admin.posttag.index',compact('postTags'))
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍTags Post Page']);
    }
}
