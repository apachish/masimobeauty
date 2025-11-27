<?php

namespace App\Livewire;

use Livewire\Component;

class TopBar extends Component
{
    public $showContactInfo = false;
    public $showAccountDropdown = false;

    public function toggleAccountDropdown()
    {
        $this->showAccountDropdown = !$this->showAccountDropdown;
    }

    public function render()
    {
        return view('livewire.top-bar');
    }
}
