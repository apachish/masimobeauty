<?php

namespace App\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $posts=Post::getAllPost();
        return view('livewire.admin.post.index',compact('posts'))
            ->layout('layouts.admin', ['title' => 'E-SHOP ||  Posts Page']);

    }
}
