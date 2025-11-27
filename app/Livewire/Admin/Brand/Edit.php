<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public Brand $brand;
    public  $editable = [
        'title' => '',
        'status'=>'inactive'
    ];

    public function mount($brand)
    {
        // If $brand is an ID, find the model
        if (is_numeric($brand)) {
            $this->$brand = Brand::findOrFail($brand);
        } else {
            $this->$brand = $brand;
        }

        // Populate editable with$brand data
        $this->editable = [
            'title' => $this->brand->title ?? '',
            'status' => $this->brand->status ?? 'inactive'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate([
            'editable.title' => 'required|string',
            'editable.status' => 'required|in:active,inactive',
        ]);

        $status = $this->brand->update($this->editable);

        $message = $status
            ? 'Brand successfully updated'
            : 'Error, Please try again';

        return redirect()->route('brand.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    public function render()
    {
        return view('livewire.admin.brand.edit')->layout('layouts.admin', ['title' =>'E-SHOP || Brand Edit']);
    }
}
