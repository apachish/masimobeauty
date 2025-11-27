<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{
    public $category = [
        "title"=>null,
        "summary"=>null,
        "photo"=>null,
        "status"=>"active",
        "is_parent"=>true,
        "parent_id"=>null,
    ];

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        $this->validate([
            'category.title' => 'required|string',
            'category.summary' => 'nullable|string',
            'category.photo' => 'nullable|string',
            'category.status' => 'required|in:active,inactive',
            'category.is_parent' => 'sometimes|boolean',
            'category.parent_id' => 'nullable|exists:categories,id',
        ]);

        $slug = generateUniqueSlug(data_get($this->category,'title'), Category::class);
        $this->category['slug'] = $slug;
        $this->category['is_parent'] = data_get($this->category,'is_parent',0);

        $category = Category::create($this->category);

        $message = $category
            ? 'Category successfully added'
            : 'Error occurred, Please try again!';

        return redirect()->route('category.index')->with(
            $category ? 'success' : 'error',
            $message
        );
    }

    public function render()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();

        return view('livewire.admin.category.create',compact('parent_cats'))->layout('layouts.admin', ['title' => 'E-SHOP || Category Create']);;
    }
}
