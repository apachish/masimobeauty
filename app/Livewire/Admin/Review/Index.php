<?php

namespace App\Livewire\Admin\Review;

use App\Models\ProductReview;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $reviews = ProductReview::getAllReview();

        return view('livewire.admin.review.index',compact('reviews'))
            ->layout('layouts.admin', ['title' => 'E-SHOP ||  Reviews Page']);
    }
}
