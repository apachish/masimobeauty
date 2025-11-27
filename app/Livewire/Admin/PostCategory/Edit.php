<?php

namespace App\Livewire\Admin\PostCategory;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public  $postCategory;
    public  $editable = [
        "title"=>null,
        "status"=>"inactive",
    ];

    public function mount($category)
    {
        $this->postCategory=PostCategory::findOrFail($category);
        $this->editable = [
            "title"=>$this->postCategory->title,
            "status"=>$this->postCategory->status,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        // return $request->all();
        $this->validate([
            'editable.title'=>'string|required',
            'editable.status'=>'required|in:active,inactive'
        ]);
        $status= $this->postCategory->update($this->editable);
        if($status){
            request()->session()->flash('success','Post Category Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post-category.index');
    }

    public function render()
    {
        return view('livewire.admin.post-category.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || Edit Category Post Page']);

    }
}
