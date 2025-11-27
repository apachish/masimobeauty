<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{
    public $showMobileMenu = false;

    public function toggleMobileMenu()
    {
        $this->showMobileMenu = !$this->showMobileMenu;
    }

    public function render()
    {
        return view('livewire.header');
    }
}
