<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Wishlist extends Component
{
    public $wishlistItems = [];

    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        // Load wishlist from session (you can replace this with database later)
        $this->wishlistItems = Session::get('wishlist', []);
    }

    public function removeFromWishlist($productId)
    {
        $wishlist = Session::get('wishlist', []);
        $wishlist = array_filter($wishlist, function($item) use ($productId) {
            return $item['id'] != $productId;
        });
        Session::put('wishlist', array_values($wishlist));
        $this->loadWishlist();
        
        session()->flash('message', 'Product removed from wishlist');
    }

    public function addToCart($productId)
    {
        // Add to cart logic here
        session()->flash('message', 'Product added to cart');
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
