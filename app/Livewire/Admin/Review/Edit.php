<?php

namespace App\Livewire\Admin\Review;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.review.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍEdit Review Page']);
    }
}
