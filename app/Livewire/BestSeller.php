<?php

namespace App\Livewire;

use Livewire\Component;

class BestSeller extends Component
{
    public $currentSlide = 0;

    public function nextSlide()
    {
        $this->currentSlide = ($this->currentSlide + 1) % 3;
    }

    public function previousSlide()
    {
        $this->currentSlide = ($this->currentSlide - 1 + 3) % 3;
    }

    public function render()
    {
        return view('livewire.best-seller');
    }
}
