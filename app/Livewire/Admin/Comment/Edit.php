<?php

namespace App\Livewire\Admin\Comment;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.comment.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍEdit Comment Page']);;
    }
}
