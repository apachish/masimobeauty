<?php

namespace App\Livewire\Admin\Comment;

use App\Models\PostComment;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $comments=PostComment::getAllComments();

        return view('livewire.admin.comment.index',compact('comments'))
            ->layout('layouts.admin', ['title' => 'E-SHOP || Comment Page']);
    }
}
