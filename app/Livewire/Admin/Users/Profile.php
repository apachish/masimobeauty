<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.admin.users.profile')
            ->layout('layouts.admin', ['title' => 'E-SHOP || Profile User Page']);

    }
}
