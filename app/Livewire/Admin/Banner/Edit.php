<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Component;


class Edit extends Component
{
    public Banner $banner;
    public  $editable = [
        'title' => '',
        'description' => '',
        'photo' => '',
        'status'=>'inactive'
    ];

    public function mount($banner)
    {
       // If $banner is an ID, find the model
       if (is_numeric($banner)) {
           $this->banner = Banner::findOrFail($banner);
       } else {
       $this->banner = $banner;
       }
       
       // Populate editable with banner data
       $this->editable = [
           'title' => $this->banner->title ?? '',
           'description' => $this->banner->description ?? '',
           'photo' => $this->banner->photo ?? '',
           'status' => $this->banner->status ?? 'inactive'
       ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate([
            'editable.title' => 'required|string|max:50',
            'editable.description' => 'nullable|string',
            'editable.photo' => 'required|string',
            'editable.status' => 'required|in:active,inactive',
        ]);

        $status = $this->banner->update($this->editable);

        $message = $status
            ? 'Banner successfully updated'
            : 'Error occurred while updating banner';

        return redirect()->route('banner.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
    public function render()
    {
        return view('livewire.admin.banner.edit')->layout('layouts.admin', ['title' =>'E-SHOP || Banner Edit']);
    }
}
