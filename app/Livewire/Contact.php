<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class Contact extends Component
{
    public $name = '';
    public $address = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'address' => 'required|min:5',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->address,
            'subject' => 'Contact Form',
            'message' => $this->message,
        ]);

        session()->flash('success', 'Your message has been sent successfully!');
        
        $this->reset(['name', 'email', 'address', 'message']);
    }

    public function render()
    {
        return view('livewire.contact')->layout('layouts.app');
    }
}

