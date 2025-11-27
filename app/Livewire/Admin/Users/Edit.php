<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public User $user;
    public $editable;
    public function mount($user)
    {
        $this->user =$user;
        $this->editable = [
            "name"=>data_get($this->user,"name"),
            "email"=>data_get($this->user,"email"),
            "role"=>data_get($this->user,"role"),
            "status"=>data_get($this->user,"status","inactive"),
            "photo"=>data_get($this->user,"photo"),
        ];

    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate(
            [
                'editable.name'=>'string|required|max:30',
                'editable.email'=>'string|required',
                'editable.role'=>'required|in:admin,user',
                'editable.status'=>'required|in:active,inactive',
                'editable.photo'=>'nullable|string',
            ]);
        $status= $this->user->update($this->editable);
        if($status){
            request()->session()->flash('success','Successfully updated');
        }
        else{
            request()->session()->flash('error','Error occured while updating');
        }
        return redirect()->route('users.index');

    }


    public function render()
    {
        return view('livewire.admin.users.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || Edit User Page']);

    }
}
