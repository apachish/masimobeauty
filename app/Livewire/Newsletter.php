<?php

namespace App\Livewire;

use Livewire\Component;

class Newsletter extends Component
{
    public $email = '';

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        // Here you can add logic to save email to database
        // For example: Newsletter::create(['email' => $this->email]);
        
        session()->flash('message', 'Thank you for subscribing!');
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.newsletter');
    }
}
