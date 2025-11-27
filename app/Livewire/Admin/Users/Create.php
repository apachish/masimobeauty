<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $user = [
        "name" => null,
        "email" => null,
        "password" => null,
        "role" => null,
        "status" => "inactive",
        "photo" => null,
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(
            [
                'user.name' => 'string|required|max:30',
                'user.email' => 'string|required|unique:users,email',
                'user.password' => 'string|required',
                'user.role' => 'required|in:admin,user',
                'user.status' => 'required|in:active,inactive',
                'user.photo' => 'nullable|string',
            ]);
        $data['password'] = Hash::make(data_get($this->user, 'password'));
        $data = $this->user;
        $status = User::create($data);
        // dd($status);
        if ($status) {
            request()->session()->flash('success', 'Successfully added user');
        } else {
            request()->session()->flash('error', 'Error occurred while adding user');
        }
        return redirect()->route('users.index');

    }

    public function render()
    {
        return view('livewire.admin.users.create')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍCreate User Page']);

    }
}
