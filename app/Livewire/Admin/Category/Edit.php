<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Edit extends Component
{
    public Category $category;
    public  $editable = [
        "title"=>null,
        "summary"=>null,
        "photo"=>null,
        "status"=>null,
        "is_parent"=>null,
        "parent_id"=>null,
    ];
    public function mount($category)
    {
        if (is_numeric($category)) {
            $this->category = Category::findOrFail($category);
        } else {
            $this->category = $category;
        }
        $this->editable = [
            "title"=>data_get($category, "title"),
            "summary"=>data_get($category, "summary"),
            "photo"=>data_get($category, "photo"),
            "status"=>data_get($category, "status"),
            "is_parent"=>data_get($category, "is_parent")?true:false,
            "parent_id"=>data_get($category, "parent_id"),
        ];

    }


    /**
     * Update the specified resource in storage.
     *
     */
    public function update()
    {
//        dd($this->category,$this->editable);
        $this->validate([
            'editable.title' => 'required|string',
            'editable.summary' => 'nullable|string',
            'editable.photo' => 'nullable|string',
            'editable.status' => 'required|in:active,inactive',
            'editable.is_parent' => 'sometimes|in:1',
            'editable.parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->editable['is_parent'] = data_get($this->editable,'is_parent', 0);

        $status = $this->category->update($this->editable);

        $message = $status
            ? 'Category successfully updated'
            : 'Error occurred, Please try again!';

        return redirect()->route('category.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    public function render()
    {
        $parent_cats = Category::where('is_parent', 1)->get();
        return view('livewire.admin.category.edit',compact('parent_cats'))->layout('layouts.admin', ['title' =>'E-SHOP || Banner Edit']);;
    }
}
