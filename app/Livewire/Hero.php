<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Component;

class Hero extends Component
{
    public $banners;
    public function render()
    {
        $this->banners =Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();

        return view('livewire.hero');
    }
}
