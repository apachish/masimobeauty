<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{


    public function mount()
    {
        Auth::logout();

        // Invalidate session
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }


    public function render()
    {


        return view('livewire.auth.logout');
    }
}
