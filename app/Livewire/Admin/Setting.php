<?php

namespace App\Livewire\Admin;

use App\Models\Settings;
use Livewire\Component;

class Setting extends Component
{
    public $data = [];


    public function settingsUpdate()
    {
        // return $request->all();
        $this->validate([
            'data.short_des' => 'required|string',
            'data.description' => 'required|string',
            'data.photo' => 'required',
            'data.logo' => 'required',
            'data.address' => 'required|string',
            'data.email' => 'nullable|email',
            'data.phone' => 'required|string',
        ]);
        // return $settings;
        try {


            foreach ($this->data as $key => $value) {
                Settings::updateOrCreate(['key' => $key], ['value' => $value]);
            }
            session()->flash('success', 'Setting successfully updated');
        }catch (\Exception $exception){
            session()->flash('error','Please try again');
        }
        return redirect()->route('settings');

    }


    public function render()
    {
        $this->data = Settings::first();

        return view('livewire.admin.setting')->layout('layouts.admin', ['title' => 'E-SHOP || Settings']);
    }
}
