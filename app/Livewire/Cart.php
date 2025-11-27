<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        // Load cart from session (you can replace this with database later)
        $this->cartItems = Session::get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cartItems as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
    }

    public function increaseQuantity($productId)
    {
        $cart = Session::get('cart', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId) {
                $cart[$key]['quantity']++;
                break;
            }
        }
        Session::put('cart', $cart);
        $this->loadCart();
    }

    public function decreaseQuantity($productId)
    {
        $cart = Session::get('cart', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId && $item['quantity'] > 1) {
                $cart[$key]['quantity']--;
                break;
            }
        }
        Session::put('cart', $cart);
        $this->loadCart();
    }

    public function removeFromCart($productId)
    {
        $cart = Session::get('cart', []);
        $cart = array_filter($cart, function($item) use ($productId) {
            return $item['id'] != $productId;
        });
        Session::put('cart', array_values($cart));
        $this->loadCart();
        
        session()->flash('message', 'Product removed from cart');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
